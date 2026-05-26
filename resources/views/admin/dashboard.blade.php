@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="page-header d-flex align-items-center justify-content-between">
    <div>
        <h1>Dashboard</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item active">Selamat datang, {{ auth()->user()->name ?? 'Admin' }}</li>
            </ol>
        </nav>
    </div>
    <a href="{{ route('admin.news.create') }}" class="btn btn-primary btn-sm px-3">
        <i class="fas fa-plus me-1"></i> Buat Berita
    </a>
</div>

{{-- STAT CARDS --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="stat-card" style="background: linear-gradient(135deg,#4f46e5,#7c3aed);">
            <div class="stat-icon mb-2"><i class="fas fa-user-graduate"></i></div>
            <div class="stat-num">{{ $totalAlumni ?? 0 }}</div>
            <div class="stat-label mt-1">Total Alumni</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card" style="background: linear-gradient(135deg,#0ea5e9,#06b6d4);">
            <div class="stat-icon mb-2"><i class="fas fa-newspaper"></i></div>
            <div class="stat-num">{{ $totalNews }}</div>
            <div class="stat-label mt-1">Total Berita</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card" style="background: linear-gradient(135deg,#10b981,#059669);">
            <div class="stat-icon mb-2"><i class="fas fa-briefcase"></i></div>
            <div class="stat-num">{{ $totalLowongan ?? 0 }}</div>
            <div class="stat-label mt-1">Lowongan Aktif</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card" style="background: linear-gradient(135deg,#f59e0b,#ef4444);">
            <div class="stat-icon mb-2"><i class="fas fa-eye"></i></div>
            <div class="stat-num">{{ $totalViews ?? 0 }}</div>
            <div class="stat-label mt-1">Total Views</div>
        </div>
    </div>
</div>

{{-- ROW 2 --}}
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card text-center py-3 h-100">
            <div class="card-body">
                <div class="text-success fs-1"><i class="fas fa-check-circle"></i></div>
                <div class="fs-2 fw-bold text-success mt-1">{{ $publishedNews }}</div>
                <div class="text-muted small">Berita Dipublikasi</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center py-3 h-100">
            <div class="card-body">
                <div class="text-warning fs-1"><i class="fas fa-file-alt"></i></div>
                <div class="fs-2 fw-bold text-warning mt-1">{{ $draftNews }}</div>
                <div class="text-muted small">Berita Draft</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center py-3 h-100">
            <div class="card-body">
                <div class="text-info fs-1"><i class="fas fa-chart-line"></i></div>
                <div class="fs-2 fw-bold text-info mt-1">{{ $totalTracerStudy ?? 0 }}</div>
                <div class="text-muted small">Responden Tracer</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center py-3 h-100">
            <div class="card-body">
                <div class="text-primary fs-1"><i class="fas fa-users"></i></div>
                <div class="fs-2 fw-bold text-primary mt-1">{{ $totalUsers ?? 0 }}</div>
                <div class="text-muted small">Total Pengguna</div>
            </div>
        </div>
    </div>
</div>

{{-- BERITA TERBARU + AKSES CEPAT --}}
<div class="row g-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between bg-white py-3">
                <span class="fw-semibold"><i class="fas fa-list me-2 text-primary"></i>Berita Terbaru</span>
                <a href="{{ route('admin.news.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentNews as $item)
                        <tr>
                            <td><strong>{{ Str::limit($item->title, 35) }}</strong></td>
                            <td><span class="badge bg-info">{{ $item->category }}</span></td>
                            <td>
                                @if($item->status === 'published')
                                    <span class="badge bg-success">Publish</span>
                                @else
                                    <span class="badge bg-warning text-dark">Draft</span>
                                @endif
                            </td>
                            <td class="text-muted" style="font-size:.82rem;">{{ $item->created_at->format('d/m/Y') }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.news.edit', $item) }}" class="btn btn-sm btn-outline-warning py-0 px-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">Belum ada berita</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-white py-3 fw-semibold">
                <i class="fas fa-bolt me-2 text-warning"></i>Akses Cepat
            </div>
            <div class="card-body d-grid gap-2">
                <a href="{{ route('admin.alumni.create') }}" class="btn btn-outline-primary text-start">
                    <i class="fas fa-user-plus me-2"></i> Tambah Alumni Baru
                </a>
                <a href="{{ route('admin.news.create') }}" class="btn btn-outline-primary text-start">
                    <i class="fas fa-pen me-2"></i> Tulis Berita
                </a>
                <a href="{{ route('admin.lowongan.create') }}" class="btn btn-outline-success text-start">
                    <i class="fas fa-briefcase me-2"></i> Posting Lowongan
                </a>
                <a href="{{ route('admin.pengumuman.create') }}" class="btn btn-outline-warning text-start">
                    <i class="fas fa-bullhorn me-2"></i> Buat Pengumuman
                </a>
                <a href="{{ route('admin.tracer.index') }}" class="btn btn-outline-info text-start">
                    <i class="fas fa-chart-line me-2"></i> Lihat Tracer Study
                </a>
                <a href="{{ route('admin.galeri.create') }}" class="btn btn-outline-secondary text-start">
                    <i class="fas fa-images me-2"></i> Upload Galeri
                </a>
            </div>
        </div>
    </div>
</div>
@endsection