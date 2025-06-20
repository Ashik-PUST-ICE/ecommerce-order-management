<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CartRequest;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = auth()->user()->cartItems()->with('product')->get();
        return response()->json($cartItems);
    }

    public function addToCart(CartRequest $request)
    {
        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return response()->json(['message' => 'Not enough stock available'], 400);
        }

        $cartItem = auth()->user()->cartItems()->updateOrCreate(
            ['product_id' => $request->product_id],
            ['quantity' => $request->quantity]
        );

        return response()->json($cartItem->load('product'), 201);
    }

    public function removeFromCart(Request $request, Product $product)
    {
        auth()->user()->cartItems()->where('product_id', $product->id)->delete();
        return response()->json(['message' => 'Item removed from cart']);
    }
}
