<?php

namespace App\Http\Controllers;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }
    public function login(){
        return view('users.userdahboard');
    }
    public function showRegister()
    {
        return view('register');
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            // check before store in database
            'name' => ['required', 'string', 'max:225'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required']
        ]);
        //store in database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        Auth::login($user);
        return redirect()->to('/login')->with('Register successful');



    }
}
