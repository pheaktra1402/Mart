<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    
    private function rules(bool $isUpdate = false): array
    {
        return [
            'name'        => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['nullable', 'string', 'max:255'],
            'image'       => [$isUpdate ? 'nullable' : 'required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'price'       => ['required', 'numeric', 'min:0'],
            'stock'       => ['required', 'integer', 'min:0'],
        ];
    }

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

    public function create()
    {
        return view('admins.products.create', [
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created.');
    }

    public function edit(Product $product)
    {
        return view('admins.products.edit', [
            'product'    => $product,
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate($this->rules(true));

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        } else {
           
            unset($data['image']);
        }

        $product->update($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted.');
    }
}