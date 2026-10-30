@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<style>
.eyebrow {
    color: #b88900;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    margin-bottom: 10px;
}

/* Contact rows */
.simple-card {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 20px 22px;
    background: #fff;
    border: 1px solid #e9ecef;
    border-radius: 14px;
    text-decoration: none !important;
    transition: border-color .2s ease, box-shadow .2s ease;
}
.simple-card > i:first-child { font-size: 26px; color: #212529; }
.simple-card h6 { margin: 0 0 2px; font-weight: 700; color: #212529; }
.simple-card span { font-size: 14px; color: #777; text-decoration: none; }
.simple-card .arrow { margin-left: auto; color: #adb5bd; transition: transform .2s ease, color .2s ease; }

.simple-card:hover { border-color: #ffc107; box-shadow: 0 6px 18px rgba(0,0,0,.06); }
.simple-card:hover .arrow { color: #b88900; transform: translateX(4px); }

/* Visit */
.simple-visit { background: #f8f9fa; }
.simple-visit h2 { font-size: 30px; color: #212529; }
.simple-visit h6 { font-weight: 700; color: #212529; }

.simple-map {
    height: 360px;
    border-radius: 16px;
    overflow: hidden;
    border: 1px solid #e9ecef;
}

@media (max-width: 575px) {
    .simple-header { padding: 55px 0 30px; }
    .simple-header h1 { font-size: 32px; }
    .simple-map { height: 280px; }
}
</style>

<section class="simple-header text-center">
    <div class="container">
        <p class="text-muted mx-auto mb-3" style="max-width: 480px;">
            Questions about our products or your order? Send us a message and we'll reply as soon as we can.Thank You!
        </p>
    </div>
</section>


{{-- CONTACT OPTIONS --}}
<section class="pb-5">
    <div class="container" style="max-width: 900px;">
        <div class="row g-3">

            <div class="col-md-6">
                <a href="https://t.me/your_username" target="_blank" rel="noopener noreferrer" class="simple-card">
                    <i class="bi bi-telegram"></i>
                    <div>
                        <h6>Telegram</h6>
                        <span>@kemramart</span>
                    </div>
                    <i class="bi bi-arrow-right arrow"></i>
                </a>
            </div>

            <div class="col-md-6">
                <a href="tel:+85500000000" class="simple-card">
                    <i class="bi bi-telephone"></i>
                    <div>
                        <h6>Phone</h6>
                        <span>+855 99 999 999</span>
                    </div>
                    <i class="bi bi-arrow-right arrow"></i>
                </a>
            </div>

            <div class="col-md-6">
                <a href="mailto:hello@kemramart.com" class="simple-card">
                    <i class="bi bi-envelope"></i>
                    <div>
                        <h6>Email</h6>
                        <span>kemramart@gmail.com</span>
                    </div>
                    <i class="bi bi-arrow-right arrow"></i>
                </a>
            </div>

            <div class="col-md-6">
                <a href="https://facebook.com/your_page" target="_blank" rel="noopener noreferrer" class="simple-card">
                    <i class="bi bi-facebook"></i>
                    <div>
                        <h6>Facebook</h6>
                        <span>KemraMart</span>
                    </div>
                    <i class="bi bi-arrow-right arrow"></i>
                </a>
            </div>

        </div>
    </div>
</section>


{{-- VISIT --}}
<section class="simple-visit py-5">
    <div class="container" style="max-width: 900px;">
        <div class="row g-4 align-items-center">

            <div class="col-md-5">
                <p class="eyebrow">Visit us</p>
                <h2 class="fw-bold mb-4">Our shop</h2>

                <div class="mb-3">
                    <h6 class="mb-1">Address</h6>
                    <p class="text-muted mb-0">Your shop address here, Phnom Penh, Cambodia</p>
                </div>

                <div class="mb-4">
                    <h6 class="mb-1">Opening hours</h6>
                    <p class="text-muted mb-0">
                        Mon – Fri: 8:00 AM – 8:00 PM<br>
                        Sat – Sun: 8:00 AM – 6:00 PM
                    </p>
                </div>

                <a href="https://maps.google.com/?q=Phnom+Penh" target="_blank" rel="noopener noreferrer"
                   class="btn btn-dark rounded-pill px-4">
                    Get directions
                </a>
            </div>

            <div class="col-md-7">
                <div class="simple-map">
                    <iframe
                        src="https://www.google.com/maps?q=Phnom+Penh&output=embed"
                        width="100%" height="100%"
                        style="border:0;"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="KemraMart shop location">
                    </iframe>
                </div>
            </div>

        </div>
    </div>
</section>


{{-- CTA --}}
<section class="py-5 text-center">
    <div class="container">
        <h3 class="fw-bold mb-2">Looking for something special?</h3>
        <p class="text-muted mb-4">Explore authentic Khmer products.</p>
        <a href="{{ route('shop') }}" class="btn btn-warning px-4 fw-semibold rounded-pill">
            Shop now <i class="bi bi-arrow-right ms-1"></i>
        </a>
    </div>
</section>

@endsection