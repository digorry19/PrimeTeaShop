<!-- resources/views/client/products/index.blade.php -->

@extends('layouts.client')

@section('content')
    

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="container text-center">
        <div class="row">
            <div class="col-4">
                <h3>Danh sách danh mục</h3>
                <!-- Hiển thị danh sách các danh mục với liên kết lọc -->
                <ul class="list-group">
                    <a class="list-group-item list-group-item-primary" href="{{ route('client.products.index')}}">Tất cả sản phẩm</a>
                    @foreach ($categories as $category)
                        <li class="list-group-item">
                            <a class="list-group-item list-group-item-success" href="{{ route('client.products.filterByCategory', $category->id) }}">{{ $category->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-8">
                <h3>Danh sách sản phẩm</h3>
                @foreach ($products as $p)
                    <div class="card mb-3" style="max-width: 100%;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ $p->image }}" class="img-fluid rounded-start" alt="{{ $p->name }}">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $p->name }}</h5>
                                    <p class="card-text">{{ $p->description }}</p>
                                    <p class="card-text"><small class="text-muted">Danh mục: {{ $p->category->name }}</small></p>
                                    <a href="{{ route('client.products.show', $p->id) }}" class="btn btn-primary">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
