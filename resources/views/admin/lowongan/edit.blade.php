@extends('layouts.admin')

@section('title', 'Edit Lowongan')

@section('content')
<div class="page-header mb-4">
    <h1>Edit Lowongan Kerja</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.lowongan.index') }}">Lowongan</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.lowongan.update', $lowongan) }}" method="POST">
            @csrf @method('PUT')
            @include('admin.lowongan._form', ['lowongan' => $lowongan])
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Perbarui</button>
                <a href="{{ route('admin.lowongan.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
