@extends('layouts.admin')

@section('title', 'Upload Foto')
@section('page-title', 'Upload Foto')

@section('content')
<div class="page-header d-flex align-items-center justify-content-between mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.galeri.index') }}">Galeri</a></li>
            <li class="breadcrumb-item active">Upload</li>
        </ol>
    </nav>
</div>

<div class="card" style="max-width:600px;">
    <div class="card-header bg-white py-3 fw-semibold">
        <i class="fas fa-upload me-2 text-primary"></i> Upload Foto Baru
    </div>
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        @endif

        <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Judul <span class="text-danger">*</span></label>
                <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                       value="{{ old('judul') }}" placeholder="Judul foto" required>
                @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Foto <span class="text-danger">*</span></label>
                <input type="file" name="file_path" class="form-control @error('file_path') is-invalid @enderror"
                       accept="image/*" required>
                <div class="form-text">Format: JPG, PNG, GIF. Maks 3MB.</div>
                @error('file_path')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Kategori</label>
                <input type="text" name="kategori" class="form-control"
                       value="{{ old('kategori') }}" placeholder="Contoh: Wisuda, Seminar, dll">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="3"
                          placeholder="Keterangan foto...">{{ old('keterangan') }}</textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fas fa-upload me-1"></i> Upload
                </button>
                <a href="{{ route('admin.galeri.index') }}" class="btn btn-secondary px-4">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection