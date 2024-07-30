@extends('layouts.admin')

@section('css')
    <style>
        .content-section {
            margin-top: 20px; /* Điều chỉnh khoảng cách lề trên */
        }
    </style>
@endsection

@section('content')
    <div class="row content-section">
        <div class="col-md-3">
            @include('admin.partials.menu') <!-- Menu bên trái -->
        </div>
        <div class="col-md-9">
            <h1>Edit Product</h1>

            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" class="form-control" required>{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="text" id="price" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
                </div>

                <div class="form-group">
                    <label for="image">Image:</label>
                    <div>
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" width="100">
                    </div>
                    <input class="form-control mt-2" type="file" name="image" id="filePoster">
                    <img id="img" src="{{ asset('storage/' . $product->image) }}" width="100" alt="Preview Image" style="display: none; margin-top: 10px;">
                </div>

                <div class="form-group">
                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" class="form-control" value="{{ old('quantity', $product->quantity) }}" required>
                </div>

                <div class="form-group">
                    <label for="category_id">Category:</label>
                    <select id="category_id" name="category_id" class="form-control" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Update Product</button>
            </form>
        </div>
    </div>

    <script>
        var filePoster = document.querySelector("#filePoster");
        var img = document.querySelector("#img");
        filePoster.addEventListener('change', function(e){
            e.preventDefault();
            img.style.display = 'block';
            img.src = URL.createObjectURL(this.files[0]);
        });
    </script>
@endsection
