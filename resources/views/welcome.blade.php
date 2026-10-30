<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    @extends('layouts.app')

@section('title', 'KemraMart - Home')

@section('content')

@php
    
    $categories = ['Drinks', 'Snacks', 'Fruits', 'Household', 'Meat & Fish', 'Vegetables'];

    $products = [
        ['name' => 'Coca-Cola 330ml', 'price' => 0.50, 'category' => 'Drinks'],
        ['name' => 'Potato Chips', 'price' => 1.20, 'category' => 'Snacks'],
        ['name' => 'Fresh Apples 1kg', 'price' => 3.00, 'category' => 'Fruits'],
        ['name' => 'Dish Soap', 'price' => 2.50, 'category' => 'Household'],
        ['name' => 'Mineral Water 1.5L', 'price' => 0.60, 'category' => 'Drinks'],
        ['name' => 'Instant Noodles', 'price' => 0.35, 'category' => 'Snacks'],
        ['name' => 'Bananas 1kg', 'price' => 1.50, 'category' => 'Fruits'],
        ['name' => 'Laundry Powder', 'price' => 4.00, 'category' => 'Household'],
    ];
@endphp

<style>
    :root {
        --km-brown: #6b2d12;
        --km-gold: #e29a2d;
        --km-cream: #fff8ee;
    }
    .btn-km { background: var(--km-brown); color: #fff; border: none; }
    .btn-km:hover { background: #4f200d; color: #fff; }
    .btn-gold { background: var(--km-gold); color: #3b1a08; border: none; font-weight: 600; }
    .btn-gold:hover { background: #cf8a22; color: #3b1a08; }

    .hero {
        background: linear-gradient(135deg, var(--km-brown) 0%, #9a4a1f 100%);
        color: #fff;
    }
    .hero .badge-gold { background: var(--km-gold); color: #3b1a08; }

    .category-card {
        background: var(--km-cream);
        border: 1px solid #f0dfc4;
        border-radius: 12px;
        transition: transform .2s, box-shadow .2s;
        text-decoration: none;
        color: var(--km-brown);
        font-weight: 600;
    }
    .category-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(107, 45, 18, .15);
        color: var(--km-brown);
    }

    .product-card { border: 0; border-radius: 16px; overflow: hidden; transition: transform .2s, box-shadow .2s; }
    .product-card:hover { transform: translateY(-4px); box-shadow: 0 10px 24px rgba(0,0,0,.12); }
    .product-img {
        height: 140px;
        background: var(--km-cream);
        color: var(--km-brown);
        font-weight: 600;
        opacity: .85;
    }
    .price { color: var(--km-brown); font-weight: 700; }

    .section-title { color: var(--km-brown); font-weight: 700; }
    .section-title::after {
        content: ""; display: block; width: 60px; height: 4px;
        background: var(--km-gold); border-radius: 2px; margin-top: 8px;
    }

    .feature-number {
        font-size: 36px; font-weight: 800;
        color: var(--km-gold);
        line-height: 1;
    }
    .cta { background: var(--km-cream); border-radius: 24px; }
</style>

<section class="hero py-5">
    <div class="container py-5 text-center">
       
        <h1 class="display-4 fw-bold">Everything you need,<br>all at KemraMart</h1>
        <p class="lead mt-3 mb-4 opacity-75">
            Great prices, quality products, and easy shopping from the comfort of your home.
        </p>
        <a href="{{ route('shop') }}" class="btn btn-gold btn-lg px-4 me-2">Shop Now</a>
        @guest
            <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg px-4">Sign Up</a>
        @endguest
    </div>
</section>

{{-- 2. CATEGORIES --}}
<section class="container my-5 pt-3">
    <h3 class="section-title mb-4">Shop by Category</h3>
    <div class="row g-3">
        @foreach($categories as $category)
            <div class="col-6 col-md-4 col-lg-2">
                <a href="#" class="category-card d-block text-center py-3 px-2 h-100">
                    {{ $category }}
                </a>
            </div>
        @endforeach
    </div>
</section>

<section class="container my-5" id="products">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <h3 class="section-title mb-0">Popular Products</h3>
        <a href="{{ route('shop') }}" class="text-decoration-none" style="color: var(--km-brown);">View all →</a>
    </div>

    <div class="row g-4">
        @forelse($products as $product)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card product-card h-100 shadow-sm">
                    <div class="product-img d-flex align-items-center justify-content-center text-center px-2">
                        {{ $product['category'] }}
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title">{{ $product['name'] }}</h6>
                        <p class="price mt-auto mb-2">${{ number_format($product['price'], 2) }}</p>

                        @auth
                            <button class="btn btn-km btn-sm w-100">Add to Cart</button>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-dark btn-sm w-100">Login to Buy</a>
                        @endauth
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">No products available yet.</p>
        @endforelse
    </div>
</section>

<section class="container my-5 py-4">
    <h3 class="section-title mb-4">Why Choose Us</h3>
    <div class="row g-4">
        <div class="col-6 col-lg-3">
            <div class="feature-number mb-2">01</div>
            <h6 class="fw-bold">Fast Delivery</h6>
            <p class="text-muted small">Delivered to your door in the shortest time possible.</p>
        </div>
        <div class="col-6 col-lg-3">
            <div class="feature-number mb-2">02</div>
            <h6 class="fw-bold">Fair Prices</h6>
            <p class="text-muted small">Good prices every single day.</p>
        </div>
        <div class="col-6 col-lg-3">
            <div class="feature-number mb-2">03</div>
            <h6 class="fw-bold">Quality Guaranteed</h6>
            <p class="text-muted small">Every item is carefully selected.</p>
        </div>
        <div class="col-6 col-lg-3">
            <div class="feature-number mb-2">04</div>
            <h6 class="fw-bold">Always Here to Help</h6>
            <p class="text-muted small">Our team is ready whenever you need us.</p>
        </div>
    </div>
</section>

{{-- 5. CTA --}}
<section class="container mb-5">
    <div class="cta text-center p-5">
        <h3 class="fw-bold" style="color: var(--km-brown);">Start shopping with KemraMart today</h3>
        <p class="text-muted">Sign up for free and track your orders with ease.</p>
        @guest
            <a href="{{ route('register') }}" class="btn btn-km btn-lg px-5">Sign Up Now</a>
        @else
            <a href="{{ route('shop') }}" class="btn btn-km btn-lg px-5">Go to Shop</a>
        @endguest
    </div>
</section>

@endsection
 
</body>
</html>