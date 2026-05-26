@extends('layouts.admin')

@section('title', 'Detail Tracer Study')
@section('page-title', 'Detail Tracer Study')

@section('content')
<div class="page-header d-flex align-items-center justify-content-between mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.tracer.index') }}">Tracer Study</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    </nav>
    <form action="{{ route('admin.tracer.destroy', $tracer) }}" method="POST"
          onsubmit="return confirm('Hapus data ini?')">
        @csrf @method('DELETE')
        <button class="btn btn-danger btn-sm px-3"><i class="fas fa-trash me-1"></i> Hapus</button>
    </form>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-header bg-white py-3 fw-semibold">
                <i class="fas fa-user me-2 text-primary"></i> Data Alumni
            </div>
            <div class="card-body">
                <table class="table table-borderless mb-0" style="font-size:.9rem;">
                    <tr>
                        <td class="text-muted" width="40%">Nama Alumni</td>
                        <td class="fw-semibold">{{ $tracer->nama_alumni ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Angkatan</td>
                        <td>{{ $tracer->angkatan ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-white py-3 fw-semibold">
                <i class="fas fa-briefcase me-2 text-success"></i> Data Pekerjaan
            </div>
            <div class="card-body">
                <table class="table table-borderless mb-0" style="font-size:.9rem;">
                    <tr>
                        <td class="text-muted" width="40%">Status Kerja</td>
                        <td>
                            @php
                                $map = ['bekerja'=>['Bekerja','success'],'wirausaha'=>['Wirausaha','info'],'melanjutkan_studi'=>['Lanjut Studi','primary'],'belum_bekerja'=>['Belum Bekerja','secondary']];
                                $s = $map[$tracer->status_kerja] ?? null;
                            @endphp
                            @if($s)
                                <span class="badge bg-{{ $s[1] }}">{{ $s[0] }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted">Perusahaan</td>
                        <td>{{ $tracer->perusahaan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Jabatan</td>
                        <td>{{ $tracer->jabatan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Bidang Pekerjaan</td>
                        <td>{{ $tracer->bidang_pekerjaan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Gaji Awal</td>
                        <td>{{ $tracer->gaji_awal ? 'Rp ' . number_format($tracer->gaji_awal, 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Bulan Tunggu Kerja</td>
                        <td>{{ $tracer->bulan_tunggu_kerja ? $tracer->bulan_tunggu_kerja . ' bulan' : '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Relevan dengan Studi</td>
                        <td>
                            @if($tracer->relevan_dengan_studi === null)
                                <span class="text-muted">-</span>
                            @elseif($tracer->relevan_dengan_studi)
                                <span class="badge bg-success">Ya</span>
                            @else
                                <span class="badge bg-danger">Tidak</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted">Komentar</td>
                        <td>{{ $tracer->komentar ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-white py-3 fw-semibold">
                <i class="fas fa-clock me-2 text-muted"></i> Info
            </div>
            <div class="card-body text-muted" style="font-size:.85rem;">
                <p>Diisi pada:<br><strong>{{ $tracer->created_at->format('d M Y, H:i') }}</strong></p>
            </div>
        </div>
    </div>
</div>
@endsection