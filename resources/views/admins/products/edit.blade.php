@extends('layouts.admin')

@section('title', 'Edit Product')

@section('admin_content')
    <h3 class="mb-3">Edit Product</h3>

    <div class="card shadow-sm border-0" style="max-width: 600px;">
        <div class="card-body">
           <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
    @csrf
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    @method('PUT')
    @include('admins.products.form')
</form>
        </div>
    </div>
@endsection