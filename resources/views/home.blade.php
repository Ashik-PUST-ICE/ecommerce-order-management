@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="text-center py-4">
                        <h3>Welcome to E-Commerce Order Management System</h3>
                        <p class="lead">Manage your products, orders, and outlets efficiently</p>

                        <div class="mt-4">
                            <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg mx-2">
                                <i class="bi bi-box-seam"></i> Browse Products
                            </a>

                            @auth
                                @if(auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
                                    <a href="{{ route('admin.orders.index') }}" class="btn btn-success btn-lg mx-2">
                                        <i class="bi bi-clipboard-data"></i> Manage Orders
                                    </a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
