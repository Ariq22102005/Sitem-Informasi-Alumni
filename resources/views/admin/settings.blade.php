@extends('layouts.admin')

@section('title', 'Pengaturan')
@section('page-title', 'Pengaturan')

@section('content')
<div class="page-header">
    <h1>Pengaturan</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Pengaturan</li>
        </ol>
    </nav>
</div>

<div class="row g-3">
    {{-- PROFIL SAYA --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-white py-3 fw-semibold">
                <i class="fas fa-user-circle me-2 text-primary"></i>Profil Saya
            </div>
            <div class="card-body">
                <form action="{{ route('admin.settings.profile') }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', auth()->user()->name) }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', auth()->user()->email) }}" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm px-4">
                        <i class="fas fa-save me-1"></i> Simpan Profil
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- GANTI PASSWORD --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-white py-3 fw-semibold">
                <i class="fas fa-lock me-2 text-warning"></i>Ganti Password
            </div>
            <div class="card-body">
                <form action="{{ route('admin.settings.password') }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password Lama</label>
                        <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" required>
                        @error('current_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password Baru</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-warning btn-sm px-4">
                        <i class="fas fa-key me-1"></i> Ganti Password
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- PENGATURAN WEBSITE --}}
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-white py-3 fw-semibold">
                <i class="fas fa-globe me-2 text-info"></i>Pengaturan Website
            </div>
            <div class="card-body">
                <form action="{{ route('admin.settings.website') }}" method="POST">
                    @csrf @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Website</label>
                            <input type="text" name="site_name" class="form-control"
                                   value="{{ old('site_name', config('app.name')) }}" placeholder="Sistem Informasi Alumni">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Institusi</label>
                            <input type="text" name="institution_name" class="form-control"
                                   value="{{ old('institution_name') }}" placeholder="Nama universitas / sekolah">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email Kontak</label>
                            <input type="email" name="contact_email" class="form-control"
                                   value="{{ old('contact_email') }}" placeholder="info@kampus.ac.id">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">No. Telepon</label>
                            <input type="text" name="contact_phone" class="form-control"
                                   value="{{ old('contact_phone') }}" placeholder="(0123) 456789">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Alamat Institusi</label>
                            <textarea name="address" class="form-control" rows="2" placeholder="Jl. ...">{{ old('address') }}</textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-info btn-sm px-4 text-white">
                                <i class="fas fa-save me-1"></i> Simpan Pengaturan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection