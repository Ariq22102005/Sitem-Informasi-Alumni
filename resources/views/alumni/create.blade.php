@extends('layouts.app')

@section('title', 'Tambah Alumni')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <div>
        <h1 class="h4 fw-bold mb-1">Tambah Alumni</h1>
        <p class="text-muted mb-0">Masukkan data alumni baru</p>
    </div>
    <a href="/alumni" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="/alumni" method="POST" class="row g-3">
            @csrf

            <div class="col-md-6">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">NIM</label>
                <input type="text" name="nim" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Jurusan</label>
                <input type="text" name="jurusan" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Angkatan</label>
                <input type="number" name="angkatan" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Tahun Lulus</label>
                <input type="number" name="tahun_lulus" class="form-control" required>
            </div>

            <div class="col-12 d-flex gap-2 pt-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Simpan
                </button>
                <a href="/alumni" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

