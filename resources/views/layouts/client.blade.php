<!-- resources/views/layouts/client.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Client - @yield('title')</title>
    @livewireStyles
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .content-section {
            margin-top: 20px; /* Điều chỉnh khoảng cách lề trên của cả menu và bảng */
        }
    </style>
</head>
<body>
    @include('client.partials.sidebar')
    @yield('content')
    @livewireScripts
    @include('client.partials.footer') <!-- Thêm dòng này -->
</body>
</html>
