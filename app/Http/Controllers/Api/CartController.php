<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function show(Request $request)
    {
        $cart = Cart::with(['items.product'])
            ->firstOrCreate(['user_id' => Auth::id()]);

        return response()->json($cart);
    }

    public function addItem(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Ensure the user is authenticated
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $product = Product::findOrFail($request->product_id);

        $cartItem = $cart->items()
            ->where('product_id', $request->product_id)
            ->first();

        DB::beginTransaction();
        try {
            if ($cartItem) {
                $cartItem->update([
                    'quantity' => $cartItem->quantity + $request->quantity,
                ]);
            } else {
                $cart->items()->create([
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity,
                    'price' => $product->price,
                ]);
            }

            DB::commit();
            return response()->json($cart->fresh(['items']));
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to add item to cart', 'message' => $e->getMessage()], 500);
        }
    }

    public function updateItem(Request $request, CartItem $item)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        if ($item->cart->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $item->update([
            'quantity' => $request->quantity,
        ]);

        $cart = Cart::with(['items.product'])->find($item->cart_id);
        return response()->json($cart);
    }

    public function removeItem(CartItem $item)
    {
        if ($item->cart->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $item->delete();

        $cart = Cart::with(['items.product'])->find($item->cart_id);
        return response()->json($cart);
    }

    public function clear()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        if ($cart) {
            $cart->items()->delete();
        }

        return response()->json(['message' => 'Cart cleared']);
    }
}
