<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrderRequest;
use Illuminate\Http\Request; 

use App\Models\Order;
use App\Models\Outlet;

class OrderController extends Controller
{
public function index()
{
    $orders = Order::with(['user', 'outlet', 'items.product'])
        ->whereHas('user')
        ->whereHas('outlet')
        ->latest()
        ->paginate(10);

    $outlets = Outlet::all(); 

    return view('admin.orders.index', compact('orders', 'outlets'));
}

    public function create()
    {
        // Typically not used for orders
        return redirect()->route('admin.orders.index');
    }

    public function store(OrderRequest $request)
    {
        // Typically orders are created through frontend
        return redirect()->route('admin.orders.index');
    }

  public function show(Order $order)
    {
        $order->load(['outlet', 'user', 'items.product', 'transferredTo']);
        $outlets = Outlet::all(); // Add this line

        return view('admin.orders.show', compact('order', 'outlets')); // Include outlets
            }

    public function edit(Order $order)
    {
        // Typically orders aren't edited manually
        return redirect()->route('admin.orders.show', $order);
    }

    public function update(OrderRequest $request, Order $order)
    {
        // Typically orders are updated through specific actions
        return redirect()->route('admin.orders.show', $order);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')
                         ->with('success', 'Order deleted successfully');
    }

public function accept(Order $order)
{
    $order->update(['status' => 'accepted']);

    return redirect()->route('admin.orders.index')
        ->with('success', 'Order accepted successfully');
}


public function cancel(Order $order)
{
    $order->update(['status' => 'cancelled']);

    return redirect()->route('admin.orders.index')
        ->with('success', 'Order cancelled successfully');
}


    public function transfer(Request $request, Order $order)
    {
        $request->validate([
            'outlet_id' => 'required|exists:outlets,id'
        ]);

        $order->update([
            'status' => 'transferred',
            'transferred_to' => $request->outlet_id
        ]);

        return back()->with('success', 'Order transferred successfully');
    }



}
