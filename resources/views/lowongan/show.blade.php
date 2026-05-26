@extends('layouts.app')

@section('title', $lowongan->posisi)

@section('content')
<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('lowongan.index') }}">Lowongan Kerja</a></li>
        <li class="breadcrumb-item active">{{ $lowongan->posisi }}</li>
    </ol>
</nav>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="d-flex flex-wrap gap-2 mb-3">
                    <span class="badge bg-primary">{{ $lowongan->tipe_label }}</span>
                    @if ($lowongan->gaji)
                        <span class="badge bg-success-subtle text-success">{{ $lowongan->gaji }}</span>
                    @endif
                </div>
                <h1 class="h3 fw-bold">{{ $lowongan->posisi }}</h1>
                <p class="text-muted mb-4"><i class="fas fa-building me-1"></i>{{ $lowongan->perusahaan }}
                    @if ($lowongan->lokasi)
                        &middot; <i class="fas fa-location-dot me-1"></i>{{ $lowongan->lokasi }}
                    @endif
                </p>

                <h2 class="h6 fw-semibold text-uppercase text-muted">Deskripsi Tugas</h2>
                <div class="mb-4">{!! nl2br(e($lowongan->deskripsi)) !!}</div>

                @if ($lowongan->kualifikasi)
                    <h2 class="h6 fw-semibold text-uppercase text-muted">Persyaratan</h2>
                    <div>{!! nl2br(e($lowongan->kualifikasi)) !!}</div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm sticky-top" style="top: 1rem;">
            <div class="card-body">
                <h3 class="h6 fw-bold mb-3">Informasi Lamar</h3>
                @if ($lowongan->batas_lamar)
                    <p class="small mb-2"><strong>Batas lamaran:</strong> {{ $lowongan->batas_lamar->format('d F Y') }}</p>
                @endif
                @if ($lowongan->kontak)
                    <p class="small mb-2"><strong>Kontak:</strong> {{ $lowongan->kontak }}</p>
                @endif
                @if ($lowongan->link_lamar)
                    <a href="{{ $lowongan->link_lamar }}" class="btn btn-primary w-100 mb-2" target="_blank" rel="noopener">
                        <i class="fas fa-paper-plane me-1"></i> Lamar Sekarang
                    </a>
                @endif
                <a href="{{ route('lowongan.index') }}" class="btn btn-outline-secondary w-100">Kembali ke Daftar</a>
            </div>
        </div>

        @if ($terkait->isNotEmpty())
            <div class="card border-0 shadow-sm mt-3">
                <div class="card-header bg-white fw-semibold">Lowongan Terkait</div>
                <ul class="list-group list-group-flush">
                    @foreach ($terkait as $item)
                        <li class="list-group-item">
                            <a href="{{ route('lowongan.show', $item) }}" class="text-decoration-none fw-semibold">{{ $item->posisi }}</a>
                            <div class="small text-muted">{{ $item->perusahaan }}</div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>
@endsection
