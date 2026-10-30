<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function store()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('shop')->with('error', 'Your cart is empty.');
        }

        try {
            DB::transaction(function () use ($cart) {
                // Lock the product rows so concurrent checkouts can't oversell
                $products = Product::whereIn('id', array_keys($cart))
                    ->lockForUpdate()
                    ->get()
                    ->keyBy('id');

                $total = 0;

                foreach ($cart as $id => $item) {
                    $product = $products[$id] ?? null;

                    if (!$product || $product->stock < $item['quantity']) {
                        throw new \RuntimeException(
                            "Not enough stock for {$item['name']}."
                        );
                    }

                    $total += $product->price * $item['quantity'];
                }

                $order = Order::create([
                    'user_id' => auth()->id(),
                    'total' => $total,
                ]);

                foreach ($cart as $id => $item) {
                    $product = $products[$id];

                    $order->items()->create([
                        'product_id' => $product->id,
                        'name' => $product->name,
                        'price' => $product->price,
                        'quantity' => $item['quantity'],
                    ]);

                    $product->decrement('stock', $item['quantity']);
                }
            });
        } catch (\RuntimeException $e) {
            return redirect()->route('cart.index')->with('error', $e->getMessage());
        }

        session()->forget('cart');

        return redirect()->route('shop')->with('success', 'Order placed. Thank you!');
    }
}