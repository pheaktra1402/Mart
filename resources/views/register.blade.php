<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>
<form method="POST" action="/register" novalidate>
  @csrf
    <h3>Register</h3>
    <div>
    <label>Full Name</label>
    <input type="text" placeholder="Your fullname" name="name" value="{{old('name')}}" required><br>
  @error('name')
            <div style="color: red; font-size: 13px;">{{ $message }}</div>
        @enderror
  </div>
  <div>
    <label>Email</label>
    <input type="email" placeholder="Your email" name="email" value="{{old('email')}}" required ><br>
     @error('email')
            <div style="color: red; font-size: 13px;">{{ $message }}</div>
        @enderror
</div>
<div>
    <label>Password</label>
    <input type="password" placeholder="Your password" name="password" required ><br>
     @error('password')
            <div style="color: red; font-size: 13px;">{{ $message }}</div>
        @enderror
    </div>
    <div>
    <label>Confirm Password</label>
    <input type="password" name="password_confirmation" required><br>
    @error('password_confirmation')
        <div style="color: red; font-size: 13px;">{{ $message }}</div>
    @enderror 
  </div>
   
    <button type="submit">Register</button>
</form>
</body>
</html>