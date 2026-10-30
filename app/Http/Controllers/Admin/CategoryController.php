<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    // List all categories
    public function index()
    {
        $categories = Category::withCount('products')->latest()->paginate(10);

        return view('admins.categories.index', compact('categories'));
    }

    // Show the "new category" form
    public function create()
    {
        return view('admins.categories.create');
    }

    // Save a new category
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories,name'],
        ]);

        Category::create($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created.');
    }

    // Show the "edit category" form
    public function edit(Category $category)
    {
        return view('admins.categories.edit', compact('category'));
    }

    // Save changes to a category
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => [
                'required', 'string', 'max:255',
                Rule::unique('categories', 'name')->ignore($category->id),
            ],
        ]);

        $category->update($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated.');
    }

    // Delete a category (blocked if it still has products)
    public function destroy(Category $category)
    {
        if ($category->products()->exists()) {
            return back()->with('error', 'Cannot delete a category that still has products.');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted.');
    }
}