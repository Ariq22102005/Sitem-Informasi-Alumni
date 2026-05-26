@extends('layouts.admin')

@section('title', 'Edit Donasi')
@section('page-title', 'Donasi')
@section('content')
<div class="page-header d-flex align-items-center justify-content-between mb-3">
    <div>
        <h1>Edit Donasi</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.donasi.index') }}">Donasi</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card" style="max-width: 720px;">
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.donasi.update', $donasi) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Donatur <span class="text-danger">*</span></label>
                <input type="text"
                       name="nama_donatur"
                       class="form-control @error('nama_donatur') is-invalid @enderror"
                       value="{{ old('nama_donatur', $donasi->nama_donatur) }}"
                       required>
                @error('nama_donatur')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Program Studi <span class="text-danger">*</span></label>
                <input type="text"
                       name="program_studi"
                       class="form-control @error('program_studi') is-invalid @enderror"
                       value="{{ old('program_studi', $donasi->program_studi) }}"
                       required>
                @error('program_studi')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Jumlah Donasi (Rp) <span class="text-danger">*</span></label>
                <input type="number"
                       name="jumlah_donasi"
                       min="0"
                       class="form-control @error('jumlah_donasi') is-invalid @enderror"
                       value="{{ old('jumlah_donasi', $donasi->jumlah_donasi) }}"
                       required>
                @error('jumlah_donasi')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Catatan <span class="text-muted">(opsional)</span></label>
                <textarea name="catatan" rows="4" class="form-control @error('catatan') is-invalid @enderror">{{ old('catatan', $donasi->catatan) }}</textarea>
                @error('catatan')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fas fa-save me-1"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.donasi.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

