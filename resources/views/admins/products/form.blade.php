<div class="row g-4">
  
    <div class="col-md-4">
        <label class="form-label">Image</label>

        <div class="border rounded d-flex align-items-center justify-content-center bg-light mb-2"
             style="height: 200px; overflow: hidden;">
            @if (!empty($product->image))
                <img src="{{ asset('storage/' . $product->image) }}" alt="Current image"
                     style="width: 100%; height: 100%; object-fit: cover;">
            @else
                <span class="text-muted">No image</span>
            @endif
        </div>

        <input type="file" name="image" accept="image/*"
               class="form-control @error('image') is-invalid @enderror">
        @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>


    <div class="col-md-8">
        <div class="row g-3">
            <div class="col-md-7">
                <label class="form-label">Name</label>
                <input type="text" name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $product->name ?? '') }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-5">
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

            <div class="col-md-6">
                <label class="form-label">Price ($)</label>
                <input type="number" step="0.01" min="0" name="price"
                       class="form-control @error('price') is-invalid @enderror"
                       value="{{ old('price', $product->price ?? '') }}">
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
<div class="col-md-6">
    <label class="form-label">Stock</label>
    <input type="number" min="0" name="stock"
           class="form-control"
           @if (isset($product)) readonly @endif
           value="{{ old('stock', $product->stock ?? 0) }}">
    {{-- @if (isset($product))
        <div class="form-text">Change stock from the Stock page.</div>
    @endif --}}
</div>

            <div class="col-12">
                <label class="form-label">Description</label>
                <textarea name="description" rows="3"
                          class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description ?? '') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    <button type="submit" class="btn btn-dark">Save</button>
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Cancel</a>
</div>