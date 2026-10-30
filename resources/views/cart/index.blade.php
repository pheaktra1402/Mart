@extends('layouts.app')

@section('title', 'Cart')

@section('content')
    <div class="container pb-5" style="max-width: 900px;">
        <h3 class="mb-3">Your Cart</h3>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if (empty($cart))
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center text-muted py-5">
                    Your cart is empty.
                    <div class="mt-3">
                        <a href="{{ route('shop') }}" class="btn btn-dark">Continue shopping</a>
                    </div>
                </div>
            </div>
        @else
            <div class="card border-0 shadow-sm">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th style="width:140px">Qty</th>
                                <th>Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $id => $item)
                                <tr>
                                    <td>
                                        @if ($item['image'])
                                            <img src="{{ asset('storage/' . $item['image']) }}"
                                                 width="48" height="48" class="rounded me-2" style="object-fit:cover">
                                        @endif
                                        {{ $item['name'] }}
                                    </td>
                                    <td>${{ number_format($item['price'], 2) }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('cart.update', $id) }}" class="d-flex gap-1">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" name="quantity" min="1"
                                                   value="{{ $item['quantity'] }}" class="form-control form-control-sm">
                                            <button class="btn btn-outline-dark btn-sm">OK</button>
                                        </form>
                                    </td>
                                    <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                    <td class="text-end">
                                        <form method="POST" action="{{ route('cart.remove', $id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger btn-sm">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-body d-flex justify-content-between align-items-center">
                    <a href="{{ route('shop') }}" class="btn btn-outline-secondary">Continue shopping</a>

                    <div class="d-flex align-items-center gap-3">
                        <h5 class="mb-0">Total: ${{ number_format($total, 2) }}</h5>
                        <form method="POST" action="{{ route('checkout.store') }}">
                            @csrf
                            <button class="btn btn-dark">Checkout</button>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection