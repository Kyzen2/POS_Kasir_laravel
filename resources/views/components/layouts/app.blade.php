<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        /* Background Color */
        body {

            background: linear-gradient(135deg, rgba(126, 197, 255, 0.64), rgba(7, 21, 224, 0.66));
            font-family: 'Nunito', sans-serif;

            /* Light gray background for a clean look */
            font-family: 'Nunito',
                sans-serif;
        }

        /* Navbar Styling */
        .navbar {
            background-color: #007bff;
            /* Deep blue for a professional look */
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: #ffffff !important;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
        }

        .nav-button {
            padding: 12px 20px;
            font-size: 1.1rem;
            border-radius: 30px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            color: #ffffff;
        }

        /* Hover Effects */
        .nav-button:hover {
            transform: translateY(-3px);
            background-color: #007bff;
            /* Green for hover effect */
            color: white !important;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        /* Active State */
        .nav-button.active {
            background-color: rgb(43, 116, 250) !important;
            /* Green active button */
            color: white !important;
            border-color: #007bff !important;
        }

        /* Card Styles */
        .nav-card {
            background: linear-gradient(135deg, rgba(17, 0, 255, 0.7), rgba(0, 90, 116, 0.7));
            border-radius: 15px;
            box-shadow: 0 10px 10px rgba(0, 0, 0, 0.23);
            padding: 20px;
            margin-top: 20px;
            transition: transform 0.3s ease;
        }

        .container {
            margin-top: 30px;
        }

        /* Navbar Toggler Icon */
        .navbar-toggler-icon {
            background-color: #fff;
        }

        /* Responsif Design */
        @media (max-width: 767px) {
            .nav-card {
                text-align: center;
            }

            .nav-button {
                width: 100%;
                margin-bottom: 1rem;
                font-size: 1.2rem;
            }
        }

        /* Desktop View */
        @media (min-width: 768px) {
            .nav-card {
                display: flex;
                justify-content: center;
                gap: 1.5rem;
            }
        }

        /* Dropdown Menu */
        .dropdown-menu {
            background-color: #007bff;
            /* Consistent with navbar color */
            border-radius: 10px;
        }

        .dropdown-item {
            color: white !important;
        }

        .dropdown-item:hover {
            background-color: #28a745 !important;
            color: white;
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto"></ul>
                    <ul class="navbar-nav ms-auto">
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#"
                                role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('logout') }} "
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                <div class="row mb-3">
                    <div class="col-12 nav-card">
                        <a href="{{ route('home') }}" wire:navigate
                            class="btn nav-button {{ request()->routeIs('home') ? 'active' : 'btn-outline-primary' }}">
                            Beranda
                        </a>
                        @if (Auth::user()->peran == 'admin')
                        <a href="{{ route('user') }}" wire:navigate
                            class="btn nav-button {{ request()->routeIs('user') ? 'active' : 'btn-outline-primary' }}">
                            Pengguna
                        </a>
                        @endif
                        <a href="{{ route('produk') }}" wire:navigate
                            class="btn nav-button {{ request()->routeIs('produk') ? 'active' : 'btn-outline-primary' }}">
                            Produk
                        </a>

                        <a href="{{ route('transaksi') }}" wire:navigate
                            class="btn nav-button {{ request()->routeIs('transaksi') ? 'active' : 'btn-outline-primary' }}">
                            Transaksi
                        </a>

                        <a href="{{ route('laporan') }}" wire:navigate
                            class="btn nav-button {{ request()->routeIs('laporan') ? 'active' : 'btn-outline-primary' }}">
                            Laporan
                        </a>
                    </div>
                </div>
                {{ $slot }}
            </div>
        </main>
    </div>
</body>

</html>