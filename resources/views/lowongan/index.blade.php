@extends('layouts.app')

@section('title', 'Lowongan Kerja')

@section('content')
<div class="hero-lowongan mb-4">
    <h1 class="h3 fw-bold mb-2"><i class="fas fa-briefcase me-2"></i>Lowongan Kerja Alumni</h1>
    <p class="mb-0 opacity-75">Temukan peluang karier terbaru dari perusahaan mitra kampus. Gunakan pencarian dan filter untuk menemukan pekerjaan yang cocok.</p>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form action="{{ route('lowongan.index') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-5">
                <label class="form-label small text-muted">Kata kunci</label>
                <input type="text" name="search" class="form-control" placeholder="Web Developer, PT ABC..."
                       value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label small text-muted">Tipe pekerjaan</label>
                <select name="tipe" class="form-select">
                    <option value="">Semua tipe</option>
                    @foreach (\App\Models\Lowongan::TIPE_OPTIONS as $value => $label)
                        <option value="{{ $value }}" @selected(request('tipe') === $value)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label small text-muted">Lokasi</label>
                <select name="lokasi" class="form-select">
                    <option value="">Semua lokasi</option>
                    @foreach ($lokasiList as $lok)
                        <option value="{{ $lok }}" @selected(request('lokasi') === $lok)>{{ $lok }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1 d-grid">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
            </div>
        </form>
        @if (request()->hasAny(['search', 'tipe', 'lokasi']))
            <div class="mt-2">
                <a href="{{ route('lowongan.index') }}" class="small text-decoration-none">Reset filter</a>
            </div>
        @endif
    </div>
</div>

<p class="text-muted small mb-3">Menampilkan {{ $lowongans->total() }} lowongan aktif</p>

<div class="row g-4">
    @forelse ($lowongans as $loker)
        <div class="col-md-6 col-lg-4">
            <article class="card card-loker h-100 shadow-sm">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="badge bg-primary-subtle text-primary">{{ $loker->tipe_label }}</span>
                        @if ($loker->gaji)
                            <small class="text-success fw-semibold">{{ $loker->gaji }}</small>
                        @endif
                    </div>
                    <h2 class="h5 fw-bold mb-1">{{ $loker->posisi }}</h2>
                    <p class="text-muted small mb-2"><i class="fas fa-building me-1"></i>{{ $loker->perusahaan }}</p>
                    @if ($loker->lokasi)
                        <p class="small mb-2"><i class="fas fa-location-dot me-1 text-danger"></i>{{ $loker->lokasi }}</p>
                    @endif
                    <p class="small text-secondary flex-grow-1">{{ Str::limit(strip_tags($loker->deskripsi), 100) }}</p>
                    @if ($loker->batas_lamar)
                        <p class="small text-muted mb-3"><i class="fas fa-calendar me-1"></i>Lamar sebelum {{ $loker->batas_lamar->format('d M Y') }}</p>
                    @endif
                    <a href="{{ route('lowongan.show', $loker) }}" class="btn btn-outline-primary btn-sm mt-auto">Lihat Detail</a>
                </div>
            </article>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-light border text-center py-5">
                <i class="fas fa-inbox fa-2x text-muted mb-3 d-block"></i>
                <p class="mb-0">Belum ada lowongan aktif yang sesuai filter Anda.</p>
            </div>
        </div>
    @endforelse
</div>

@if ($lowongans->hasPages())
    <div class="mt-4 d-flex justify-content-center">{{ $lowongans->links() }}</div>
@endif
@endsection
