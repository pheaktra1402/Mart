@extends('layouts.admin')

@section('title', 'New Category')

@section('admin_content')
    <h3 class="mb-3">New Category</h3>

    <div class="card shadow-sm border-0" style="max-width: 500px;">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.categories.store') }}">
                @csrf
                @include('admins.categories.form')
            </form>
        </div>
    </div>
@endsection