@extends('layouts.app')

@section('title', 'Alumni')

@section('content')
<div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
    <div>
        <h1 class="h4 fw-bold mb-1">Data Alumni</h1>
        <p class="text-muted mb-0">Kelola data alumni universitas</p>
    </div>
    @auth
        @if(Auth::user()->role === 'admin')
            <a href="/alumni/create" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Tambah Alumni
            </a>
        @endif
    @endauth
</div>

<div class="row g-3 mb-3">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="text-muted small mb-1">Total Alumni</div>
                <div class="fs-3 fw-bold">{{ $alumnis->count() }}</div>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th style="width: 70px;">No</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Jurusan</th>
                    <th>Angkatan</th>
                    <th>Tahun Lulus</th>
                    <th class="text-center" style="width: 220px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($alumnis as $alumni)
                    <tr>
                        <td class="text-muted">{{ $loop->iteration }}</td>
                        <td class="fw-semibold">{{ $alumni->nama }}</td>
                        <td>{{ $alumni->nim }}</td>
                        <td>{{ $alumni->program_studi }}</td>
                        <td>{{ $alumni->angkatan }}</td>
                        <td>{{ $alumni->tahun_lulus }}</td>
                        <td class="text-center text-nowrap">
                            <a href="/alumni/{{ $alumni->id }}" class="btn btn-sm btn-outline-primary" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            @auth
                                @if(Auth::user()->role === 'admin')
                                    <a href="/alumni/{{ $alumni->id }}/edit" class="btn btn-sm btn-outline-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="/alumni/{{ $alumni->id }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data alumni ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            @endauth
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">
                            <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                            Belum ada data alumni
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

