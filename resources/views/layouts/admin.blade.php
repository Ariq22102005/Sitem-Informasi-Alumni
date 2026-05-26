<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Panel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body {
            background-color: #f5f6fa;
        }

        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: #1e293b;
            color: white;
            position: fixed;
        }

        .sidebar a {
            color: #cbd5e1;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
        }

        .sidebar a:hover {
            background: #334155;
            color: white;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .navbar-custom {
            background: white;
            border-radius: 10px;
            padding: 15px 20px;
            margin-bottom: 20px;
        }

        .card {
            border: none;
            border-radius: 12px;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h4 class="p-3">Admin Panel</h4>

    <a href="{{ route('admin.dashboard') }}">
        <i class="fas fa-home me-2"></i> Dashboard
    </a>

    <a href="{{ route('admin.alumni.index') }}">
        <i class="fas fa-user-graduate me-2"></i> Alumni
    </a>

    <a href="{{ route('admin.news.index') }}">
        <i class="fas fa-newspaper me-2"></i> News
    </a>

    <a href="{{ route('admin.lowongan.index') }}">
        <i class="fas fa-briefcase me-2"></i> Lowongan
    </a>

    <a href="{{ route('admin.galeri.index') }}">
        <i class="fas fa-image me-2"></i> Galeri
    </a>

    <a href="{{ route('admin.pengumuman.index') }}">
        <i class="fas fa-bullhorn me-2"></i> Pengumuman
    </a>

    <a href="{{ route('admin.settings') }}">
        <i class="fas fa-cog me-2"></i> Settings
    </a>
</div>

<div class="content">

    <div class="navbar-custom d-flex justify-content-between align-items-center">
        <h4 class="mb-0">@yield('page-title')</h4>

        <div>
            {{ auth()->user()->name ?? 'Admin' }}
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @yield('content')

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
    <title>@yield('title', 'Admin') — {{ config('app.name', 'Sistem Informasi Alumni') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        body { background: #eef1f6; }
        .admin-sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #1e293b, #334155);
            color: #e2e8f0;
        }
        .admin-sidebar a {
            color: #cbd5e1;
            text-decoration: none;
            display: block;
            padding: .65rem 1rem;
            border-radius: .5rem;
            margin-bottom: .25rem;
        }
        .admin-sidebar a:hover,
        .admin-sidebar a.active {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }
        .admin-content { padding: 1.5rem; }
        .page-header h1 { font-size: 1.35rem; margin-bottom: .25rem; }
    </style>
    @stack('styles')
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <aside class="col-lg-2 admin-sidebar py-4 px-3">
                <div class="mb-4">
                    <div class="fw-bold text-white"><i class="fas fa-briefcase me-2"></i>Admin Loker</div>
                    <small class="text-secondary">Modul Lowongan Kerja</small>
                </div>
                <nav>
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-gauge me-2"></i> Dashboard
                    </a>
                    <a href="{{ route('admin.lowongan.index') }}" class="{{ request()->routeIs('admin.lowongan.*') ? 'active' : '' }}">
                        <i class="fas fa-list me-2"></i> Kelola Lowongan
                    </a>
                    <a href="{{ route('lowongan.index') }}" target="_blank">
                        <i class="fas fa-external-link-alt me-2"></i> Lihat Halaman Publik
                    </a>
                    <a href="{{ route('home') }}">
                        <i class="fas fa-home me-2"></i> Beranda
                    </a>
                </nav>
            </aside>
            <div class="col-lg-10 admin-content">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
