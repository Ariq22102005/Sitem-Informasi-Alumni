@extends('layouts.admin')

@section('title', 'Edit Foto')
@section('page-title', 'Edit Foto')

@section('content')
<div class="page-header d-flex align-items-center justify-content-between mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.galeri.index') }}">Galeri</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
</div>

<div class="card" style="max-width:600px;">
    <div class="card-header bg-white py-3 fw-semibold">
        <i class="fas fa-edit me-2 text-warning"></i> Edit Foto
    </div>
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        @endif

        {{-- Preview foto saat ini --}}
        <div class="mb-3">
            <label class="form-label fw-semibold text-muted">Foto Saat Ini</label>
            <div>
                <img src="{{ Storage::url($galeri->file_path) }}" alt="{{ $galeri->judul }}"
                     style="max-height:200px; border-radius:8px; object-fit:cover;">
            </div>
        </div>

        <form action="{{ route('admin.galeri.update', $galeri) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-semibold">Judul <span class="text-danger">*</span></label>
                <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                       value="{{ old('judul', $galeri->judul) }}" required>
                @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Ganti Foto</label>
                <input type="file" name="file_path" class="form-control @error('file_path') is-invalid @enderror"
                       accept="image/*">
                <div class="form-text">Kosongkan jika tidak ingin mengganti foto. Maks 3MB.</div>
                @error('file_path')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Kategori</label>
                <input type="text" name="kategori" class="form-control"
                       value="{{ old('kategori', $galeri->kategori) }}">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="3">{{ old('keterangan', $galeri->keterangan) }}</textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning px-4">
                    <i class="fas fa-save me-1"></i> Update
                </button>
                <a href="{{ route('admin.galeri.index') }}" class="btn btn-secondary px-4">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection