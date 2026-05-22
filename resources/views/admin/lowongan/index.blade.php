@extends('layouts.admin')

@section('title', 'Lowongan Kerja')
@section('page-title', 'Lowongan Kerja')

@section('content')
<div class="page-header d-flex align-items-center justify-content-between">
    <div>
        <h1>Lowongan Kerja</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Lowongan Kerja</li>
            </ol>
        </nav>
    </div>
    <a href="{{ route('admin.lowongan.create') }}" class="btn btn-primary btn-sm px-3">
        <i class="fas fa-plus me-1"></i> Posting Lowongan
    </a>
</div>

{{-- FILTER --}}
<div class="card mb-3">
    <div class="card-body py-3">
        <form action="{{ route('admin.lowongan.index') }}" method="GET" class="row g-2 align-items-end">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari posisi / perusahaan..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="tipe" class="form-select form-select-sm">
                    <option value="">Semua Tipe</option>
                    <option value="full_time" {{ request('tipe') === 'full_time' ? 'selected' : '' }}>Full Time</option>
                    <option value="part_time" {{ request('tipe') === 'part_time' ? 'selected' : '' }}>Part Time</option>
                    <option value="magang" {{ request('tipe') === 'magang' ? 'selected' : '' }}>Magang</option>
                    <option value="freelance" {{ request('tipe') === 'freelance' ? 'selected' : '' }}>Freelance</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select form-select-sm">
                    <option value="">Semua Status</option>
                    <option value="aktif" {{ request('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="tutup" {{ request('status') === 'tutup' ? 'selected' : '' }}>Tutup</option>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-1">
                <button type="submit" class="btn btn-primary btn-sm flex-fill"><i class="fas fa-search"></i></button>
                <a href="{{ route('admin.lowongan.index') }}" class="btn btn-outline-secondary btn-sm flex-fill"><i class="fas fa-times"></i></a>
            </div>
        </form>
    </div>
</div>

{{-- TABLE --}}
<div class="card">
    <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
        <span class="fw-semibold"><i class="fas fa-briefcase me-2 text-success"></i>Daftar Lowongan</span>
        <span class="badge bg-secondary">{{ $lowongans->total() ?? 0 }} data</span>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th width="40">#</th>
                    <th>Posisi / Perusahaan</th>
                    <th>Tipe</th>
                    <th>Lokasi</th>
                    <th>Batas Lamar</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($lowongans as $i => $l)
                <tr>
                    <td class="text-muted">{{ $lowongans->firstItem() + $i }}</td>
                    <td>
                        <div class="fw-semibold" style="font-size:.88rem;">{{ $l->posisi }}</div>
                        <div class="text-muted" style="font-size:.78rem;"><i class="fas fa-building me-1"></i>{{ $l->perusahaan }}</div>
                    </td>
                    <td>
                        @php $tipeMap=['full_time'=>'primary','part_time'=>'info','magang'=>'warning','freelance'=>'secondary']; @endphp
                        <span class="badge bg-{{ $tipeMap[$l->tipe ?? ''] ?? 'secondary' }}">
                            {{ ucwords(str_replace('_',' ',$l->tipe ?? '-')) }}
                        </span>
                    </td>
                    <td style="font-size:.85rem;">{{ $l->lokasi ?? '-' }}</td>
                    <td style="font-size:.83rem;">
                        @if($l->batas_lamar)
                            {{ \Carbon\Carbon::parse($l->batas_lamar)->format('d M Y') }}
                        @else -
                        @endif
                    </td>
                    <td>
                        <span class="badge bg-{{ ($l->status ?? '') === 'aktif' ? 'success' : 'danger' }}">
                            {{ ucfirst($l->status ?? 'tutup') }}
                        </span>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.lowongan.show', $l) }}" class="btn btn-sm btn-outline-info py-0 px-2"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('admin.lowongan.edit', $l) }}" class="btn btn-sm btn-outline-warning py-0 px-2"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.lowongan.destroy', $l) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus lowongan ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger py-0 px-2"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-5">
                        <i class="fas fa-briefcase fa-2x mb-2 d-block"></i>
                        Belum ada lowongan kerja
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if(isset($lowongans) && $lowongans->hasPages())
    <div class="card-footer bg-white">
        {{ $lowongans->withQueryString()->links() }}
    </div>
    @endif
</div>
@endsection 