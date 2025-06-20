<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = auth()->user()->cartItems()->with('product')->get();
        return view('cart.index', compact('cartItems'));
    }

    public function addToCart(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->stock
        ]);

        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Not enough stock available');
        }

        auth()->user()->cartItems()->updateOrCreate(
            ['product_id' => $product->id],
            ['quantity' => $request->quantity]
        );

        return back()->with('success', 'Product added to cart');
    }

    public function removeFromCart(Product $product)
    {
        auth()->user()->cartItems()->where('product_id', $product->id)->delete();
        return back()->with('success', 'Product removed from cart');
    }
}
