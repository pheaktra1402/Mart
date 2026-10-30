@extends('layouts.app')

@section('content')
<div class="row g-3 mx-5">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h5>My Cart</h5>
                <div class="display-6">{{ $cartCount }} <small class="fs-6 text-muted">items</small></div>
                <a href="{{ route('cart.index') }}" class="btn btn-dark btn-sm mt-2">View Cart</a>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h5>My Orders</h5>

                @forelse ($orders as $order)
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span>
                            {{-- {{ $order->id }} --}}
                            <small class="text-muted">
                                {{ $order->items_count }} items · {{ $order->created_at->format('d M Y') }}
                            </small>
                        </span>
                        <strong>${{ number_format($order->total, 2) }}</strong>
                    </div>
                @empty
                    <p class="text-muted mb-2">No orders yet.</p>
                    <a href="{{ route('shop') }}" class="btn btn-outline-dark btn-sm">Start Shopping</a>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection