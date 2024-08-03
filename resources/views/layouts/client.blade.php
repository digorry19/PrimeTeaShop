<!-- resources/views/layouts/client.blade.php -->

<!DOCTYPE html>
<html>

<head>
    <title>Client - @yield('title')</title>
    @livewireStyles
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery UI -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <style>
        .content-section {
            
        }

        .banner {
            height: 200px;
            /* Điều chỉnh chiều cao theo nhu cầu */
            background-image: url('https://demo.hasthemes.com/rongcha/img/banner/page-title.jpg');
            /* Thay thế với liên kết ảnh thực tế */
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-bottom: 20px;
        }

        .banner-content {
            /* Để chữ dễ đọc hơn trên nền ảnh */
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }
    </style>
</head>

<body>
    @include('client.partials.sidebar')
    <!-- Banner -->
    @if (View::hasSection('banner'))
        <div class="banner" style="background-image: url('@yield('banner-image')');">
            <div class="banner-content">
                <h1>@yield('banner-title')</h1>
            </div>
        </div>
    @endif
    @yield('content')
    @livewireScripts
    @include('client.partials.footer') <!-- Thêm dòng này -->
</body>

</html>
