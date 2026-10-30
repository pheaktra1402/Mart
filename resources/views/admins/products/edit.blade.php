@extends('layouts.admin')

@section('title', 'Edit Product')

@section('admin_content')
    <h3 class="mb-3">Edit Product</h3>

    <div class="card shadow-sm border-0" style="max-width: 600px;">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.products.update', $product) }}">
                @csrf
                @method('PUT')
                @include('admins.products.form')
            </form>
        </div>
    </div>
@endsection