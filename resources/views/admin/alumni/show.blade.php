@extends('layouts.admin')

@section('title', 'Detail Alumni')
@section('page-title', 'Detail Alumni')

@section('content')
<div class="page-header d-flex align-items-center justify-content-between mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.alumni.index') }}">Data Alumni</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    </nav>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.alumni.edit', $alumni) }}" class="btn btn-warning btn-sm px-3">
            <i class="fas fa-edit me-1"></i> Edit
        </a>
        <form action="{{ route('admin.alumni.destroy', $alumni) }}" method="POST"
              onsubmit="return confirm('Hapus data alumni ini?')">
            @csrf @method('DELETE')
            <button class="btn btn-danger btn-sm px-3"><i class="fas fa-trash me-1"></i> Hapus</button>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-header bg-white py-3 fw-semibold">
                <i class="fas fa-user-graduate me-2 text-primary"></i> Data Pribadi
            </div>
            <div class="card-body">
                <table class="table table-borderless mb-0" style="font-size:.9rem;">
                    <tr>
                        <td class="text-muted" width="35%">Nama Lengkap</td>
                        <td class="fw-semibold">{{ $alumni->nama }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">NIM</td>
                        <td>{{ $alumni->nim }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Email</td>
                        <td>{{ $alumni->email }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">No. HP</td>
                        <td>{{ $alumni->no_hp ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Alamat</td>
                        <td>{{ $alumni->alamat ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-white py-3 fw-semibold">
                <i class="fas fa-briefcase me-2 text-success"></i> Data Akademik & Pekerjaan
            </div>
            <div class="card-body">
                <table class="table table-borderless mb-0" style="font-size:.9rem;">
                    <tr>
                        <td class="text-muted" width="35%">Program Studi</td>
                        <td>{{ $alumni->program_studi }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Angkatan</td>
                        <td>{{ $alumni->angkatan }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Tahun Lulus</td>
                        <td>{{ $alumni->tahun_lulus ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">IPK</td>
                        <td>{{ $alumni->ipk ? number_format($alumni->ipk, 2) : '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Status Kerja</td>
                        <td>
                            @php
                                $statusMap = [
                                    'bekerja' => ['label' => 'Bekerja', 'color' => 'success'],
                                    'wirausaha' => ['label' => 'Wirausaha', 'color' => 'info'],
                                    'melanjutkan_studi' => ['label' => 'Melanjutkan Studi', 'color' => 'primary'],
                                    'belum_bekerja' => ['label' => 'Belum Bekerja', 'color' => 'secondary'],
                                ];
                                $s = $statusMap[$alumni->status_kerja] ?? null;
                            @endphp
                            @if($s)
                                <span class="badge bg-{{ $s['color'] }}">{{ $s['label'] }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted">Perusahaan</td>
                        <td>{{ $alumni->perusahaan ?? '-' }}</td>
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
                <p>Ditambahkan:<br><strong>{{ $alumni->created_at->format('d M Y, H:i') }}</strong></p>
                <p class="mb-0">Diperbarui:<br><strong>{{ $alumni->updated_at->format('d M Y, H:i') }}</strong></p>
            </div>
        </div>
    </div>
</div>
@endsection