@extends('layouts.admin')

@section('title', 'Tracer Study')
@section('page-title', 'Tracer Study')

@section('content')
<div class="page-header d-flex align-items-center justify-content-between">
    <div>
        <h1>Tracer Study</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Tracer Study</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.tracer.export') }}" class="btn btn-success btn-sm px-3">
            <i class="fas fa-file-excel me-1"></i> Export Excel
        </a>
    </div>
</div>

{{-- SUMMARY CARDS --}}
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card text-center py-3">
            <div class="card-body">
                <div class="text-primary fs-1"><i class="fas fa-users"></i></div>
                <div class="fs-2 fw-bold text-primary mt-1">{{ $totalResponden ?? 0 }}</div>
                <div class="text-muted small">Total Responden</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center py-3">
            <div class="card-body">
                <div class="text-success fs-1"><i class="fas fa-user-tie"></i></div>
                <div class="fs-2 fw-bold text-success mt-1">{{ $bekerja ?? 0 }}</div>
                <div class="text-muted small">Sudah Bekerja</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center py-3">
            <div class="card-body">
                <div class="text-warning fs-1"><i class="fas fa-store"></i></div>
                <div class="fs-2 fw-bold text-warning mt-1">{{ $wirausaha ?? 0 }}</div>
                <div class="text-muted small">Wirausaha</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center py-3">
            <div class="card-body">
                <div class="text-info fs-1"><i class="fas fa-university"></i></div>
                <div class="fs-2 fw-bold text-info mt-1">{{ $lanjutStudi ?? 0 }}</div>
                <div class="text-muted small">Lanjut Studi</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    {{-- CHART --}}
    <div class="col-md-5">
        <div class="card h-100">
            <div class="card-header bg-white py-3 fw-semibold">
                <i class="fas fa-chart-pie me-2 text-primary"></i>Status Pekerjaan Alumni
            </div>
            <div class="card-body d-flex align-items-center justify-content-center">
                <canvas id="statusChart" height="260"></canvas>
            </div>
        </div>
    </div>

    {{-- DATA TABLE --}}
    <div class="col-md-7">
        <div class="card h-100">
            <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                <span class="fw-semibold"><i class="fas fa-list me-2 text-info"></i>Data Responden</span>
                <span class="badge bg-secondary">{{ $tracers->total() ?? 0 }}</span>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Nama Alumni</th>
                            <th>Angkatan</th>
                            <th>Status</th>
                            <th>Perusahaan</th>
                            <th>Tahun Isi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tracers as $t)
                        <tr>
                            <td style="font-size:.85rem;" class="fw-semibold">{{ $t->nama_alumni ?? $t->alumni->nama ?? '-' }}</td>
                            <td>{{ $t->angkatan ?? '-' }}</td>
                            <td>
                                @php $map=['bekerja'=>'success','wirausaha'=>'warning','melanjutkan_studi'=>'info','belum_bekerja'=>'secondary']; @endphp
                                <span class="badge bg-{{ $map[$t->status_kerja ?? ''] ?? 'secondary' }}" style="font-size:.72rem;">
                                    {{ ucwords(str_replace('_',' ',$t->status_kerja ?? '-')) }}
                                </span>
                            </td>
                            <td style="font-size:.82rem;">{{ $t->perusahaan ?? '-' }}</td>
                            <td style="font-size:.82rem;" class="text-muted">{{ $t->created_at ? $t->created_at->format('Y') : '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">Belum ada data tracer study</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if(isset($tracers) && $tracers->hasPages())
            <div class="card-footer bg-white">{{ $tracers->links() }}</div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
const ctx = document.getElementById('statusChart');
if (ctx) {
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Bekerja', 'Wirausaha', 'Lanjut Studi', 'Belum Bekerja'],
            datasets: [{
                data: [{{ $bekerja ?? 0 }}, {{ $wirausaha ?? 0 }}, {{ $lanjutStudi ?? 0 }}, {{ $belumBekerja ?? 0 }}],
                backgroundColor: ['#10b981','#f59e0b','#0ea5e9','#94a3b8'],
                borderWidth: 0,
                hoverOffset: 6
            }]
        },
        options: {
            cutout: '65%',
            plugins: {
                legend: { position: 'bottom', labels: { padding: 16, font: { size: 12 } } }
            }
        }
    });
}
</script>
@endpush
@endsection