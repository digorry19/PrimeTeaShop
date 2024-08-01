@extends('layouts.admin')

@section('css')
    <style>
        .active {
            color: green;
            font-weight: bold;
        }
        .inactive {
            color: red;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    <div class="row content-section">
        <div class="col-md-3">
            @include('admin.partials.menu') <!-- Menu bên trái -->
        </div>
        <div class="col-md-9">
            <h1>Account List</h1>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Avatar</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td><img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" width="100"></td>
                            <td>{{ $user->role }}</td>
                            <td class="{{ $user->active ? 'active' : 'inactive' }}">
                                {{ $user->active ? 'Active' : 'Inactive' }}
                            </td>
                            <td>
                                @if($user->active)
                                    <form action="{{ route('users.deactivate', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-warning">Deactivate</button>
                                    </form>
                                @else
                                    <form action="{{ route('users.activate', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-success">Activate</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination-wrapper">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
