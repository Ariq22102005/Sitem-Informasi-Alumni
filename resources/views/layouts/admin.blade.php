<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
