@extends('layouts.admin')

@section('title', 'Tambah Lowongan')
@section('page-title', 'Tambah Lowongan')

@section('content')
<div class="page-header mb-4">
    <h1>Tambah Lowongan Kerja</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.lowongan.index') }}">Lowongan</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </nav>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.lowongan.store') }}" method="POST">
            @csrf
            @include('admin.lowongan._form')
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan</button>
                <a href="{{ route('admin.lowongan.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
