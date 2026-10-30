@extends('layouts.admin')

@section('title', 'Update Stock')

@section('admin_content')
    <h3 class="mb-3">Update Stock</h3>

    <div class="card shadow-sm border-0" style="max-width: 500px;">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.stock.update', $product) }}">
                @csrf
                @method('PUT')

                {{-- Read-only information --}}
                <div class="mb-3">
                    <label class="form-label">Product</label>
                    <input type="text" class="form-control" value="{{ $product->name }}" disabled>
                </div>

                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <input type="text" class="form-control"
                           value="{{ $product->category->name ?? 'Uncategorized' }}" disabled>
                </div>

                <div class="mb-3">
                    <label class="form-label">Current stock</label>
                    <input type="text" class="form-control" value="{{ $product->stock }}" disabled>
                </div>

                {{-- The only editable field --}}
                <div class="mb-4">
                    <label class="form-label">Quantity to add</label>
                    <input type="number" name="quantity" min="1" step="1"
                           class="form-control @error('quantity') is-invalid @enderror"
                           value="{{ old('quantity') }}" placeholder="e.g. 20" autofocus>
                    @error('quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">
                        New stock will be current stock + this number.
                    </div>
                </div>

                <button type="submit" class="btn btn-dark">Update</button>
                <a href="{{ route('admin.stock.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection