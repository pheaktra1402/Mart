<?php

namespace App\Http\Controllers;

use App\Models\Order;

class UserDashboardController extends Controller
{
    public function index()
    {
        $cartCount = collect(session('cart', []))->sum('quantity');

        $orders = Order::withCount('items')
            ->where('user_id', auth()->id())
            ->latest()
            ->take(5)
            ->get();

        return view('users.dashboard', compact('cartCount', 'orders'));
    }
}