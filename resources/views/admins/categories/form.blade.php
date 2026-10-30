<div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name"
           class="form-control @error('name') is-invalid @enderror"
           value="{{ old('name', $category->name ?? '') }}">
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<button type="submit" class="btn btn-dark">Save</button>
<a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">Cancel</a>