<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Lowongan Kerja') — {{ config('app.name', 'Sistem Informasi Alumni') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        :root {
            --brand-primary: #4f46e5;
            --brand-secondary: #7c3aed;
        }
        body { background: #f4f6fb; }
        .navbar-brand-custom {
            background: linear-gradient(135deg, var(--brand-primary), var(--brand-secondary));
            box-shadow: 0 4px 14px rgba(79, 70, 229, 0.25);
        }
        .hero-lowongan {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 55%, #0ea5e9 100%);
            color: #fff;
            border-radius: 1rem;
            padding: 2.5rem 2rem;
        }
        .card-loker {
            border: none;
            border-radius: 1rem;
            transition: transform .2s ease, box-shadow .2s ease;
        }
        .card-loker:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 28px rgba(15, 23, 42, 0.12);
        }
        footer.site-footer {
            color: #64748b;
            font-size: .875rem;
        }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-brand-custom mb-4">
        <div class="container">
            <a class="navbar-brand fw-semibold" href="{{ route('home') }}">
                <i class="fas fa-graduation-cap me-2"></i>SIA Alumni
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMain">
                <ul class="navbar-nav ms-auto gap-lg-2">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active fw-semibold' : '' }}" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('lowongan.*') ? 'active fw-semibold' : '' }}" href="{{ route('lowongan.index') }}">Lowongan Kerja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.lowongan.index') }}">Kelola Lowongan</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container pb-5">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @yield('content')
    </main>

    <footer class="site-footer border-top py-4 mt-auto">
        <div class="container text-center">
            Modul Lowongan Kerja — PKG-14-3 &middot; {{ date('Y') }}
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
