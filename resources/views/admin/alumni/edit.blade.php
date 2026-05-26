@extends('layouts.admin')

@section('title', 'Edit Alumni')
@section('page-title', 'Edit Alumni')

@section('content')
<div class="page-header">
    <h1>Edit Alumni</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.alumni.index') }}">Data Alumni</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-white py-3 fw-semibold">
                <i class="fas fa-user-edit me-2 text-warning"></i>Form Edit Alumni
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                    </div>
                @endif

                <form action="{{ route('admin.alumni.update', $alumni) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                   value="{{ old('nama', $alumni->nama) }}" required>
                            @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">NIM <span class="text-danger">*</span></label>
                            <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror"
                                   value="{{ old('nim', $alumni->nim) }}" required>
                            @error('nim')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email', $alumni->email) }}" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">No. HP</label>
                            <input type="text" name="no_hp" class="form-control"
                                   value="{{ old('no_hp', $alumni->no_hp) }}" placeholder="08xxxxxxxxxx">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Program Studi <span class="text-danger">*</span></label>
                            <input type="text" name="program_studi" class="form-control @error('program_studi') is-invalid @enderror"
                                   value="{{ old('program_studi', $alumni->program_studi) }}" required>
                            @error('program_studi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Angkatan <span class="text-danger">*</span></label>
                            <select name="angkatan" class="form-select @error('angkatan') is-invalid @enderror" required>
                                <option value="">Pilih angkatan</option>
                                @for($y = date('Y'); $y >= 2000; $y--)
                                    <option value="{{ $y }}" {{ old('angkatan', $alumni->angkatan) == $y ? 'selected' : '' }}>{{ $y }}</option>
                                @endfor
                            </select>
                            @error('angkatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tahun Lulus</label>
                            <input type="number" name="tahun_lulus" class="form-control"
                                   value="{{ old('tahun_lulus', $alumni->tahun_lulus) }}"
                                   min="2000" max="{{ date('Y') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">IPK</label>
                            <input type="number" name="ipk" class="form-control"
                                   value="{{ old('ipk', $alumni->ipk) }}"
                                   step="0.01" min="0" max="4" placeholder="3.50">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status Pekerjaan</label>
                            <select name="status_kerja" class="form-select">
                                <option value="">Belum diisi</option>
                                <option value="bekerja" {{ old('status_kerja', $alumni->status_kerja) === 'bekerja' ? 'selected' : '' }}>Bekerja</option>
                                <option value="wirausaha" {{ old('status_kerja', $alumni->status_kerja) === 'wirausaha' ? 'selected' : '' }}>Wirausaha</option>
                                <option value="melanjutkan_studi" {{ old('status_kerja', $alumni->status_kerja) === 'melanjutkan_studi' ? 'selected' : '' }}>Melanjutkan Studi</option>
                                <option value="belum_bekerja" {{ old('status_kerja', $alumni->status_kerja) === 'belum_bekerja' ? 'selected' : '' }}>Belum Bekerja</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Perusahaan / Instansi</label>
                            <input type="text" name="perusahaan" class="form-control"
                                   value="{{ old('perusahaan', $alumni->perusahaan) }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Alamat</label>
                            <textarea name="alamat" class="form-control" rows="2">{{ old('alamat', $alumni->alamat) }}</textarea>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-warning px-4">
                            <i class="fas fa-save me-1"></i> Update
                        </button>
                        <a href="{{ route('admin.alumni.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-white py-3 fw-semibold">
                <i class="fas fa-info-circle me-2 text-info"></i>Info
            </div>
            <div class="card-body text-muted" style="font-size:.85rem;">
                <p><i class="fas fa-asterisk text-danger me-1" style="font-size:.6rem;"></i>Kolom bertanda bintang wajib diisi.</p>
                <p>NIM dan Email harus unik.</p>
                <p>IPK diisi dengan nilai 0.00 – 4.00.</p>
                <p class="mb-0">Dibuat: {{ $alumni->created_at->format('d M Y') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection