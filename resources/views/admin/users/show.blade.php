@extends('layouts.admin')

@section('title', 'Detail User')
@section('page-title', 'Detail User')
@section('page-subtitle', 'Informasi lengkap akun')

@section('content')
<div class="page-header d-flex align-items-center justify-content-between mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Manajemen User</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    </nav>

    <div class="d-flex gap-2">
        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-sm px-3">
            <i class="fas fa-edit me-1"></i> Edit
        </a>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm px-3">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>
</div>

<div class="card" style="max-width: 740px;">
    <div class="card-body">
        <div class="d-flex align-items-start justify-content-between gap-3">
            <div>
                <div style="width:48px;height:48px;border-radius:50%;background:#4f46e5;color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
            </div>
            <div class="text-end">
                <div class="mb-2">
                    <span class="badge bg-{{ ($user->role ?? 'user') === 'admin' ? 'danger' : 'secondary' }}">
                        {{ ucfirst($user->role ?? 'user') }}
                    </span>
                </div>
                <div class="text-muted small">
                    Terdaftar: {{ $user->created_at?->format('d M Y') ?? '-' }}
                </div>
            </div>
        </div>

        <hr>

        <div class="row g-3">
            <div class="col-md-6">
                <div class="text-muted small">Nama</div>
                <div class="fw-semibold">{{ $user->name }}</div>
            </div>

            <div class="col-md-6">
                <div class="text-muted small">Email</div>
                <div class="fw-semibold">{{ $user->email }}</div>
            </div>

            <div class="col-md-6">
                <div class="text-muted small">Email Terverifikasi</div>
                <div>
                    @if($user->email_verified_at)
                        <span class="badge bg-success"><i class="fas fa-check me-1"></i> Ya</span>
                    @else
                        <span class="badge bg-warning text-dark"><i class="fas fa-clock me-1"></i> Belum</span>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="text-muted small">Status</div>
                <div class="text-muted">{{ $user->email_verified_at ? 'Aktif' : 'Menunggu verifikasi' }}</div>
            </div>
        </div>

        <hr>

        <div class="d-flex gap-2">
            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Hapus user ini?')" class="d-inline">
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

