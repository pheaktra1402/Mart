<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    @if(session('success'))
    <div style="color: green;">{{ session('success') }}</div>
@endif

    <form method="POST" action="/login" novalidate>
         @csrf
    <div>
    <h3>Login</h3>
    <div>
    <label>Email</label>
    <input type="email" name="email" placeholder="Your email" required value="{{ old('email') }}" ><br>
     @error('email')
            <div style="color: red; font-size: 13px;">{{ $message }}</div>
        @enderror
    </div>
    <div>
    <label>Password</label>
    <input type="password" name="password" placeholder="Your password" required>
     @error('password')
            <div style="color: red; font-size: 13px;">{{ $message }}</div>
        @enderror
</div>
    <button type="submit">Login</button>
</div>
</form>
</body>
</html>