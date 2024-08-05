@extends('layouts.client')

@section('content')
    <div class="banner">
        <div class="banner-content">
            <h1>Product Details</h1>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid" alt="{{ $product->name }}">
            </div>
            <div class="col-md-8">
                <h1>{{ $product->name }}</h1>
                <p>{{ $product->description }}</p>
                <p>Price: ${{ $product->price }}</p>
                <p>Quantity: {{ $product->quantity }}</p>
                <p>Category: {{ $product->category->name }}</p>
                <div class="form-group">
                    <form action="{{ route('cart.store') }}" method="POST" class="d-flex align-items-center">
                        @csrf
                        <a href="{{ route('client.products.index') }}" class="btn btn-secondary ml-2" style="margin-right: 5px">Back to Products</a>
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="number" name="quantity" min="1" value="1">
                        <button type="submit" class="btn btn-primary ms-2">Add to Cart <i class="fa-solid fa-cart-shopping"></i></button>
                    </form>
                </div>
                
            </div>
        </div>
        <h2>Comments</h2>
        <div class="card mb-2">
            <div class="card-body">
                <p>This is a sample comment. Great product!</p>
                <small>Posted by John Doe on 01/08/2024</small>
            </div>
        </div>
        <div class="card mb-2">
            <div class="card-body">
                <p>This is another sample comment. I love it!</p>
                <small>Posted by Jane Smith on 02/08/2024</small>
            </div>
        </div>

        <!-- Add Comment Form (Demo) -->
        <form>
            <div class="form-group">
                <label for="content">Your Comment</label>
                <textarea id="content" name="content" class="form-control" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Submit</button>
        </form>
    </div>
@endsection

@section('css')
    <style>
        .banner {
            background: url('https://demo.hasthemes.com/rongcha/img/banner/bg-1.png') no-repeat center center;
            background-size: cover;
            padding: 60px 0;
            color: white;
            text-align: center;
        }

        .banner-content h1 {
            font-size: 2.5rem;
            font-weight: bold;
            margin: 0;
        }

        .container {
            margin-top: 20px;
        }

        .img-fluid {
            max-width: 100%;
            height: auto;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            font-size: 1rem;
            color: white;
            text-align: center;
            text-decoration: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            font-size: 1rem;
            color: white;
            text-align: center;
            text-decoration: none;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-control {
            border-radius: 4px;
            box-shadow: none;
            border: 1px solid #ced4da;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
        }

        .product-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
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

        .quantity-container {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
        }

        .quantity-container input {
            width: 80px;
            text-align: center;
        }

        .quantity-container button {
            margin-left: 10px;
        }
    </style>
@endsection
