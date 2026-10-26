<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/user',[UserController::class, 'index']);
Route::get('/login',[AuthController::class, 'showLogin']);
Route::post('/login',[AuthController::class,'login']);
Route::get('/register',[AuthController::class, 'showRegister']);
Route::post('/register',[AuthController::class, 'store']);
