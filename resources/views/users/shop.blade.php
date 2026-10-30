<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   
</head>
<body>
@extends('layouts.app')

@section('title', 'Shop')

@section('content')
    <div class="container my-4">
        <div class="row g-4">
            @foreach($products as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">${{ number_format($product->price, 2) }}</p>
                            <small class="text-muted mb-2">Stock: {{ $product->stock }}</small>

                            @auth
                                <form method="POST" action="{{ route('cart.add', $product) }}" class="mt-auto">
                                    @csrf
                                    <button type="submit" class="btn btn-dark w-100">Buy</button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline-dark w-100 mt-auto">Login to Buy</a>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
</body>
</html>