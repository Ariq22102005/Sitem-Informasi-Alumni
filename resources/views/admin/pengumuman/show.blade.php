@extends('layouts.admin')

@section('title', 'Detail Pengumuman')
@section('page-title', 'Detail Pengumuman')

@section('content')
<div class="page-header d-flex align-items-center justify-content-between mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.pengumuman.index') }}">Pengumuman</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    </nav>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.pengumuman.edit', $pengumuman) }}" class="btn btn-warning btn-sm px-3">
            <i class="fas fa-edit me-1"></i> Edit
        </a>
        <form action="{{ route('admin.pengumuman.destroy', $pengumuman) }}" method="POST"
              onsubmit="return confirm('Hapus pengumuman ini?')">
            @csrf @method('DELETE')
            <button class="btn btn-danger btn-sm px-3"><i class="fas fa-trash me-1"></i> Hapus</button>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body p-4">
        <div class="d-flex align-items-center gap-2 mb-3">
            @php $priMap = ['tinggi' => 'danger', 'sedang' => 'warning', 'rendah' => 'secondary']; @endphp
            <span class="badge bg-{{ $priMap[$pengumuman->prioritas ?? 'rendah'] ?? 'secondary' }} fs-6">
                {{ ucfirst($pengumuman->prioritas ?? 'rendah') }}
            </span>
            <span class="badge bg-{{ $pengumuman->status === 'aktif' ? 'success' : 'secondary' }} fs-6">
                {{ ucfirst($pengumuman->status) }}
            </span>
        </div>

        <h3 class="fw-bold mb-3">{{ $pengumuman->judul }}</h3>

        <div class="text-muted mb-4" style="font-size:.85rem;">
            <i class="fas fa-calendar me-1"></i>
            {{ $pengumuman->tanggal_mulai ? $pengumuman->tanggal_mulai->format('d M Y') : 'Tidak ditentukan' }}
            @if($pengumuman->tanggal_selesai)
                &mdash; {{ $pengumuman->tanggal_selesai->format('d M Y') }}
            @else
                &mdash; Selamanya
            @endif
        </div>

        <hr>

        <div class="mt-3" style="white-space: pre-line;">{{ $pengumuman->isi }}</div>
    </div>
    <div class="card-footer bg-white text-muted" style="font-size:.8rem;">
        Dibuat: {{ $pengumuman->created_at->format('d M Y, H:i') }} &bull;
        Diperbarui: {{ $pengumuman->updated_at->format('d M Y, H:i') }}
    </div>
</div>
@endsection