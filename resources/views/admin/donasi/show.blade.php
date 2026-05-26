@extends('layouts.admin')

@section('title', 'Detail Donasi')
@section('page-title', 'Detail Donasi')
@section('content')
<div class="page-header d-flex align-items-center justify-content-between mb-3">
    <div>
        <h1>Detail Donasi</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.donasi.index') }}">Donasi</a></li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.donasi.edit', $donasi) }}" class="btn btn-outline-warning">
            <i class="fas fa-edit me-1"></i> Edit
        </a>
        <a href="{{ route('admin.donasi.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <div class="text-muted small">Nama Donatur</div>
                <div class="fw-semibold">{{ $donasi->nama_donatur }}</div>
            </div>
            <div class="col-md-6">
                <div class="text-muted small">Program Studi</div>
                <div class="fw-semibold">{{ $donasi->program_studi }}</div>
            </div>

            <div class="col-md-6">
                <div class="text-muted small">Jumlah Donasi</div>
                <div class="fw-semibold" style="color: #0ea5e9;">
                    Rp {{ number_format($donasi->jumlah_donasi, 0, ',', '.') }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="text-muted small">Tanggal</div>
                <div class="fw-semibold">
                    {{ $donasi->created_at?->format('d M Y H:i') ?? '-' }}
                </div>
            </div>

            <div class="col-12">
                <div class="text-muted small">Catatan</div>
                <div class="fw-semibold" style="white-space: pre-wrap;">
                    {{ $donasi->catatan ?: '-' }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

