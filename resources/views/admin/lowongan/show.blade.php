@extends('layouts.admin')

@section('title', $lowongan->posisi)

@section('content')
<div class="page-header d-flex justify-content-between align-items-start mb-4">
    <div>
        <h1>{{ $lowongan->posisi }}</h1>
        <p class="text-muted mb-0"><i class="fas fa-building me-1"></i>{{ $lowongan->perusahaan }}</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.lowongan.edit', $lowongan) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit me-1"></i> Edit</a>
        <form action="{{ route('admin.lowongan.toggle-status', $lowongan) }}" method="POST">
            @csrf @method('PATCH')
            <button class="btn btn-sm btn-{{ $lowongan->status === 'aktif' ? 'secondary' : 'success' }}">
                {{ $lowongan->status === 'aktif' ? 'Tutup Lowongan' : 'Aktifkan Kembali' }}
            </button>
        </form>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-8">
        <div class="card mb-3">
            <div class="card-header bg-white fw-semibold">Deskripsi Tugas</div>
            <div class="card-body">{!! nl2br(e($lowongan->deskripsi)) !!}</div>
        </div>
        @if ($lowongan->kualifikasi)
            <div class="card">
                <div class="card-header bg-white fw-semibold">Persyaratan</div>
                <div class="card-body">{!! nl2br(e($lowongan->kualifikasi)) !!}</div>
            </div>
        @endif
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <dl class="mb-0">
                    <dt>Status</dt>
                    <dd><span class="badge bg-{{ $lowongan->status === 'aktif' ? 'success' : 'danger' }}">{{ ucfirst($lowongan->status) }}</span></dd>
                    <dt>Tipe</dt>
                    <dd>{{ $lowongan->tipe_label }}</dd>
                    <dt>Lokasi</dt>
                    <dd>{{ $lowongan->lokasi ?? '—' }}</dd>
                    <dt>Gaji</dt>
                    <dd>{{ $lowongan->gaji ?? '—' }}</dd>
                    <dt>Batas Lamar</dt>
                    <dd>{{ $lowongan->batas_lamar?->format('d F Y') ?? '—' }}</dd>
                    <dt>Kontak</dt>
                    <dd>{{ $lowongan->kontak ?? '—' }}</dd>
                    @if ($lowongan->link_lamar)
                        <dt>Link Lamar</dt>
                        <dd><a href="{{ $lowongan->link_lamar }}" target="_blank" rel="noopener">{{ $lowongan->link_lamar }}</a></dd>
                    @endif
                </dl>
            </div>
        </div>
        <a href="{{ route('admin.lowongan.index') }}" class="btn btn-outline-secondary w-100 mt-3">Kembali ke Daftar</a>
    </div>
</div>
@endsection
