@extends('layouts.app')

@section('title', 'Edit Alumni')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <div>
        <h1 class="h4 fw-bold mb-1">Edit Alumni</h1>
        <p class="text-muted mb-0">Perbarui data alumni</p>
    </div>
    <a href="/alumni" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="/alumni/{{ $alumni->id }}" method="POST" class="row g-3">
            @csrf
            @method('PUT')

            <div class="col-md-6">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" value="{{ $alumni->nama }}" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">NIM</label>
                <input type="text" name="nim" value="{{ $alumni->nim }}" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Jurusan</label>
                <input type="text" name="jurusan" value="{{ $alumni->jurusan }}" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Angkatan</label>
                <input type="number" name="angkatan" value="{{ $alumni->angkatan }}" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Tahun Lulus</label>
                <input type="number" name="tahun_lulus" value="{{ $alumni->tahun_lulus }}" class="form-control" required>
            </div>

            <div class="col-12 d-flex gap-2 pt-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Simpan Perubahan
                </button>
                <a href="/alumni" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

