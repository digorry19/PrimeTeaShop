<!-- resources/views/layouts/admin.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Admin - @yield('title')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .content-section {
            margin-top: 20px; /* Điều chỉnh khoảng cách lề trên của cả menu và bảng */
        }
    </style>
    @livewireStyles
</head>
<body>
    @include('admin.partials.sidebar')
    <div class="container-fluid">
        @yield('content')
    </div>
    @include('admin.partials.footer')
    @livewireScripts
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
