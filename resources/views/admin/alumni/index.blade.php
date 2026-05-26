@extends('layouts.admin')

@section('title', 'Data Alumni')
@section('page-title', 'Data Alumni')

@section('content')
<div class="page-header d-flex align-items-center justify-content-between">
    <div>
        <h1>Data Alumni</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Data Alumni</li>
            </ol>
        </nav>
    </div>
    <a href="{{ route('admin.alumni.create') }}" class="btn btn-primary btn-sm px-3">
        <i class="fas fa-plus me-1"></i> Tambah Alumni
    </a>
</div>

{{-- FILTER --}}
<div class="card mb-3">
    <div class="card-body py-3">
        <form action="{{ route('admin.alumni.index') }}" method="GET" class="row g-2 align-items-end">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari nama / NIM..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="angkatan" class="form-select form-select-sm">
                    <option value="">Semua Angkatan</option>
                    @for($y = date('Y'); $y >= 2000; $y--)
                        <option value="{{ $y }}" {{ request('angkatan') == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-3">
                <select name="status_kerja" class="form-select form-select-sm">
                    <option value="">Semua Status</option>
                    <option value="bekerja" {{ request('status_kerja') === 'bekerja' ? 'selected' : '' }}>Bekerja</option>
                    <option value="wirausaha" {{ request('status_kerja') === 'wirausaha' ? 'selected' : '' }}>Wirausaha</option>
                    <option value="melanjutkan_studi" {{ request('status_kerja') === 'melanjutkan_studi' ? 'selected' : '' }}>Melanjutkan Studi</option>
                    <option value="belum_bekerja" {{ request('status_kerja') === 'belum_bekerja' ? 'selected' : '' }}>Belum Bekerja</option>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-1">
                <button type="submit" class="btn btn-primary btn-sm flex-fill">
                    <i class="fas fa-search"></i>
                </button>
                <a href="{{ route('admin.alumni.index') }}" class="btn btn-outline-secondary btn-sm flex-fill">
                    <i class="fas fa-times"></i>
                </a>
            </div>
        </form>
    </div>
</div>

{{-- TABLE --}}
<div class="card">
    <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
        <span class="fw-semibold"><i class="fas fa-user-graduate me-2 text-primary"></i>Daftar Alumni</span>
        <span class="badge bg-secondary">{{ $alumni->total() ?? 0 }} data</span>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th width="40">#</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Angkatan</th>
                    <th>Program Studi</th>
                    <th>Status Kerja</th>
                    <th>No. HP</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($alumni as $i => $a)
                <tr>
                    <td class="text-muted">{{ $alumni->firstItem() + $i }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div style="width:32px;height:32px;border-radius:50%;background:#4f46e5;color:#fff;display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:600;flex-shrink:0;">
                                {{ strtoupper(substr($a->nama, 0, 1)) }}
                            </div>
                            <div>
                                <div class="fw-semibold" style="font-size:.88rem;">{{ $a->nama }}</div>
                                <div class="text-muted" style="font-size:.75rem;">{{ $a->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td style="font-size:.85rem;">{{ $a->nim }}</td>
                    <td>{{ $a->angkatan }}</td>
                    <td style="font-size:.85rem;">{{ $a->program_studi }}</td>
                    <td>
                        @php $statusMap = ['bekerja'=>'success','wirausaha'=>'info','melanjutkan_studi'=>'primary','belum_bekerja'=>'warning']; @endphp
                        <span class="badge bg-{{ $statusMap[$a->status_kerja ?? ''] ?? 'secondary' }}">
                            {{ ucwords(str_replace('_', ' ', $a->status_kerja ?? 'Belum diisi')) }}
                        </span>
                    </td>
                    <td style="font-size:.85rem;">{{ $a->no_hp ?? '-' }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.alumni.show', $a) }}" class="btn btn-sm btn-outline-info py-0 px-2" title="Detail">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.alumni.edit', $a) }}" class="btn btn-sm btn-outline-warning py-0 px-2" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.alumni.destroy', $a) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus alumni ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger py-0 px-2" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-5">
                        <i class="fas fa-user-slash fa-2x mb-2 d-block"></i>
                        Belum ada data alumni
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if(isset($alumni) && $alumni->hasPages())
    <div class="card-footer bg-white">
        {{ $alumni->withQueryString()->links() }}
    </div>
    @endif
</div>
@endsection