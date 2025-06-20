@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col">
            <h2>Order #{{ $order->id }}</h2>
            <p class="text-muted">
                Placed on {{ $order->created_at->format('F j, Y \a\t g:i A') }} by {{ $order->user->name }}
            </p>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back to Orders
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Order Items</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td>{{ $item->product->name }}</td>
                                <td>${{ number_format($item->price, 2) }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Order Summary</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h6>Outlet Information</h6>
                        <p class="mb-1"><strong>{{ $order->outlet->name }}</strong></p>
                        <p class="mb-1">{{ $order->outlet->location }}</p>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <span>${{ number_format($order->total_amount / 1.1, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tax (10%):</span>
                        <span>${{ number_format($order->total_amount - ($order->total_amount / 1.1), 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between fw-bold">
                        <span>Total:</span>
                        <span>${{ number_format($order->total_amount, 2) }}</span>
                    </div>

                    <hr>

                    <div class="mb-3">
                        <span class="d-block"><strong>Status:</strong></span>
                        <span class="badge bg-{{
                            $order->status === 'accepted' ? 'success' :
                            ($order->status === 'cancelled' ? 'danger' :
                            ($order->status === 'transferred' ? 'info' : 'warning'))
                        }}">
                            {{ ucfirst($order->status) }}
                        </span>
                        @if($order->status === 'transferred')
                            <p class="mt-2 mb-0">
                                Transferred to: {{ $order->transferredTo->name }}
                            </p>
                        @endif
                    </div>

                    @if($order->status === 'pending')
                    <div class="d-grid gap-2">
                        <form action="{{ route('admin.orders.accept', $order) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success w-100 mb-2">
                                <i class="bi bi-check-circle"></i> Accept Order
                            </button>
                        </form>
                        <form action="{{ route('admin.orders.cancel', $order) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger w-100 mb-2">
                                <i class="bi bi-x-circle"></i> Cancel Order
                            </button>
                        </form>
                        <button class="btn btn-primary w-100" data-bs-toggle="modal"
                            data-bs-target="#transferModal">
                            <i class="bi bi-arrow-left-right"></i> Transfer Order
                        </button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Transfer Modal -->
<div class="modal fade" id="transferModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Transfer Order #{{ $order->id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.orders.transfer', $order) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Select Outlet</label>
                       <select name="outlet_id" class="form-select" required>
                                                            @foreach($outlets as $outlet)
                                                                @if($outlet->id !== $order->outlet_id)
                                                                    <option value="{{ $outlet->id }}">{{ $outlet->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Transfer Order</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
