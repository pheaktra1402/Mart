<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('image/KemraMart_logo.png') }}">
    <title>@yield('title', 'KemraMart')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                <img src="{{ asset('image/KemraMart_logo.png') }}" height="60" alt="KemraMart logo">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="nav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>

                 
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('shop') }}">Shop</a>
                    </li>
                     <li class="nav-item">
                                <a class="nav-link" href="{{ route('cart.index') }}">
                                    Cart
                                    <span class="badge rounded-pill bg-dark">
                                        {{ collect(session('cart', []))->sum('quantity') }}
                                    </span>
                                </a>
                            </li>

                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-warning btn-sm" href="{{ route('register') }}">Register</a>
                        </li>
                    @endguest

                  @auth
    @if(auth()->user()->role === 'admin')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
        </li>
    @endif

    <li class="nav-item">
        <a class="nav-link" href="{{ route('user.dashboard') }}">My Dashboard</a>
    </li>


                        <li class="nav-item">
                            <span class="navbar-text">Hello, {{ auth()->user()->name }}</span>
                        </li>

                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-outline-dark btn-sm">Logout</button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="flex-grow-1">
    @if(session('success'))
    <div class="container mt-3">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
@endif

     @if(session('error'))
    <div class="container mt-3">
        <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif

        @yield('content')
    </main>

    <footer class="bg-dark text-white-50 text-center py-3 mt-5">
        <small>&copy; {{ date('Y') }} KemraMart. All rights reserved. | Developed by Thorn Chansopheaktra</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>