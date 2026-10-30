{{-- resources/views/about.blade.php --}}
@extends('layouts.app')

@section('title', 'About')

@section('content')

<section id="about" class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center g-5">

            <div class="col-lg-6">
                <img src="{{ asset('image/martview.jpg') }}" alt="About KemraMart"
                     class="img-fluid rounded-4 shadow-sm">
            </div>

            <div class="col-lg-6">
                <span class="text-warning fw-semibold text-uppercase small">About us</span>
                <h2 class="fw-bold mt-1 mb-3">Fresh products, delivered with care</h2>
                <p class="text-muted">
                    KemraMart is an online shop that brings quality everyday products to your door.
                    We work with trusted suppliers so you always get fair prices and
                    products you can rely on.
                </p>
                <p class="text-muted mb-4">
                    Our mission is simple: make shopping easy, fast, and enjoyable for everyone.
                </p>

                <div class="row g-3">
                    <div class="col-sm-4">
                        <div class="text-center p-3 bg-white rounded-3 shadow-sm h-100">
                            <i class="bi bi-patch-check fs-2 text-warning"></i>
                            <h6 class="fw-bold mt-2 mb-0">Quality</h6>
                            <small class="text-muted">Checked products</small>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="text-center p-3 bg-white rounded-3 shadow-sm h-100">
                            <i class="bi bi-truck fs-2 text-warning"></i>
                            <h6 class="fw-bold mt-2 mb-0">Fast delivery</h6>
                            <small class="text-muted">Right to your door</small>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="text-center p-3 bg-white rounded-3 shadow-sm h-100">
                            <i class="bi bi-tag fs-2 text-warning"></i>
                            <h6 class="fw-bold mt-2 mb-0">Fair price</h6>
                            <small class="text-muted">No hidden fees</small>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
    
@endsection