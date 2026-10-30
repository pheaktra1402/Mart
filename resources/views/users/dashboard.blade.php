@extends('layouts.app')

@section('title', 'My Dashboard')

@section('content')
    <div class="container my-5">
        <h3 class="mb-1">Hello, {{ auth()->user()->name }}</h3>
        <p class="text-muted mb-4">{{ auth()->user()->email }}</p>

        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <h5>My Cart</h5>
                        <p class="display-6 mb-3">
                            {{ collect(session('cart', []))->sum('quantity') }}
                            <small class="fs-6 text-muted">items</small>
                        </p>
                        <a href="{{ route('cart') }}" class="btn btn-dark btn-sm">View Cart</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <h5>My Orders</h5>
                        <p class="text-muted">No orders yet. Order history will appear here once checkout is built.</p>
                        <a href="{{ route('shop') }}" class="btn btn-outline-dark btn-sm">Start Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection