<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>
<form method="POST" action="/register">
  @csrf
    <h3>Register</h3>
    <label>Full Name</label>
    <input type="text" placeholder="Your fullname" name="name" value="{{old('name')}}" required><br>
    <label>Email</label>
    <input type="email" placeholder="Your email" name="email" value="{{old('email')}}" required ><br>

    <label>Password</label>
    <input type="password" placeholder="Your password" name="password" value="{{old('password')}}" required ><br>
    <button type="submit">Register</button>
</form>
</body>
</html>