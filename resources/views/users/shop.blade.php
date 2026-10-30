@extends('layouts.app')

@section('title', 'Shop')

@section('content')
<div class="container my-4">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h1 class="h3 fw-bold mb-0">Shop Now</h1>
        </div>
        <form method="GET" action="{{ url()->current() }}" class="d-flex" style="max-width: 320px; width: 100%;">
            <input type="search" name="q" value="{{ request('q') }}"
                   class="form-control me-2" placeholder="Search products...">
            <button class="btn btn-dark" type="submit">Search</button>
        </form>
    </div>


    <div class="row g-4">
        @forelse($products as $product)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card h-100 border-0 shadow-sm product-card">

                    {{-- Image (placeholder if none) --}}
                    <div class="ratio ratio-1x1 bg-light rounded-top overflow-hidden">
                        @if(!empty($product->image))
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 alt="{{ $product->name }}"
                                 class="object-fit-cover">
                        @else
                            <div class="d-flex align-items-center justify-content-center text-muted">
                                No image
                            </div>
                        @endif
                    </div>

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fs-6 mb-1">{{ $product->name }}</h5>

                        <p class="fw-bold fs-5 mb-1">${{ number_format($product->price, 2) }}</p>

                        @if($product->stock > 10)
                            <span class="badge text-bg-success align-self-start mb-3">In stock</span>
                        @elseif($product->stock > 0)
                            <span class="badge text-bg-warning align-self-start mb-3">Only {{ $product->stock }} left</span>
                        @else
                            <span class="badge text-bg-secondary align-self-start mb-3">Out of stock</span>
                        @endif

                        @auth
                            <form method="POST" action="{{ route('cart.add', $product) }}" class="mt-auto">
                                @csrf
                                <button type="submit"
                                        class="btn btn-dark w-100"
                                        @disabled($product->stock < 1)>
                                    {{ $product->stock < 1 ? 'Sold out' : 'Add to cart' }}
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-dark w-100 mt-auto">
                                Login to Buy
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center text-muted py-5">
                    <p class="fs-5 mb-1">No products found</p>
                    <small>Try a different search.</small>
                </div>
            </div>
        @endforelse
    </div>

    @if(method_exists($products, 'links'))
        <div class="d-flex justify-content-center mt-4">
            {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
    @endif

</div>
@endsection

@push('styles')
<style>
    .product-card { transition: transform .15s ease, box-shadow .15s ease; }
    .product-card:hover { transform: translateY(-4px); box-shadow: 0 .5rem 1rem rgba(0,0,0,.12) !important; }
</style>
@endpush