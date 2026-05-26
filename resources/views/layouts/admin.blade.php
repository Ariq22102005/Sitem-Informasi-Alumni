<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') — {{ config('app.name', 'Sistem Informasi Alumni') }}</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    @stack('styles')
</head>
<body class="app-body admin-body">
    <div class="admin-shell">
        <aside class="admin-sidebar">
            <div class="admin-sidebar__brand">
                <div class="fw-bold text-white"><i class="fas fa-shield-halved me-2"></i>Admin</div>
                <small class="text-white-50">{{ config('app.name', 'SIA Alumni') }}</small>
            </div>

            <nav class="admin-nav">
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-gauge me-2"></i> Dashboard
                </a>
                <a href="{{ route('admin.alumni.index') }}" class="{{ request()->routeIs('admin.alumni.*') ? 'active' : '' }}">
                    <i class="fas fa-user-graduate me-2"></i> Alumni
                </a>
                <a href="{{ route('admin.news.index') }}" class="{{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
                    <i class="fas fa-newspaper me-2"></i> News
                </a>
                <a href="{{ route('admin.lowongan.index') }}" class="{{ request()->routeIs('admin.lowongan.*') ? 'active' : '' }}">
                    <i class="fas fa-briefcase me-2"></i> Lowongan
                </a>
                <a href="{{ route('admin.galeri.index') }}" class="{{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}">
                    <i class="fas fa-image me-2"></i> Galeri
                </a>
                <a href="{{ route('admin.pengumuman.index') }}" class="{{ request()->routeIs('admin.pengumuman.*') ? 'active' : '' }}">
                    <i class="fas fa-bullhorn me-2"></i> Pengumuman
                </a>
                <a href="{{ route('admin.tracer.index') }}" class="{{ request()->routeIs('admin.tracer.*') ? 'active' : '' }}">
                    <i class="fas fa-chart-line me-2"></i> Tracer
                </a>
                <a href="{{ route('admin.settings') }}" class="{{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                    <i class="fas fa-gear me-2"></i> Settings
                </a>
                <div class="admin-nav__divider"></div>
                <a href="{{ route('home') }}">
                    <i class="fas fa-arrow-left me-2"></i> Kembali ke publik
                </a>
            </nav>
        </aside>

        <div class="admin-content">
            <div class="admin-topbar">
                <div class="admin-topbar__title">
                    <div class="fw-semibold">@yield('page-title')</div>
                    <div class="text-muted small">@yield('page-subtitle')</div>
                </div>
                <div class="admin-topbar__user text-muted small">
                    <i class="fas fa-user me-1"></i>{{ auth()->user()->name ?? 'Admin' }}
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    @stack('scripts')
</body>
</html>
