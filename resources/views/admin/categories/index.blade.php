<!-- resources/views/admin/categories/index.blade.php -->

@extends('layouts.admin')

@section('css')
    <style>
      
    </style>
@endsection

@section('content')
    <div class="row content-section">
        <div class="col-md-3">
            @include('admin.partials.menu') <!-- Menu bên trái -->
        </div>
        <div class="col-md-9">
            <h1>Categories List</h1>
            <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Add New Category</a>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <td>
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
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
@endsection
