@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h2 class="mb-4">Our Products</h2>

        <div class="row">
            @forelse($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($product->description, 100) }}</p>
                        <p class="card-text">
                            <span class="fw-bold">${{ number_format($product->price, 2) }}</span>
                            <span class="badge bg-info float-end">Stock: {{ $product->stock }}</span>
                        </p>
                    </div>
                    <div class="card-footer bg-transparent">
                        <form action="{{ route('cart.add', $product) }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                                    class="form-control" style="width: 70px">
                                <button class="btn btn-primary" type="submit">
                                    <i class="bi bi-cart-plus"></i> Add
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info">No products available at the moment.</div>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
