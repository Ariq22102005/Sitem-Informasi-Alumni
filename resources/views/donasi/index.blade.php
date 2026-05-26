@extends('layouts.app')

@section('title', 'Donasi Alumni')

@section('content')
<div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
    <div>
        <h1 class="h4 fw-bold mb-1">Riwayat Donasi Alumni</h1>
        <p class="text-muted mb-0">Terima kasih atas kontribusi Anda untuk kemajuan universitas</p>
    </div>
</div>

<div class="row g-3 mb-3">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="text-muted small mb-1">Total Donatur</div>
                <div class="fs-3 fw-bold">{{ $donasi->count() }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="text-muted small mb-1">Total Donasi</div>
                <div class="fs-3 fw-bold">Rp. {{ number_format($donasi->sum('jumlah_donasi'), 0, ',', '.') }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="text-muted small mb-1">Rata-rata Donasi</div>
                <div class="fs-3 fw-bold">Rp. {{ $donasi->count() > 0 ? number_format($donasi->avg('jumlah_donasi'), 0, ',', '.') : '0' }}</div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th style="width: 70px;">No</th>
                    <th>Nama Donatur</th>
                    <th>Program Studi</th>
                    <th class="text-end">Jumlah Donasi</th>
                    <th>Catatan</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($donasi as $item)
                    <tr>
                        <td class="text-muted">{{ $loop->iteration }}</td>
                        <td class="fw-semibold">{{ $item->nama_donatur }}</td>
                        <td>{{ $item->program_studi }}</td>
                        <td class="text-end fw-semibold">Rp. {{ number_format($item->jumlah_donasi, 0, ',', '.') }}</td>
                        <td>{{ $item->catatan ?? '-' }}</td>
                        <td class="text-muted small">{{ $item->created_at->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-5">
                            <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                            Belum ada data donasi
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
