<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'POS Mart')</title>
</head>
<body>
    <nav>
        <a href="/">Home</a>

        @guest
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @endguest

        @auth
            @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
            @else
                <a href="{{ route('user.dashboard') }}">My Dashboard</a>
            @endif

            <span>{{ auth()->user()->name }}</span>

            <form method="POST" action="{{ route('logout') }}" style="display:inline">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @endauth
    </nav>

    <main>
        @yield('content')
    </main>
</body>
</html>