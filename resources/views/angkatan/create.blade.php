@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Angkatan</h2>

    <form action="{{ route('angkatan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Tahun</label>
            <input type="text" name="tahun" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nama Angkatan</label>
            <input type="text" name="nama_angkatan" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('angkatan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection