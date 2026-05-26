@extends('layouts.admin')

@section('title', 'Kelola Lowongan Kerja')
@section('page-title', 'Lowongan Kerja')
@section('page-subtitle', 'Kelola, edit, dan validasi status lowongan untuk alumni.')

@section('content')
<div class="card mb-3">
    <div class="card-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
            <span class="badge bg-light text-dark border">
                <i class="fas fa-briefcase me-1 text-success"></i>{{ $lowongans->total() ?? 0 }} data
            </span>
            <a href="{{ route('admin.lowongan.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Tambah Lowongan
            </a>
        </div>

        <form action="{{ route('admin.lowongan.index') }}" method="GET" class="row g-2 align-items-end">
            <div class="col-md-4">
                <label class="form-label small text-muted mb-1">Kata kunci</label>
                <input type="text" name="search" class="form-control" placeholder="Cari posisi / perusahaan / lokasi..."
                       value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label small text-muted mb-1">Tipe</label>
                <select name="tipe" class="form-select">
                    <option value="">Semua Tipe</option>
                    @foreach (\App\Models\Lowongan::TIPE_OPTIONS as $value => $label)
                        <option value="{{ $value }}" @selected(request('tipe') === $value)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label small text-muted mb-1">Status</label>
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="aktif" @selected(request('status') === 'aktif')>Aktif</option>
                    <option value="tutup" @selected(request('status') === 'tutup')>Ditutup</option>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-fill" title="Cari"><i class="fas fa-search"></i></button>
                <a href="{{ route('admin.lowongan.index') }}" class="btn btn-outline-secondary flex-fill" title="Reset"><i class="fas fa-times"></i></a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th style="width: 70px;">#</th>
                    <th>Posisi / Perusahaan</th>
                    <th style="width: 120px;">Tipe</th>
                    <th style="width: 160px;">Lokasi</th>
                    <th style="width: 140px;">Batas</th>
                    <th style="width: 110px;">Status</th>
                    <th class="text-center" style="width: 180px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($lowongans as $i => $l)
                    <tr>
                        <td class="text-muted">{{ $lowongans->firstItem() + $i }}</td>
                        <td>
                            <div class="fw-semibold">{{ $l->posisi }}</div>
                            <small class="text-muted"><i class="fas fa-building me-1"></i>{{ $l->perusahaan }}</small>
                        </td>
                        <td><span class="badge bg-primary">{{ $l->tipe_label }}</span></td>
                        <td>{{ $l->lokasi ?? '—' }}</td>
                        <td>{{ $l->batas_lamar?->format('d M Y') ?? '—' }}</td>
                        <td>
                            <span class="badge bg-{{ $l->status === 'aktif' ? 'success' : 'danger' }}">
                                {{ ucfirst($l->status) }}
                            </span>
                        </td>
                        <td class="text-center text-nowrap">
                            <a href="{{ route('admin.lowongan.show', $l) }}" class="btn btn-sm btn-outline-info" title="Detail"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('admin.lowongan.edit', $l) }}" class="btn btn-sm btn-outline-warning" title="Edit"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.lowongan.toggle-status', $l) }}" method="POST" class="d-inline">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-outline-secondary" title="Ubah status">
                                    <i class="fas fa-toggle-on"></i>
                                </button>
                            </form>
                            <form action="{{ route('admin.lowongan.destroy', $l) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus lowongan ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" title="Hapus"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">
                            <i class="fas fa-briefcase fa-2x mb-2 d-block"></i>
                            Belum ada lowongan kerja. <a href="{{ route('admin.lowongan.create') }}">Tambah sekarang</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if (isset($lowongans) && $lowongans->hasPages())
        <div class="card-footer bg-white">
            {{ $lowongans->withQueryString()->links() }}
        </div>
    @endif
</div>
@endsection

