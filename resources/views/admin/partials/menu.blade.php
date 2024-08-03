<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    .list-group {
        display: flex;
        flex-direction: column;
        height: 90vh;
    }

    .dropdown.mt-auto {
        margin-top: auto;
    }
</style>

<body>
    <div class="list-group">
        <img src="https://demo.hasthemes.com/rongcha/img/logo/logo.png" width="200px" style="margin:" alt="">
        <a href="{{ route('categories.index') }}" class="list-group-item list-group-item-action">
            Danh mục <span class="badge badge-primary badge-pill">{{ $totalProducts }}</span>
        </a>
        <a href="{{ route('products.index') }}" class="list-group-item list-group-item-action">
            Danh sách sản phẩm <span class="badge badge-primary badge-pill"></span>
        </a>
        <a href="{{ route('users.index') }}" class="list-group-item list-group-item-action">
            Danh sách tài khoản <span class="badge badge-primary badge-pill">{{ $totalUsers }}</span>
        </a>
    </div>
    <div class="dropdown">
        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="" src="{{ auth()->user()->avatar_url }}" alt="{{ auth()->user()->name }}" width="40" height="40">
            <span>{{ auth()->user()->name }}</span>
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="{{ route('profile') }}">{{ __('Profile') }}</a>
            <div class="dropdown-divider"></div>
            {{-- <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item">{{ __('Log Out') }}</button>
            </form> --}}
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('{{ route('categories.count') }}')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('category-count').innerText = data.count;
                })
                .catch(error => console.error('Error:', error));
        });
    </script>


</body>

</html>
