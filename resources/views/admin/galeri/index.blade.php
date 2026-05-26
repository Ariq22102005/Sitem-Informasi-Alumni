@extends('layouts.admin')

@section('title', 'Galeri')
@section('page-title', 'Galeri')

@section('content')
<div class="page-header d-flex align-items-center justify-content-between mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Galeri</li>
        </ol>
    </nav>
    <a href="{{ route('admin.galeri.create') }}" class="btn btn-primary btn-sm px-3">
        <i class="fas fa-plus me-1"></i> Upload Foto
    </a>
</div>

<div class="row g-3">
    @forelse($galeris as $g)
    <div class="col-md-3">
        <div class="card h-100">
            <img src="{{ Storage::url($g->file_path) }}" class="card-img-top"
                 style="height:180px; object-fit:cover;"
                 alt="{{ $g->judul }}">
            <div class="card-body p-2">
                <div class="fw-semibold" style="font-size:.85rem;">{{ $g->judul }}</div>
                @if($g->kategori)
                    <span class="badge bg-secondary" style="font-size:.7rem;">{{ $g->kategori }}</span>
                @endif
                @if($g->keterangan)
                    <div class="text-muted mt-1" style="font-size:.75rem;">{{ Str::limit($g->keterangan, 60) }}</div>
                @endif
            </div>
            <div class="card-footer bg-white p-2 d-flex gap-1">
                <a href="{{ route('admin.galeri.edit', $g) }}" class="btn btn-sm btn-outline-warning flex-fill py-0">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('admin.galeri.destroy', $g) }}" method="POST"
                      class="flex-fill" onsubmit="return confirm('Hapus foto ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger w-100 py-0"><i class="fas fa-trash"></i></button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card">
            <div class="card-body text-center text-muted py-5">
                <i class="fas fa-images fa-3x mb-3 d-block"></i>
                Belum ada foto di galeri
            </div>
        </div>
    </div>
    @endforelse
</div>

@if($galeris->hasPages())
    <div class="mt-3">{{ $galeris->links() }}</div>
@endif
@endsection