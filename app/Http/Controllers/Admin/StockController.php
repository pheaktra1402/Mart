<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    // List products with their stock
    public function index(Request $request)
    {
        $products = Product::with('category')
            ->when($request->search, fn ($q, $s) => $q->where('name', 'like', "%{$s}%"))
            ->when($request->status === 'low', fn ($q) => $q->where('stock', '>', 0)->where('stock', '<=', 10))
            ->when($request->status === 'out', fn ($q) => $q->where('stock', 0))
            ->orderBy('stock')
            ->paginate(15)
            ->withQueryString();

        return view('admins.stock.index', compact('products'));
    }

    // Show the update-stock form for one product
    public function edit(Product $product)
    {
        $product->load('category');

        return view('admins.stock.edit', compact('product'));
    }

    // Add the entered quantity to the current stock
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:100000'],
        ]);

        $product->increment('stock', $data['quantity']);

        return redirect()->route('admin.stock.index')
            ->with('success', "Added {$data['quantity']} to {$product->name}. New stock: " . ($product->stock + 0));
    }
}