@extends('layouts.app')

@section('title', 'Home')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
.home-hero {
    background: linear-gradient(135deg, #111827, #212529);
    padding: 70px 0 90px;
}
.home-hero h1 { font-weight: 800; letter-spacing: -1px; }
.text-gradient {
    background: linear-gradient(90deg, #ffe082, #ffc107);
    -webkit-background-clip: text; background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Search */
.search-box {
    max-width: 620px;
    margin: 28px auto 0;
    display: flex;
    background: #fff;
    border-radius: 50px;
    padding: 6px;
    box-shadow: 0 12px 30px rgba(0,0,0,.25);
}
.search-box input {
    flex: 1; border: 0; outline: 0; background: transparent;
    padding: 10px 20px; font-size: 16px; min-width: 0;
}
.search-box button {
    border: 0; border-radius: 50px;
    background: #ffc107; color: #212529; font-weight: 700;
    padding: 10px 26px;
    transition: background .2s ease;
}
.search-box button:hover { background: #ffb300; }

.cat-bar { margin-top: -28px; position: relative; z-index: 2; }
.cat-scroll {
    display: flex; gap: 10px; overflow-x: auto;
    padding: 14px; background: #fff;
    border-radius: 60px;
    box-shadow: 0 8px 26px rgba(0,0,0,.08);
    scrollbar-width: none;
}
.cat-scroll::-webkit-scrollbar { display: none; }
.cat-pill {
    flex-shrink: 0;
    padding: 8px 22px; border-radius: 40px;
    background: #f4f5f7; color: #444;
    font-weight: 600; font-size: 14px;
    text-decoration: none !important;
    transition: all .2s ease;
}
.cat-pill:hover { background: #fff3cd; color: #212529; }
.cat-pill.active { background: #212529; color: #fff; }

/* Products */
.result-info { color: #777; font-size: 14px; }

.product-card {
    height: 100%;
    background: #fff;
    border: 1px solid #eee;
    border-radius: 16px;
    overflow: hidden;
    transition: transform .25s ease, box-shadow .25s ease;
}
.product-card:hover { transform: translateY(-6px); box-shadow: 0 16px 36px rgba(0,0,0,.1); }

.product-img {
    position: relative;
    aspect-ratio: 1 / 1;
    background: #f4f5f7;
    display: flex; align-items: center; justify-content: center;
    color: #ced4da; font-size: 46px;
    overflow: hidden;
}
.product-img img { width: 100%; height: 100%; object-fit: cover; transition: transform .4s ease; }
.product-card:hover .product-img img { transform: scale(1.06); }

.stock-badge {
    position: absolute; top: 10px; left: 10px;
    font-size: 11px; font-weight: 700;
    padding: 4px 10px; border-radius: 20px;
}
.stock-out { background: #dc3545; color: #fff; }
.stock-low { background: #fff3cd; color: #8a6d00; }

.product-body { padding: 16px; }
.product-cat { font-size: 11px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; color: #b88900; }
.product-name {
    font-size: 16px; font-weight: 700; color: #212529;
    margin: 4px 0 6px;
    display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
}
.product-price { font-size: 18px; font-weight: 800; color: #212529; }

/* Price on the left, cart button on the right */
.buy-row {
    display: flex; align-items: center; justify-content: space-between;
    gap: 8px; margin-top: 12px;
}
.buy-row form { margin: 0; }

.buy-btn {
    border: 0; border-radius: 10px;
    padding: 9px 14px;
    background: #212529; color: #fff;
    font-weight: 600; font-size: 14px;
    white-space: nowrap;
    transition: all .2s ease;
}
.buy-btn:hover:not(:disabled) { background: #ffc107; color: #212529; transform: translateY(-2px); }
.buy-btn:disabled { background: #e9ecef; color: #adb5bd; cursor: not-allowed; }

/* Popular */
.popular-section { background: #fff; border-top: 1px solid #eee; border-bottom: 1px solid #eee; }
.popular-title { font-weight: 800; letter-spacing: -.5px; color: #212529; }
.popular-title i { color: #ff6a00; }
.popular-badge {
    position: absolute; top: 10px; left: 10px;
    background: linear-gradient(135deg, #ff9800, #ff5722);
    color: #fff; font-size: 11px; font-weight: 700;
    padding: 4px 10px; border-radius: 20px;
}

.empty-state { padding: 70px 0; text-align: center; color: #777; }
.empty-state i { font-size: 52px; color: #ced4da; }
.view-all {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 8px 18px; border-radius: 40px;
    border: 1.5px solid #212529; color: #212529;
    font-weight: 600; font-size: 14px;
    text-decoration: none !important;
    white-space: nowrap;
    transition: all .2s ease;
}
.view-all:hover { background: #212529; color: #fff; }
.view-all:hover i { transform: translateX(3px); }
.view-all i { transition: transform .2s ease; }

@media (max-width: 575px) {
    .home-hero { padding: 50px 0 80px; }
    .home-hero h1 { font-size: 30px; }
    .product-body { padding: 12px; }
    .product-name { font-size: 14px; }
    .product-price { font-size: 16px; }
    .buy-btn { padding: 8px 11px; font-size: 13px; }
}
</style>

{{-- HERO + SEARCH --}}
<section class="home-hero text-center text-white">
    <div class="container">
        <h1 class="display-5"><span class="text-gradient">Khmer</span> Products</h1>
        <p class="text-white-50 mb-0">Find something special from local Cambodian makers.</p>

        <form action="{{ route('home') }}" method="GET" class="search-box">
            @if(request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products...">
            <button type="submit"><i class="bi bi-search me-1"></i> Search</button>
        </form>
    </div>
</section>

<section class="cat-bar">
    <div class="container">
        <div class="cat-scroll">
            <a href="{{ route('home', array_filter(['search' => request('search')])) }}"
               class="cat-pill {{ request()->filled('category') ? '' : 'active' }}">
                All
            </a>

            @foreach ($categories as $category)
                <a href="{{ route('home', array_filter(['category' => $category->id, 'search' => request('search')])) }}"
                   class="cat-pill {{ (string) request('category') === (string) $category->id ? 'active' : '' }}">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>
</section>

@if ($popular && $popular->count())
<section class="popular-section py-5 mt-5">
    <div class="container">
        <div class="mb-4">
            <h2 class="popular-title h3 mb-1"><i class="bi bi-fire me-1"></i> Popular Products</h2>
            <p class="text-muted mb-0">Our best sellers, loved by customers.</p>
        </div>

        <div class="row g-3 g-md-4">
            @foreach ($popular as $product)
                <div class="col-6 col-md-3">
                    <div class="product-card">
                        <div class="product-img">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" loading="lazy">
                            @else
                                <i class="bi bi-image"></i>
                            @endif

                            <span class="popular-badge">
                                <i class="bi bi-fire"></i> {{ $loop->first ? 'Best seller' : 'Popular' }}
                            </span>
                        </div>

                        <div class="product-body">
                            <div class="product-name">{{ $product->name }}</div>

                            <div class="buy-row">
                                <div class="product-price">${{ number_format($product->price, 2) }}</div>

                                <form action="{{ url('/cart/add/' . $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="buy-btn" aria-label="Add {{ $product->name }} to cart" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                        @if ($product->stock <= 0)
                                            Sold out
                                        @else
                                            <i class="bi bi-cart-plus me-1"></i> Add
                                        @endif
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="py-5">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
           <a href="{{ route('shop') }}" class="view-all">
    View all products <i class="bi bi-arrow-right"></i>
</a>
            @if(request('search') || request('category'))
                <a href="{{ route('home') }}" class="btn btn-sm btn-outline-dark rounded-pill px-3">
                    <i class="bi bi-x-lg me-1"></i> Clear filters
                </a>
            @endif
        </div>

        @if ($products->count())
            <div class="row g-3 g-md-4">
                @foreach ($products as $product)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="product-card">
                            <div class="product-img">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" loading="lazy">
                                @else
                                    <i class="bi bi-image"></i>
                                @endif

                                @if ($product->stock <= 0)
                                    <span class="stock-badge stock-out">Out of stock</span>
                                @elseif ($product->stock <= 5)
                                    <span class="stock-badge stock-low">Only {{ $product->stock }} left</span>
                                @endif
                            </div>

                            <div class="product-body">
                                <div class="product-name">{{ $product->name }}</div>

                                <div class="buy-row">
                                    <div class="product-price">${{ number_format($product->price, 2) }}</div>
                                    <form action="{{ url('/cart/add/' . $product->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="buy-btn" aria-label="Add {{ $product->name }} to cart" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                            @if ($product->stock <= 0)
                                                Sold out
                                            @else
                                                <i class="bi bi-cart-plus me-1"></i> Add
                                            @endif
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-5 d-flex justify-content-center">
                {{ $products->links() }}
            </div>
        @else
            <div class="empty-state">
                <i class="bi bi-search"></i>
                <h5 class="mt-3 text-dark">No products found</h5>
                <p class="mb-0">Try a different search or category.</p>
            </div>
        @endif

    </div>
</section>

@endsection