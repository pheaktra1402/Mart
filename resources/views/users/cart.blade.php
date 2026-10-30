<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
</head>
<body>
    @extends('layouts.app')

@section('title', 'Cart')

@section('content')
    <div class="container my-5">
        <h3 class="mb-4">Your Cart</h3>

        @php $cart = session('cart', []); @endphp

        @if(count($cart) === 0)
            <div class="alert alert-light border text-center py-5">
                Your cart is empty.
                <div class="mt-3">
                    <a href="{{ route('shop') }}" class="btn btn-dark">Continue Shopping</a>
                </div>
            </div>
        @else
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>${{ number_format($item['price'], 2) }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-end">Total</th>
                        <th>
                            ${{ number_format(collect($cart)->sum(fn ($i) => $i['price'] * $i['quantity']), 2) }}
                        </th>
                    </tr>
                </tfoot>
            </table>
        @endif
    </div>
@endsection
</body>
</html>