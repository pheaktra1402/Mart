<?php

namespace App\Http\Controllers;

use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        return view('users.cart');
    }

    public function add(Product $product)
    {
        $cart = session('cart', []);
        $currentQty = $cart[$product->id]['quantity'] ?? 0;

        if ($currentQty >= $product->stock) {
            return back()->with('error', 'Sorry, no more stock for ' . $product->name);
        }

        $cart[$product->id] = [
            'name'     => $product->name,
            'price'    => $product->price,
            'quantity' => $currentQty + 1,
        ];

        session(['cart' => $cart]);

        return back()->with('success', $product->name . ' added to cart');
    }

    public function remove(Product $product)
    {
        $cart = session('cart', []);
        unset($cart[$product->id]);
        session(['cart' => $cart]);

        return back()->with('success', 'Item removed');
    }
}

