<?php
use App\Http\Controllers\ShopController;
use App\Models\Category;
use App\Models\Product;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/cart', fn () => view('users.cart'))->name('cart');
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'store']);
});


Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/userdashboard', fn () => view('users.dashboard'))->name('user.dashboard');
    Route::get('/shop', [ShopController::class, 'shop'])->name('shop');
});


Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', fn () => view('admins.dashboard'))->name('admin.dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('admin.users');
});