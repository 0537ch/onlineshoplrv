<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function show()
    {
        $cartItems = session()->get('cart', []);
        $total = 0;
        
        // Calculate total and get product details
        foreach ($cartItems as &$item) {
            $product = Product::find($item['product_id']);
            if ($product) {
                $item['product'] = $product;
                $total += $product->price * $item['quantity'];
            }
        }

        return view('cart.show', compact('cartItems', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);

        // If item exists in cart, update quantity
        if (isset($cart[$request->product_id])) {
            $cart[$request->product_id]['quantity'] += $request->quantity;
            $message = $product->name . ' quantity updated in cart!';
        } else {
            // Add new item to cart
            $cart[$request->product_id] = [
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'price' => $product->price
            ];
            $message = $product->name . ' added to cart!';
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', $message);
    }

    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);
        $product = Product::findOrFail($request->product_id);

        if (isset($cart[$request->product_id])) {
            $cart[$request->product_id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', $product->name . ' quantity updated!');
        }

        return redirect()->back()->with('error', 'Product not found in cart!');
    }

    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $cart = session()->get('cart', []);
        $product = Product::findOrFail($request->product_id);

        if (isset($cart[$request->product_id])) {
            unset($cart[$request->product_id]);
            session()->put('cart', $cart);
            return redirect()->back()->with('success', $product->name . ' removed from cart!');
        }

        return redirect()->back()->with('error', 'Product not found in cart!');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Cart cleared successfully!');
    }
}
