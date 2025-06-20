<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
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
            ->with(['outlet', 'items.product'])
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $this->authorize('view', $order);
        $order->load(['outlet', 'items.product']);
        return view('orders.show', compact('order'));
    }
}
