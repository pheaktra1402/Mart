<div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name"
           class="form-control @error('name') is-invalid @enderror"
           value="{{ old('name', $product->name ?? '') }}">
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Category</label>
    <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
        <option value="">Select a category</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}"
                @selected(old('category_id', $product->category_id ?? '') == $category->id)>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('category_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Price ($)</label>
        <input type="number" step="0.01" min="0" name="price"
               class="form-control @error('price') is-invalid @enderror"
               value="{{ old('price', $product->price ?? '') }}">
        @error('price')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Stock</label>
        <input type="number" min="0" name="stock"
               class="form-control @error('stock') is-invalid @enderror"
               value="{{ old('stock', $product->stock ?? 0) }}">
        @error('stock')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<button type="submit" class="btn btn-dark">Save</button>
<a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Cancel</a>