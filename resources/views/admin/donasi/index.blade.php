@extends('layouts.admin')

@section('title', 'Kelola Donasi')
@section('page-title', 'Kelola Donasi')

@section('content')
<div class="page-header d-flex align-items-center justify-content-between mb-3">
    <div>
        <h1>Donasi</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Donasi</li>
            </ol>
        </nav>
    </div>
    <a href="{{ route('admin.donasi.create') }}" class="btn btn-primary btn-sm px-3">
        <i class="fas fa-plus me-1"></i> Tambah Donasi
    </a>
</div>

<div class="card mb-3">
    <div class="card-body py-3">
        <form action="{{ route('admin.donasi.index') }}" method="GET" class="row g-2 align-items-end">
            <div class="col-md-6">
                <label class="form-label small text-muted mb-1">Cari</label>
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Nama donatur / Program studi..."
                    value="{{ request('search') }}"
                >
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-fill" title="Cari">
                    <i class="fas fa-search"></i>
                </button>
                <a href="{{ route('admin.donasi.index') }}" class="btn btn-outline-secondary flex-fill" title="Reset">
                    <i class="fas fa-times"></i>
                </a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header bg-white py-3 fw-semibold d-flex align-items-center justify-content-between">
        <span><i class="fas fa-hand-holding-heart me-2 text-primary"></i>Daftar Donasi</span>
        <span class="badge bg-secondary">{{ $donasis->total() ?? 0 }} data</span>
    </div>

    <div class="table-responsive">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th width="60">#</th>
                    <th>Nama Donatur</th>
                    <th>Program Studi</th>
                    <th>Jumlah</th>
                    <th>Catatan</th>
                    <th>Tanggal</th>
                    <th class="text-center" style="width: 140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($donasis as $i => $d)
                <tr>
                    <td class="text-muted">{{ $donasis->firstItem() + $i }}</td>
                    <td class="fw-semibold">{{ $d->nama_donatur }}</td>
                    <td>{{ $d->program_studi }}</td>
                    <td style="white-space: nowrap;">Rp {{ number_format($d->jumlah_donasi, 0, ',', '.') }}</td>
                    <td>
                        {{ $d->catatan ? \Illuminate\Support\Str::limit($d->catatan, 60) : '—' }}
                    </td>
                    <td style="font-size:.83rem;">
                        {{ $d->created_at?->format('d M Y H:i') ?? '-' }}
                    </td>
                    <td class="text-center text-nowrap">
                        <a href="{{ route('admin.donasi.show', $d) }}" class="btn btn-sm btn-outline-info py-0 px-2" title="Detail">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.donasi.edit', $d) }}" class="btn btn-sm btn-outline-warning py-0 px-2" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.donasi.destroy', $d) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data donasi ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger py-0 px-2" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-5">
                        <i class="fas fa-hand-holding-heart fa-2x mb-2 d-block"></i>
                        Belum ada data donasi
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if(isset($donasis) && $donasis->hasPages())
        <div class="card-footer bg-white">
            {{ $donasis->withQueryString()->links() }}
        </div>
    @endif
</div>
@endsection

