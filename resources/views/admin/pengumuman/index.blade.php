@extends('layouts.admin')

@section('title', 'Pengumuman')
@section('page-title', 'Pengumuman')

@section('content')
<div class="page-header d-flex align-items-center justify-content-between">
    <div>
        <h1>Pengumuman</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Pengumuman</li>
            </ol>
        </nav>
    </div>
    <a href="{{ route('admin.pengumuman.create') }}" class="btn btn-primary btn-sm px-3">
        <i class="fas fa-plus me-1"></i> Buat Pengumuman
    </a>
</div>

<div class="card">
    <div class="card-header bg-white py-3 fw-semibold d-flex align-items-center justify-content-between">
        <span><i class="fas fa-bullhorn me-2 text-warning"></i>Daftar Pengumuman</span>
        <span class="badge bg-secondary">{{ $pengumumans->total() ?? 0 }}</span>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Prioritas</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Berakhir</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengumumans as $i => $p)
                <tr>
                    <td class="text-muted">{{ $pengumumans->firstItem() + $i }}</td>
                    <td>
                        <div class="fw-semibold" style="font-size:.88rem;">{{ $p->judul }}</div>
                        <div class="text-muted" style="font-size:.76rem;">{{ Str::limit($p->isi, 60) }}</div>
                    </td>
                    <td>
                        @php $priMap=['tinggi'=>'danger','sedang'=>'warning','rendah'=>'secondary']; @endphp
                        <span class="badge bg-{{ $priMap[$p->prioritas ?? 'rendah'] ?? 'secondary' }}">
                            {{ ucfirst($p->prioritas ?? 'rendah') }}
                        </span>
                    </td>
                    <td style="font-size:.83rem;">{{ $p->tanggal_mulai ? \Carbon\Carbon::parse($p->tanggal_mulai)->format('d M Y') : '-' }}</td>
                    <td style="font-size:.83rem;">{{ $p->tanggal_selesai ? \Carbon\Carbon::parse($p->tanggal_selesai)->format('d M Y') : 'Selamanya' }}</td>
                    <td>
                        <span class="badge bg-{{ ($p->status ?? '') === 'aktif' ? 'success' : 'secondary' }}">
                            {{ ucfirst($p->status ?? 'nonaktif') }}
                        </span>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.pengumuman.edit', $p) }}" class="btn btn-sm btn-outline-warning py-0 px-2"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.pengumuman.destroy', $p) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus pengumuman ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger py-0 px-2"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-5">
                        <i class="fas fa-bullhorn fa-2x mb-2 d-block"></i>
                        Belum ada pengumuman
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if(isset($pengumumans) && $pengumumans->hasPages())
    <div class="card-footer bg-white">{{ $pengumumans->withQueryString()->links() }}</div>
    @endif
</div>
@endsection