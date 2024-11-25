<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cartItems = session()->get('cart', []);
        if (empty($cartItems)) {
            return redirect()->route('cart.show')->with('error', 'Your cart is empty');
        }

        // Load product details for each cart item
        foreach ($cartItems as &$item) {
            $product = Product::find($item['product_id']);
            if ($product) {
                $item['product'] = $product;
            }
        }

        return view('checkout.index', compact('cartItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string',
            'shipping_city' => 'required|string',
            'shipping_postal_code' => 'required|string',
            'shipping_phone' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $user = Auth::user();
        
        $cartItems = session()->get('cart', []);
        if (empty($cartItems)) {
            return redirect()->route('cart.show')->with('error', 'Your cart is empty');
        }

        try {
            DB::beginTransaction();

            $totalAmount = 0;
            foreach ($cartItems as $item) {
                $totalAmount += $item['price'] * $item['quantity'];
            }

            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => Order::generateOrderNumber(),
                'total_amount' => $totalAmount,
                'shipping_address' => $request->shipping_address,
                'shipping_city' => $request->shipping_city,
                'shipping_postal_code' => $request->shipping_postal_code,
                'shipping_phone' => $request->shipping_phone,
                'notes' => $request->notes,
                'status' => 'pending'
            ]);

            foreach ($cartItems as $item) {
                if (!isset($item['product_id'])) {
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Invalid product in cart');
                }

                $product = Product::find($item['product_id']);
                if (!$product) {
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Product not found in inventory');
                }
                
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'] ?? 1,
                    'price' => $item['price'] ?? $product->price
                ]);
            }

            // Clear the cart after successful order
            session()->forget('cart');

            DB::commit();

            return redirect()->route('orders.show', $order)->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Checkout Error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'There was an error processing your order: ' . $e->getMessage());
        }
    }
}
