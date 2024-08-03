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
                <a href="{{ route('client.products.index') }}" class="btn btn-secondary">Back to Products</a>
                <a href="#" class="btn btn-secondary">Add to cart <i class="fa-solid fa-cart-shopping"></i></a>
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
