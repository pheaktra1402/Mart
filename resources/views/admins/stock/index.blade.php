@extends('layouts.admin')

@section('title', 'Stock')

@section('admin_content')
    <h3 class="mb-3">Stock</h3>

    <form method="GET" class="row g-2 mb-3">
        <div class="col-md-5">
            <input type="text" name="search" class="form-control"
                   placeholder="Search product" value="{{ request('search') }}">
        </div>
        <div class="col-md-4">
            <select name="status" class="form-select">
                <option value="">All stock levels</option>
                <option value="low" @selected(request('status') == 'low')>Low (1-10)</option>
                <option value="out" @selected(request('status') == 'out')>Out of stock</option>
            </select>
        </div>
       
    </form>

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Stock</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>
                                <a href="{{ route('admin.stock.edit', $product) }}"
                                   class="text-decoration-none fw-semibold text-dark">
                                    {{ $product->name }}
                                </a>
                            </td>
                            <td>{{ $product->category->name ?? 'Uncategorized' }}</td>
                            <td>
                                <span class="badge {{ $product->stock == 0 ? 'bg-danger' : ($product->stock <= 10 ? 'bg-warning text-dark' : 'bg-success') }}">
                                    {{ $product->stock }}
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.stock.edit', $product) }}"
                                   class="btn btn-outline-dark btn-sm">Update Stock</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">{{ $products->links() }}</div>
@endsection