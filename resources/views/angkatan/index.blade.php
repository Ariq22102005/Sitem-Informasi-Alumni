@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Data Angkatan</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @auth
        @if(Auth::user()->role === 'admin')
            <a href="{{ route('angkatan.create') }}" class="btn btn-primary mb-3">+ Tambah Angkatan</a>
        @endif
    @endauth

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Tahun</th>
                <th>Nama Angkatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($angkatans as $index => $angkatan)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $angkatan->tahun }}</td>
                <td>{{ $angkatan->nama_angkatan ?? '-' }}</td>
                <td>
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('angkatan.edit', $angkatan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('angkatan.destroy', $angkatan->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        @endif
                    @endauth
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection