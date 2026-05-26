@extends('layouts.admin')

@section('title', 'Edit User')
@section('page-title', 'Edit User')
@section('page-subtitle', 'Perbarui data user')

@section('content')
<div class="page-header d-flex align-items-center justify-content-between mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Manajemen User</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
</div>

<div class="card" style="max-width: 680px;">
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-semibold">Nama <span class="text-danger">*</span></label>
                <input
                    type="text"
                    name="name"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $user->name) }}"
                    required
                >
                @error('name')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                <input
                    type="email"
                    name="email"
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email', $user->email) }}"
                    required
                >
                @error('email')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Role</label>
                <select
                    name="role"
                    class="form-select @error('role') is-invalid @enderror"
                >
                    <option value="user" {{ old('role', $user->role ?? 'user') === 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ old('role', $user->role ?? 'user') === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('role')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Password <span class="text-muted">(opsional)</span></label>
                <input
                    type="password"
                    name="password"
                    class="form-control @error('password') is-invalid @enderror"
                >
                <div class="form-text">Isi jika ingin mengubah password.</div>
                @error('password')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Konfirmasi Password</label>
                <input
                    type="password"
                    name="password_confirmation"
                    class="form-control @error('password_confirmation') is-invalid @enderror"
                >
                @error('password_confirmation')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning px-4">
                    <i class="fas fa-save me-1"></i> Update
                </button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

