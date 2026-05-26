@extends('layouts.admin')

@section('title', 'Detail Galeri')
@section('page-title', 'Galeri')
@section('page-subtitle', 'Detail foto yang dipilih')

@section('content')
<div class="page-header d-flex align-items-center justify-content-between mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.galeri.index') }}">Galeri</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    </nav>

    <div class="d-flex gap-2">
        <a href="{{ route('admin.galeri.edit', $galeri) }}" class="btn btn-warning btn-sm px-3">
            <i class="fas fa-edit me-1"></i> Edit
        </a>
        <a href="{{ route('admin.galeri.index') }}" class="btn btn-outline-secondary btn-sm px-3">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>
</div>

<div class="card" style="max-width: 920px;">
    <div class="card-body">
        <div class="mb-4">
            <img
                src="{{ Storage::url($galeri->file_path) }}"
                alt="{{ $galeri->judul }}"
                class="img-fluid rounded"
                style="max-height: 460px; width: 100%; object-fit: cover;"
            >
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <div class="text-muted small">Judul</div>
                <div class="fw-semibold">{{ $galeri->judul }}</div>
            </div>

            <div class="col-md-6">
                <div class="text-muted small">Kategori</div>
                <div class="fw-semibold">{{ $galeri->kategori ?? '-' }}</div>
            </div>

            <div class="col-12">
                <div class="text-muted small mb-1">Keterangan</div>
                <div class="text-muted" style="white-space: pre-wrap;">{{ $galeri->keterangan ?? '-' }}</div>
            </div>

            <div class="col-12">
                <div class="text-muted small mb-1">File path</div>
                <div class="text-muted" style="word-break: break-word;">{{ $galeri->file_path }}</div>
            </div>

            <div class="col-md-6">
                <div class="text-muted small">Dibuat</div>
                <div class="text-muted">{{ $galeri->created_at?->format('d M Y') ?? '-' }}</div>
            </div>

            <div class="col-md-6">
                <div class="text-muted small">Terakhir diupdate</div>
                <div class="text-muted">{{ $galeri->updated_at?->format('d M Y') ?? '-' }}</div>
            </div>
        </div>

        <hr>

        <div class="d-flex gap-2">
            <form
                action="{{ route('admin.galeri.destroy', $galeri) }}"
                method="POST"
                onsubmit="return confirm('Hapus foto ini?')"
            >
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-danger px-4">
                    <i class="fas fa-trash me-1"></i> Hapus
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

