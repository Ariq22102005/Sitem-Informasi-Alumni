@extends('layouts.admin')

@section('title', 'Manajemen User')
@section('page-title', 'Manajemen User')

@section('content')
<div class="page-header d-flex align-items-center justify-content-between">
    <div>
        <h1>Manajemen User</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Manajemen User</li>
            </ol>
        </nav>
    </div>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm px-3">
        <i class="fas fa-user-plus me-1"></i> Tambah User
    </a>
</div>

<div class="card">
    <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
        <span class="fw-semibold"><i class="fas fa-users-cog me-2 text-primary"></i>Daftar User</span>
        <form action="{{ route('admin.users.index') }}" method="GET" class="d-flex gap-2">
            <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari nama / email..." value="{{ request('search') }}" style="width:220px;">
            <button class="btn btn-primary btn-sm"><i class="fas fa-search"></i></button>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th width="40">#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Terdaftar</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $i => $u)
                <tr>
                    <td class="text-muted">{{ $users->firstItem() + $i }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div style="width:32px;height:32px;border-radius:50%;background:#4f46e5;color:#fff;display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:600;flex-shrink:0;">
                                {{ strtoupper(substr($u->name, 0, 1)) }}
                            </div>
                            <span style="font-size:.88rem;" class="fw-semibold">{{ $u->name }}</span>
                        </div>
                    </td>
                    <td style="font-size:.85rem;">{{ $u->email }}</td>
                    <td>
                        <span class="badge bg-{{ ($u->role ?? 'user') === 'admin' ? 'danger' : 'secondary' }}">
                            {{ ucfirst($u->role ?? 'user') }}
                        </span>
                    </td>
                    <td style="font-size:.82rem;" class="text-muted">{{ $u->created_at->format('d M Y') }}</td>
                    <td>
                        @if($u->email_verified_at)
                            <span class="badge bg-success"><i class="fas fa-check me-1"></i>Terverifikasi</span>
                        @else
                            <span class="badge bg-warning text-dark">Belum Verifikasi</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.users.edit', $u) }}" class="btn btn-sm btn-outline-warning py-0 px-2" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        @if(auth()->id() !== $u->id)
                        <form action="{{ route('admin.users.destroy', $u) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus user ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger py-0 px-2" title="Hapus"><i class="fas fa-trash"></i></button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-5">
                        <i class="fas fa-users fa-2x mb-2 d-block"></i>
                        Belum ada user terdaftar
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if(isset($users) && $users->hasPages())
    <div class="card-footer bg-white">{{ $users->withQueryString()->links() }}</div>
    @endif
</div>
@endsection