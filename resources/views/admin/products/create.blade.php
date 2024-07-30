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
            <h1>Add New Product</h1>

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="text" id="price" name="price" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="image">Image:</label>
                    <input class="form-control" type="file" name="image" id="filePoster" required>
                    <img id="img" src="#" width="100" alt="Preview Image" style="display: none; margin-top: 10px;">
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="category_id">Category:</label>
                    <select id="category_id" name="category_id" class="form-control" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Add Product</button>
            </form>
        </div>
    </div>
    
    <script>
        document.querySelector("#filePoster").addEventListener('change', function(e){
            var img = document.querySelector("#img");
            img.style.display = 'block';
            img.src = URL.createObjectURL(this.files[0]);
        });
    </script>
@endsection
