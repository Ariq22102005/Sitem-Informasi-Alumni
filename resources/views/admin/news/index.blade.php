@extends('layouts.admin')

@section('title', 'Kelola Berita')
@section('page-title', 'Berita')
@section('page-subtitle', 'Kelola konten berita untuk halaman publik.')

@section('content')
<div class="container-fluid py-3">
    <!-- Hero Section -->
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="bg-gradient text-white p-5 rounded-lg shadow" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <h1 class="display-4 fw-bold mb-3">
                    <i class="fas fa-newspaper"></i> Berita Alumni
                </h1>
                <p class="lead mb-0">Tetap update dengan informasi terbaru dari komunitas alumni kami</p>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Search & Filter -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('admin.news.index') }}" method="GET" class="row g-3 align-items-end">
                        <div class="col-md-6">
                            <label class="form-label small text-muted">Kata kunci</label>
                            <input type="text" name="search" class="form-control" placeholder="Cari judul / konten..." value="{{ request('search') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small text-muted">Kategori</label>
                            <select name="category" class="form-select">
                                <option value="">Semua Kategori</option>
                                <option value="Alumni" {{ request('category') === 'Alumni' ? 'selected' : '' }}>Alumni</option>
                                <option value="Acara" {{ request('category') === 'Acara' ? 'selected' : '' }}>Acara</option>
                                <option value="Prestasi" {{ request('category') === 'Prestasi' ? 'selected' : '' }}>Prestasi</option>
                                <option value="Beasiswa" {{ request('category') === 'Beasiswa' ? 'selected' : '' }}>Beasiswa</option>
                                <option value="Pengumuman" {{ request('category') === 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                                <option value="Lainnya" {{ request('category') === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                        <div class="col-md-2 d-flex gap-2">
                            <button type="submit" class="btn btn-primary flex-fill">
                                <i class="fas fa-search"></i>
                            </button>
                            <a href="{{ route('admin.news.index') }}" class="btn btn-outline-secondary flex-fill">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- News Grid -->
    <div class="row">
        @forelse($news as $item)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm transition-all" style="transition: transform 0.3s, box-shadow 0.3s; cursor: pointer;" 
                     onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.15)';"
                     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 0.125rem 0.25rem rgba(0,0,0,0.075)';">
                    
                    <!-- Featured Image -->
                    @if($item->featured_image)
                        <img src="{{ asset('storage/' . $item->featured_image) }}" 
                             class="card-img-top" alt="{{ $item->title }}" style="height: 200px; object-fit: cover;">
                    @else
                        <div class="bg-light card-img-top d-flex align-items-center justify-content-center" style="height: 200px;">
                            <i class="fas fa-image fa-3x text-muted"></i>
                        </div>
                    @endif

                    <div class="card-body d-flex flex-column">
                        <!-- Category Badge -->
                        <div class="mb-2">
                            @php
                                $categoryColors = [
                                    'Alumni' => 'info',
                                    'Acara' => 'success',
                                    'Prestasi' => 'warning',
                                    'Beasiswa' => 'danger',
                                    'Pengumuman' => 'primary',
                                    'Lainnya' => 'secondary'
                                ];
                            @endphp
                            <span class="badge bg-{{ $categoryColors[$item->category] ?? 'secondary' }}">
                                {{ $item->category }}
                            </span>
                        </div>

                        <!-- Title -->
                        <h5 class="card-title fw-bold text-dark mb-2">
                            {{ Str::limit($item->title, 50) }}
                        </h5>

                        <!-- Excerpt -->
                        <p class="card-text text-muted small flex-grow-1">
                            {{ Str::limit($item->excerpt ?? $item->content, 80) }}
                        </p>

                        <!-- Meta Information -->
                        <div class="border-top pt-3 mt-auto">
                            <small class="text-muted d-block mb-2">
                                <i class="fas fa-user"></i> {{ $item->author }}
                            </small>
                            <small class="text-muted d-block mb-2">
                                <i class="fas fa-calendar"></i> {{ $item->published_at->format('d M Y') }}
                            </small>
                            <small class="text-muted d-block">
                                <i class="fas fa-eye"></i> {{ $item->views }} views
                            </small>
                        </div>
                    </div>

                    <!-- Card Footer -->
                    <div class="card-footer bg-white border-top">
                        <div class="d-flex gap-2">
                            <a href="{{ route('news.show', $item) }}" class="btn btn-sm btn-outline-primary flex-fill">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.news.edit', $item) }}" class="btn btn-sm btn-outline-warning flex-fill">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center py-5">
                    <i class="fas fa-inbox fa-3x mb-3"></i>
                    <p class="mb-0 mt-3">Belum ada berita yang dipublikasikan</p>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($news->hasPages())
        <div class="row mt-5">
            <div class="col-12 d-flex justify-content-center">
                {{ $news->links() }}
            </div>
        </div>
    @endif
</div>

<style>
    .transition-all {
        transition: all 0.3s ease;
    }
</style>
@endsection