<!-- resources/views/client/partials/sidebar.blade.php -->
<?php
use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;
new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/d9fd73a9ea.js" crossorigin="anonymous"></script>
</head>
<style>
    .navbar {
        background-color: #f8f9fa;
    }

    .navbar-brand img {
        height: 40px;
    }

    .nav-item .nav-link {
        color: #495057;
        transition: color 0.3s ease;
    }

    .nav-item .nav-link:hover {
        color: #007bff;
    }

    .nav-item .dropdown-menu {
        background-color: #f8f9fa;
    }

    .nav-item .dropdown-item {
        color: #495057;
    }

    .nav-item .dropdown-item:hover {
        background-color: #e9ecef;
    }

    /* Điều chỉnh phần hồ sơ */
    .profile {
        display: flex;
        align-items: center;
    }

    .profile .dropdown-menu {
        background-color: #f8f9fa;
    }

    .profile .dropdown-item {
        color: #495057;
    }

    .profile .dropdown-item:hover {
        background-color: #e9ecef;
    }

    /* Điều chỉnh form tìm kiếm */
    .form-control {
        border-color: #ced4da;
    }

    .btn-outline-success {
        color: #28a745;
        border-color: #28a745;
    }

    .btn-outline-success:hover {
        color: #fff;
        background-color: #28a745;
        border-color: #28a745;
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a href="{{ route('client.dashboard') }}"><img src="https://demo.hasthemes.com/rongcha/img/logo/logo.png"
                    alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent" style="margin-left: 20px">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('client.dashboard') }}"><i
                                class="fa-solid fa-house"></i>Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('client.products.index') }}"><i
                                class="fa-solid fa-list"></i>Danh sách sản phẩm</a>
                    </li>
                    {{-- <li class="nav-item">
                <a class="nav-link disabled" aria-disabled="true">Disabled</a>
              </li> --}}
                </ul>
                <a href="{{ route('cart.index') }}" class="btn btn-outline-success position-relative"
                    style="margin-right: 10px">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span id="cart-quantity"
                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        0
                        <span class="visually-hidden">unread messages</span>
                    </span>
                </a>
                <form class="d-flex" style="margin-left: 10px" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success"style="margin-right: 10px" type="submit"><i
                            class="fa-solid fa-magnifying-glass"></i></button>
                </form>
                <div class="profile">
                    <nav x-data="{ open: false }"
                        class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                        <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                                            x-on:profile-updated.window="name = $event.detail.name"></div>

                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile')" wire:navigate>
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

                                    <!-- Authentication -->

                                </x-slot>
                            </x-dropdown>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </nav>
    <script>
        document.addEventListener('DOMContentLoaded', async function() {
            try {
                const response = await fetch('{{ route('cart.quantity') }}');
                const data = await response.json();
                document.getElementById('cart-quantity').textContent = data.quantity;
            } catch (error) {
                console.error('Error:', error);
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>
</body>

</html>
