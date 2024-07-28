<!-- resources/views/client/products/show.blade.php -->

@extends('layouts.client')

@section('content')
    <div class="container mt-4">
        <h1>Chi tiết sản phẩm</h1>

        <div class="row">
            <div class="col-md-4">
                <img src="{{ $product->image }}" class="img-fluid" alt="{{ $product->name }}">
            </div>
            <div class="col-md-8">
                <h2>{{ $product->name }}</h2>
                <p>{{ $product->description }}</p>
                <p>Giá bán: {{ $product->price }}$</p>
                <p><strong>Danh mục:</strong> {{ $product->category->name }}</p>
                <!-- Thêm các thông tin khác nếu cần -->
                <a href="{{ route('client.products.index') }}" class="btn btn-primary">Trở về danh sách sản phẩm</a>
            </div>
        </div>
    </div>
@endsection
