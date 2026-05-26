@extends('layouts.admin')

@section('title', 'Buat Berita Baru')
@section('page-title', 'Buat Berita Baru')

@section('content')
<div class="container py-3">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0">
                <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <h5 class="m-0 text-white fw-bold">
                        <i class="fas fa-plus-circle"></i> Buat Berita Baru
                    </h5>
                </div>
                <div class="card-body p-5">
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <div class="fw-bold mb-2">
                                <i class="fas fa-exclamation-circle"></i> Terjadi Kesalahan Validasi
                            </div>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Title & Category Row -->
                        <div class="row mb-4">
                            <div class="col-md-8">
                                <label for="title" class="form-label fw-bold">
                                    <i class="fas fa-heading"></i> Judul Berita <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control form-control-lg @error('title') is-invalid @enderror" 
                                       id="title" name="title" required value="{{ old('title') }}" 
                                       placeholder="Masukkan judul berita yang menarik">
                                @error('title')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="category" class="form-label fw-bold">
                                    <i class="fas fa-tag"></i> Kategori <span class="text-danger">*</span>
                                </label>
                                <select class="form-select form-select-lg @error('category') is-invalid @enderror" 
                                        id="category" name="category" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat }}" {{ old('category') === $cat ? 'selected' : '' }}>
                                            {{ $cat }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Excerpt -->
                        <div class="mb-4">
                            <label for="excerpt" class="form-label fw-bold">
                                <i class="fas fa-align-left"></i> Ringkasan Singkat
                            </label>
                            <textarea class="form-control @error('excerpt') is-invalid @enderror" 
                                      id="excerpt" name="excerpt" rows="3" 
                                      placeholder="Tulis ringkasan singkat berita (opsional, maks 500 karakter)">{{ old('excerpt') }}</textarea>
                            <small class="text-muted">
                                <span id="excerpt-count">0</span>/500 karakter
                            </small>
                            @error('excerpt')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div class="mb-4">
                            <label for="content" class="form-label fw-bold">
                                <i class="fas fa-file-alt"></i> Konten Berita <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control @error('content') is-invalid @enderror" 
                                      id="content" name="content" rows="12" required 
                                      placeholder="Tulis konten berita Anda di sini. Gunakan paragraf yang jelas dan mudah dipahami.">{{ old('content') }}</textarea>
                            <small class="text-muted d-block mt-2">Minimal 10 karakter</small>
                            @error('content')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Image & Date Row -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="featured_image" class="form-label fw-bold">
                                    <i class="fas fa-image"></i> Gambar Utama
                                </label>
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control @error('featured_image') is-invalid @enderror" 
                                           id="featured_image" name="featured_image" accept="image/*">
                                </div>
                                <small class="text-muted d-block">
                                    Format: JPG, PNG, GIF | Ukuran maksimal: 2MB
                                </small>
                                <div id="image-preview" class="mt-2"></div>
                                @error('featured_image')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="published_at" class="form-label fw-bold">
                                    <i class="fas fa-calendar-alt"></i> Tanggal Publikasi
                                </label>
                                <input type="datetime-local" class="form-control form-control-lg @error('published_at') is-invalid @enderror" 
                                       id="published_at" name="published_at" value="{{ old('published_at') }}">
                                <small class="text-muted d-block mt-2">Kosongkan untuk publikasi otomatis sekarang</small>
                                @error('published_at')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-3 mt-5">
                            <button type="submit" name="publish" value="1" class="btn btn-lg btn-success">
                                <i class="fas fa-paper-plane"></i> Publikasikan Sekarang
                            </button>
                            <button type="submit" class="btn btn-lg btn-secondary">
                                <i class="fas fa-save"></i> Simpan sebagai Draft
                            </button>
                            <a href="{{ route('admin.news.index') }}" class="btn btn-lg btn-outline-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Character counter for excerpt
    document.getElementById('excerpt').addEventListener('input', function() {
        document.getElementById('excerpt-count').textContent = this.value.length;
    });

    // Image preview
    document.getElementById('featured_image').addEventListener('change', function(e) {
        const preview = document.getElementById('image-preview');
        const file = e.target.files[0];
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `<img src="${e.target.result}" class="img-thumbnail" style="max-height: 150px;">`;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection