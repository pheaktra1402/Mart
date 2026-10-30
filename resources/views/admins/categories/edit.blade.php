@extends('layouts.admin')

@section('title', 'Edit Category')

@section('admin_content')
    <h3 class="mb-3">Edit Category</h3>

    <div class="card shadow-sm border-0" style="max-width: 500px;">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.categories.update', $category) }}">
                @csrf
                @method('PUT')
                @include('admins.categories.form')
            </form>
        </div>
    </div>
@endsection