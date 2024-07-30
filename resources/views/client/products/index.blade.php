@extends('layouts.client')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @extends('layouts.client')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="container text-center">
        <div class="row">
            <div class="col-4">
                <h3>Danh sách danh mục</h3>
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
                    <div class="card mb-3" style="max-width: 100%; position: relative;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <!-- Hiển thị ảnh chính và ảnh thứ hai khi hover -->
                                <div class="card-image-container">
                                    <img src="{{ asset('storage/' . $p->image) }}" class="img-fluid rounded-start" alt="{{ $p->name }}" style="width: 100%;">
                                    @if($p->image_secondary)
                                        <img src="{{ asset('storage/' . $p->image_secondary) }}" class="img-fluid rounded-start secondary-img" alt="Secondary Image" style="width: 100%;">
                                    @endif
                                </div>
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

@section('css')
    <style>
        .card-image-container {
            position: relative;
        }
        .card-image-container img.secondary-img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0;
            transition: opacity 0.5s ease;
        }
        .card-image-container:hover img.secondary-img {
            opacity: 1;
        }
    </style>
@endsection

@endsection
