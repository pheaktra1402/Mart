<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Storage;
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

   
    public function edit(Product $product)
    {
        $product->load('category');

        return view('admins.stock.edit', compact('product'));
    }

    
   public function update(Request $request, Product $product)
{
    $data = $request->validate([
        'quantity' => ['required', 'integer', 'min:1'],
        'image'    => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
    ]);

    if ($request->hasFile('image')) {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->image = $request->file('image')->store('products', 'public');
    }

    $product->stock += $data['quantity'];
    $product->save();

    return redirect()->route('admin.stock.index')->with('success', 'Stock updated.');
}
}