<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
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

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'change' => ['required', 'integer', 'not_in:0'],
        ]);

        $newStock = $product->stock + $data['change'];

        if ($newStock < 0) {
            return back()->with('error', "Stock for {$product->name} cannot go below 0.");
        }

        $product->update(['stock' => $newStock]);

        return back()->with('success', "Stock updated for {$product->name}.");
    }
}