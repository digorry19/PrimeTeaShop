@extends('layouts.client')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="banner">
        <div class="banner-content">
            <h1>List Product</h1>
        </div>
    </div>
    <div class="container text-center">
        <div class="row">
            <div class="col-md-4">
                <h3 class="mb-3">Danh sách danh mục</h3>
                <div class="list-group">
                    <a class="list-group-item list-group-item-action list-group-item-primary"
                        href="{{ route('client.products.index') }}">
                        Tất cả sản phẩm
                    </a>
                    @foreach ($categories as $category)
                        <a class="list-group-item list-group-item-action list-group-item-success"
                            href="{{ route('client.products.filterByCategory', $category->id) }}">
                            {{ $category->name }}
                        </a>
                    @endforeach
                    <!-- Thêm nhiều danh mục nếu cần -->
                </div>

                <!-- Thông báo nổi bật -->
                <div class="mt-4 bg-light p-3 rounded shadow-sm">
                    <h5>Thông báo nổi bật</h5>
                    <p class="mb-0">Chúng tôi có những sản phẩm mới và ưu đãi đặc biệt! Đừng bỏ lỡ cơ hội này.</p>
                </div>

                <!-- Khuyến mãi đặc biệt -->
                <div class="mt-4 bg-warning text-white p-3 rounded">
                    <h5>Khuyến mãi đặc biệt</h5>
                    <p class="mb-0">Nhận ngay 20% giảm giá cho đơn hàng đầu tiên của bạn. Sử dụng mã: FIRST20 tại thanh
                        toán.</p>
                </div>
                <!-- Thanh kéo giá tiền -->
                <div class="mt-4">
                    <h5>Lọc theo giá</h5>
                    <div id="price-slider"></div>
                    <p>
                        Giá: <span id="price-range"></span>
                    </p>
                </div>
            </div>

            <div class="col-8">
                <h3>Danh sách sản phẩm</h3>
                <div class="row">
                    @foreach ($products as $p)
                        <div class="col-md-4 mb-4">
                            <div class="card product-card">
                                <div class="card-image-container">
                                    <img src="{{ asset('storage/' . $p->image) }}" class="img-fluid rounded-start"
                                        alt="{{ $p->name }}">
                                    <p>Price: {{ $p->price }}$</p>
                                    @if ($p->image_secondary)
                                        <img src="{{ asset('storage/' . $p->image_secondary) }}"
                                            class="img-fluid rounded-start secondary-img" alt="Secondary Image">
                                    @endif
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $p->name }}</h5>
                                    <p class="card-text"><small class="text-muted">Danh mục:
                                            {{ $p->category->name }}</small></p>
                                    <a href="{{ route('client.products.show', $p->id) }}" class="btn btn-primary">Xem chi
                                        tiết</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="pagination-wrapper">
        {{ $products->links() }}
    </div>
    <script>
        $(function() {
            $("#price-slider").slider({
                range: true,
                min: 0,
                max: 1000,
                values: [100, 500],
                slide: function(event, ui) {
                    $("#price-range").text("$" + ui.values[0] + " - $" + ui.values[1]);
                }
            });
            $("#price-range").text("$" + $("#price-slider").slider("values", 0) + " - $" + $("#price-slider")
                .slider("values", 1));
        });
    </script>
@endsection

@section('css')
    <style>
        .list-group {
            border-radius: 0.5rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .list-group-item {
            border: 1px solid #ddd;
            border-radius: 0.5rem;
            margin-bottom: 0.5rem;
            transition: background-color 0.3s, color 0.3s, border-color 0.3s;
        }

        .list-group-item:hover {
            background-color: #f8f9fa;
            border-color: #007bff;
            color: #007bff;
        }

        .list-group-item-action {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            text-decoration: none;
        }

        .list-group-item-primary {
            background-color: #007bff;
            color: white;
        }

        .list-group-item-primary:hover {
            background-color: #0056b3;
        }

        .list-group-item-success {
            background-color: #28a745;
            color: white;
        }

        .list-group-item-success:hover {
            background-color: #218838;
        }

        .list-group-item:active {
            background-color: #e9ecef;
            border-color: #007bff;
        }

        .product-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

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

        .card-body {
            padding: 15px;
        }

        .card-title {
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
        }

        .card-text {
            font-size: 1rem;
            margin-bottom: 1rem;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            font-size: 1rem;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
@endsection
