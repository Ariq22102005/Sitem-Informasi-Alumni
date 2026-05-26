<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name', 'Sistem Informasi Alumni'))</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:300,400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    @stack('styles')
</head>
<body class="app-body">
    <div class="app-shell">
        <nav class="navbar navbar-expand-lg navbar-dark app-navbar">
            <div class="container">
                <a class="navbar-brand fw-semibold" href="{{ route('home') }}">
                    <i class="fas fa-graduation-cap me-2"></i>{{ config('app.name', 'SIA Alumni') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain" aria-controls="navMain" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navMain">
                    <ul class="navbar-nav me-auto gap-lg-2">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active fw-semibold' : '' }}" href="{{ route('home') }}">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('news.*') ? 'active fw-semibold' : '' }}" href="{{ route('news.index') }}">Berita</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('lowongan.*') ? 'active fw-semibold' : '' }}" href="{{ route('lowongan.index') }}">Lowongan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('angkatan.*') ? 'active fw-semibold' : '' }}" href="{{ route('angkatan.index') }}">Angkatan</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                    </li>
                                </ul>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="container app-content">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </main>

        <footer class="app-footer border-top py-4">
            <div class="container text-center small text-muted">
                {{ config('app.name', 'Sistem Informasi Alumni') }} &middot; {{ date('Y') }}
            </div>
        </footer>
    </div>

    @stack('scripts')
</body>
</html>
