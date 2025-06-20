@extends('layouts.app')

@section('title', 'Create Outlet')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col">
            <h2>Create New Outlet</h2>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.outlets.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.outlets.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Outlet Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <textarea class="form-control" id="location" name="location" rows="3" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Save Outlet
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
