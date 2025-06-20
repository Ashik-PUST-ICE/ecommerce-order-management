@extends('layouts.app')

@section('title', 'Manage Orders')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Manage Orders</h2>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Customer</th>
                                <th>Outlet</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->user->name ?? 'N/A' }}</td>
                                    <td>{{ $order->outlet->name ?? 'N/A' }}</td>
                                    <td>${{ number_format($order->total_amount, 2) }}</td>
                                    <td>
                                        <span id="status-badge-{{ $order->id }}"
    class="badge bg-{{
        $order->status === 'accepted' ? 'success' :
        ($order->status === 'cancelled' ? 'danger' :
        ($order->status === 'transferred' ? 'info' : 'warning')) }}">
    {{ ucfirst($order->status) }}
</span>


                                    </td>

                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-info">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            @if ($order->status === 'pending')
                                                <form action="{{ route('admin.orders.accept', $order) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success" title="Accept">
                                                        <i class="bi bi-check-circle"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.orders.cancel', $order) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger" title="Cancel">
                                                        <i class="bi bi-x-circle"></i>
                                                    </button>
                                                </form>
                                                <button class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#transferModal{{ $order->id }}" title="Transfer">
                                                    <i class="bi bi-arrow-left-right"></i>
                                                </button>
                                            @endif
                                        </div>

                                        <!-- Transfer Modal -->
                                        <div class="modal fade" id="transferModal{{ $order->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Transfer Order #{{ $order->id }}</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <form action="{{ route('admin.orders.transfer', $order) }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label class="form-label">Select Outlet</label>
                                                                <select name="outlet_id" class="form-select" required>
                                                                    @foreach ($outlets as $outlet)
                                                                        @if ($outlet->id !== $order->outlet_id)
                                                                            <option value="{{ $outlet->id }}">
                                                                                {{ $outlet->name }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Transfer
                                                                Order</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Accept -->

                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $orders->links() }}
            </div>
        </div>
    </div>
@endsection

