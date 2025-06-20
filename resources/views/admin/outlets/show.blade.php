@extends('layouts.app')

@section('title', 'Outlet Details')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col">
            <h2>Outlet: {{ $outlet->name }}</h2>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.outlets.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Outlet Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <p class="form-control-static">{{ $outlet->name }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Location</label>
                        <p class="form-control-static">{{ $outlet->location }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Created At</label>
                        <p class="form-control-static">{{ $outlet->created_at->format('M d, Y') }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Last Updated</label>
                        <p class="form-control-static">{{ $outlet->updated_at->format('M d, Y') }}</p>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.outlets.edit', $outlet) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Outlet Statistics</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Total Orders</label>
                        <p class="form-control-static">{{ $outlet->orders()->count() }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Active Staff</label>
                        <p class="form-control-static">{{ $outlet->users()->count() }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pending Orders</label>
                        <p class="form-control-static">{{ $outlet->orders()->where('status', 'pending')->count() }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Completed Orders</label>
                        <p class="form-control-static">{{ $outlet->orders()->where('status', 'accepted')->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
