@extends('layouts.app')

@section('title', 'Detail Alumni')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <div>
        <h1 class="h4 fw-bold mb-1">Detail Alumni</h1>
        <p class="text-muted mb-0">Informasi lengkap alumni</p>
    </div>
    <div class="d-flex gap-2">
        @auth
            @if(Auth::user()->role === 'admin')
                <a href="/alumni/{{ $alumni->id }}/edit" class="btn btn-outline-warning">
                    <i class="fas fa-edit me-1"></i> Edit
                </a>
            @endif
        @endauth
        <a href="/alumni" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <div class="text-muted small">Nama</div>
                <div class="fw-semibold">{{ $alumni->nama }}</div>
            </div>
            <div class="col-md-6">
                <div class="text-muted small">NIM</div>
                <div class="fw-semibold">{{ $alumni->nim }}</div>
            </div>
            <div class="col-md-6">
                <div class="text-muted small">Program Studi</div>
                <div class="fw-semibold">{{ $alumni->program_studi }}</div>
            </div>
            <div class="col-md-3">
                <div class="text-muted small">Angkatan</div>
                <div class="fw-semibold">{{ $alumni->angkatan }}</div>
            </div>
            <div class="col-md-3">
                <div class="text-muted small">Tahun Lulus</div>
                <div class="fw-semibold">{{ $alumni->tahun_lulus }}</div>
            </div>

            <div class="col-md-6">
                <div class="text-muted small">Email</div>
                <div class="fw-semibold">{{ $alumni->email }}</div>
            </div>

            <div class="col-12">
                <div class="text-muted small">Alamat</div>
                <div class="fw-semibold" style="white-space: pre-wrap;">{{ $alumni->alamat ?? '-' }}</div>
            </div>
        </div>
    </div>
</div>
@endsection

