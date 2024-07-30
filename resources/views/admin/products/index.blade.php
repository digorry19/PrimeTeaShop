<!-- resources/views/admin/products/index.blade.php -->

@extends('layouts.admin')

@section('css')
    <style>
        .content-section {
            margin-top: 20px; /* Điều chỉnh khoảng cách lề trên của cả menu và bảng */
        }
    </style>
@endsection

@section('content')
    <div class="row content-section">
        <div class="col-md-3">
            @include('admin.partials.menu') <!-- Menu bên trái -->
        </div>
        <div class="col-md-9">
            <h1>Product List</h1>
            <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add New Product</a>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>${{ $product->price }}</td>
                            <td><img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="100"></td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td class="d-flex gap-1">
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning ">Edit</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="pagination-wrapper">
        {{ $products->links() }}
    </div>
@endsection
