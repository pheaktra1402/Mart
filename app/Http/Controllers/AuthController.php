<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate(
            [
                'email' => ['required', 'email'],
                'password' => ['required'],
            ],
            [
                'email.required' => 'Please enter your email.',
                'email.email' => 'Invalid email fomart(@example.com)',
                'password.required' => 'Please enter your password.'
            ]
        );
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return Auth::user()->isAdmin()
                ? redirect()->route('admin.dashboard')
                : redirect()->route('user.dashboard');
        }
        return back()
            ->withErrors(['email' => 'Email or password is incorrect'])
            ->onlyInput('email');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    public function showRegister()
    {
        return view('register');
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate(
            [
                // check before store in database
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'unique:users'],
                'password' => ['required', 'min:6', 'confirmed'],
            ],
            [
                'name' => 'Please enter your name',
                'email.required' => 'Please enter your email',
                'email.email' => 'Invalid email fomart (@example.com)',
                'email.unique' => 'This email is already in use',
                'password.required' => 'Please enter your password',
                'password.min' => 'Password must be at least 6 characters',
                'password_confirmation' => 'Password confirmation does not match',
            ]
        );
        //store in database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        Auth::login($user);
        return redirect()->route('user.dashboard')->with('success', 'Register successful');//key, value



    }
}
