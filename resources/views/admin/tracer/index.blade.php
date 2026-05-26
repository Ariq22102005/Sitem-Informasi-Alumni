@extends('layouts.admin')

@section('title', 'Tracer Study')
@section('page-title', 'Tracer Study')

@section('content')
<div class="page-header d-flex align-items-center justify-content-between mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Tracer Study</li>
        </ol>
    </nav>
    <a href="{{ route('admin.tracer.export') }}" class="btn btn-success btn-sm px-3">
        <i class="fas fa-file-csv me-1"></i> Export CSV
    </a>
</div>

{{-- Statistik --}}
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <div class="fs-3 fw-bold text-primary">{{ $totalResponden }}</div>
                <div class="text-muted" style="font-size:.85rem;">Total Responden</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <div class="fs-3 fw-bold text-success">{{ $bekerja }}</div>
                <div class="text-muted" style="font-size:.85rem;">Bekerja</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <div class="fs-3 fw-bold text-info">{{ $wirausaha }}</div>
                <div class="text-muted" style="font-size:.85rem;">Wirausaha</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <div class="fs-3 fw-bold text-warning">{{ $lanjutStudi }}</div>
                <div class="text-muted" style="font-size:.85rem;">Lanjut Studi</div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header bg-white py-3 fw-semibold d-flex align-items-center justify-content-between">
        <span><i class="fas fa-chart-bar me-2 text-primary"></i>Data Tracer Study</span>
        <span class="badge bg-secondary">{{ $tracers->total() }}</span>
    </div>

    {{-- Search --}}
    <div class="card-body border-bottom pb-3">
        <form method="GET" class="d-flex gap-2">
            <input type="text" name="search" class="form-control form-control-sm" style="max-width:250px;"
                   placeholder="Cari nama alumni..." value="{{ request('search') }}">
            <button class="btn btn-sm btn-primary px-3">Cari</button>
            @if(request('search'))
                <a href="{{ route('admin.tracer.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
            @endif
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Alumni</th>
                    <th>Angkatan</th>
                    <th>Status Kerja</th>
                    <th>Perusahaan</th>
                    <th>Jabatan</th>
                    <th>Relevan</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tracers as $i => $t)
                <tr>
                    <td class="text-muted">{{ $tracers->firstItem() + $i }}</td>
                    <td class="fw-semibold">{{ $t->nama_alumni ?? '-' }}</td>
                    <td>{{ $t->angkatan ?? '-' }}</td>
                    <td>
                        @php
                            $map = ['bekerja'=>'success','wirausaha'=>'info','melanjutkan_studi'=>'primary','belum_bekerja'=>'secondary'];
                            $label = ['bekerja'=>'Bekerja','wirausaha'=>'Wirausaha','melanjutkan_studi'=>'Lanjut Studi','belum_bekerja'=>'Belum Bekerja'];
                        @endphp
                        <span class="badge bg-{{ $map[$t->status_kerja] ?? 'secondary' }}">
                            {{ $label[$t->status_kerja] ?? '-' }}
                        </span>
                    </td>
                    <td>{{ $t->perusahaan ?? '-' }}</td>
                    <td>{{ $t->jabatan ?? '-' }}</td>
                    <td>
                        @if($t->relevan_dengan_studi === null)
                            <span class="text-muted">-</span>
                        @elseif($t->relevan_dengan_studi)
                            <span class="badge bg-success">Ya</span>
                        @else
                            <span class="badge bg-danger">Tidak</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.tracer.show', $t) }}" class="btn btn-sm btn-outline-primary py-0 px-2">
                            <i class="fas fa-eye"></i>
                        </a>
                        <form action="{{ route('admin.tracer.destroy', $t) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Hapus data ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger py-0 px-2"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-5">
                        <i class="fas fa-chart-bar fa-2x mb-2 d-block"></i>
                        Belum ada data tracer study
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($tracers->hasPages())
        <div class="card-footer bg-white">{{ $tracers->withQueryString()->links() }}</div>
    @endif
</div>
@endsection