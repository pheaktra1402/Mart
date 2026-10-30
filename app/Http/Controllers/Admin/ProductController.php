<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Validation rules shared by store() and update()
    private function rules(): array
    {
        return [
            'name'        => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'price'       => ['required', 'numeric', 'min:0'],
            'stock'       => ['required', 'integer', 'min:0'],
        ];
    }

    // List products with search and category filter
    public function index(Request $request)
    {
        $products = Product::with('category')
            ->when($request->search, fn ($q, $s) => $q->where('name', 'like', "%{$s}%"))
            ->when($request->category, fn ($q, $id) => $q->where('category_id', $id))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admins.products.index', [
            'products'   => $products,
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    // Show the "new product" form
    public function create()
    {
        return view('admins.products.create', [
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    // Save a new product
    public function store(Request $request)
    {
        Product::create($request->validate($this->rules()));

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created.');
    }

    // Show the "edit product" form
    public function edit(Product $product)
    {
        return view('admins.products.edit', [
            'product'    => $product,
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    // Save changes to a product
    public function update(Request $request, Product $product)
    {
        $product->update($request->validate($this->rules()));

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated.');
    }

    // Delete a product
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted.');
    }
}