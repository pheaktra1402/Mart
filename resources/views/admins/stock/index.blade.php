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
        <div class="col-md-3">
            <button class="btn btn-outline-dark w-100">Filter</button>
        </div>
    </form>

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Stock</th>
                        <th style="width: 260px;">Add to stock</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name ?? 'Uncategorized' }}</td>
                            <td>
                                <span class="badge {{ $product->stock == 0 ? 'bg-danger' : ($product->stock <= 10 ? 'bg-warning text-dark' : 'bg-success') }}">
                                    {{ $product->stock }}
                                </span>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('admin.stock.update', $product) }}" class="d-flex gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="change" class="form-control form-control-sm"
                                           placeholder="e.g. 20 or -5" required>
                                    <button class="btn btn-dark btn-sm">Apply</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center text-muted py-4">No products found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">{{ $products->links() }}</div>
@endsection