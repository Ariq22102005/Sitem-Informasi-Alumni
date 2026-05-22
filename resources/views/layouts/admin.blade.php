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