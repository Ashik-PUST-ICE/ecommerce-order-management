<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $orders = Order::when($user->isOutletIncharge(), function ($query) use ($user) {
                return $query->where('outlet_id', $user->outlet_id);
            })
            ->with(['outlet', 'user', 'items.product'])
            ->latest()
            ->get();

        return response()->json($orders);
    }

    public function store(OrderRequest $request)
    {
        $user = auth()->user();
        $cartItems = $user->cartItems()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'Your cart is empty'], 400);
        }

        $order = \DB::transaction(function () use ($user, $cartItems, $request) {
            $order = $user->orders()->create([
                'outlet_id' => $request->outlet_id,
                'total_amount' => $cartItems->sum(function ($item) {
                    return $item->quantity * $item->product->price;
                }),
                'status' => 'pending'
            ]);

            foreach ($cartItems as $cartItem) {
                $order->items()->create([
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->price
                ]);

                $cartItem->product->decrement('stock', $cartItem->quantity);
            }

            $user->cartItems()->delete();

            return $order;
        });

        return response()->json($order->load('items.product'), 201);
    }

    public function show(Order $order)
    {
        $this->authorize('view', $order);
        return response()->json($order->load(['outlet', 'user', 'items.product']));
    }

    public function accept(Order $order)
    {
        $this->authorize('update', $order);

        $order->update(['status' => 'accepted']);
        return response()->json($order);
    }

    public function cancel(Order $order)
    {
        $this->authorize('update', $order);

        $order->update(['status' => 'cancelled']);
        return response()->json($order);
    }

    public function transfer(Request $request, Order $order)
    {
        $this->authorize('update', $order);

        $request->validate([
            'outlet_id' => 'required|exists:outlets,id'
        ]);

        $order->update([
            'status' => 'transferred',
            'transferred_to' => $request->outlet_id
        ]);

        return response()->json($order);
    }
}
