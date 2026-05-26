@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Angkatan</h2>

    <form action="{{ route('angkatan.update', $angkatan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Tahun</label>
            <input type="text" name="tahun" class="form-control" value="{{ $angkatan->tahun }}" required>
        </div>
        <div class="mb-3">
            <label>Nama Angkatan</label>
            <input type="text" name="nama_angkatan" class="form-control" value="{{ $angkatan->nama_angkatan }}">
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('angkatan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection