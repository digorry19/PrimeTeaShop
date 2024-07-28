<!-- resources/views/layouts/client.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Client - @yield('title')</title>
    @livewireStyles
</head>
<body>
    @include('client.partials.sidebar')
    @yield('content')
    @livewireScripts
</body>
</html>
