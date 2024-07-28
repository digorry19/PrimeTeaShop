<!-- resources/views/admin/categories/create.blade.php -->

@extends('layouts.admin')

@section('content')
    <h1>Add New Category</h1>

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <button type="submit">Add Category</button>
    </form>
@endsection
