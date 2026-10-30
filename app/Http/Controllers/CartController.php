<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart  = session('cart', []);
        $total = collect($cart)->sum(fn ($i) => $i['price'] * $i['quantity']);

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Product $product)
    {
        $cart = session('cart', []);
        $qty  = ($cart[$product->id]['quantity'] ?? 0) + 1;

        if ($qty > $product->stock) {
            return back()->with('error', "Sorry not enough stock for {$product->name}.");
        }

        $cart[$product->id] = [
            'name'     => $product->name,
            'price'    => $product->price,
            'image'    => $product->image,
            'quantity' => $qty,
        ];

        session(['cart' => $cart]);

        return back()->with('success', "{$product->name} added to cart.");
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate(['quantity' => ['required', 'integer', 'min:1']]);

        if ($data['quantity'] > $product->stock) {
            return back()->with('error', "Sorry only {$product->stock} left for {$product->name}.");
        }

        $cart = session('cart', []);
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] = $data['quantity'];
            session(['cart' => $cart]);
        }

        return back();
    }

    public function remove(Product $product)
    {
        $cart = session('cart', []);
        unset($cart[$product->id]);
        session(['cart' => $cart]);

        return back();
    }
}