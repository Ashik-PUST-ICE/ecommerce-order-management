@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="container">
    <h2 class="mb-4">My Orders</h2>

    @if($orders->isEmpty())
        <div class="alert alert-info">
            You haven't placed any orders yet. <a href="{{ route('products.index') }}">Browse products</a> to get started.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Date</th>
                        <th>Outlet</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                        <td>{{ $order->outlet->name }}</td>
                        <td>${{ number_format($order->total_amount, 2) }}</td>
                        <td>
<span
    class="badge bg-{{ $order->status === 'accepted'
        ? 'success'
        : ($order->status === 'cancelled'
            ? 'danger'
            : ($order->status === 'transferred'
                ? 'info'
                : 'warning')) }}">
    {{ ucfirst($order->status) }}
</span>

                        <td>
                            <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-info">
                                <i class="bi bi-eye"></i> View
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $orders->links() }}
    @endif
</div>
@endsection
