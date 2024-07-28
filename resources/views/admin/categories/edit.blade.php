<!-- resources/views/admin/categories/edit.blade.php -->

@extends('layouts.admin')

@section('content')
    <h1>Edit Category</h1>

    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ $category->name }}" required>
        <br>
        <button type="submit">Update Category</button>
    </form>
@endsection
