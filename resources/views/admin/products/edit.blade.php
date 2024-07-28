<!-- resources/views/admin/products/edit.blade.php -->

@extends('layouts.admin')

@section('content')
    <h1>Edit Product</h1>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ $product->name }}" required>
        <br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required>{{ $product->description }}</textarea>
        <br>
        <label for="price">Price:</label>
        <input type="text" id="price" name="price" value="{{ $product->price }}" required>
        <br>
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value="{{ $product->quantity }}" required>
        <br>
        <label for="category_id">Category:</label>
        <select id="category_id" name="category_id" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <br>
        <button type="submit">Update Product</button>
    </form>
@endsection
