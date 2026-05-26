@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Berita Alumni</h1>
        </div>
        <div class="col-md-4 text-end">
            @auth
                <a href="{{ route('news.create') }}" class="btn btn-primary">
                    + Buat Berita
                </a>
            @endauth
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        @forelse($news as $item)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($item->featured_image)
                        <img src="{{ asset('storage/' . $item->featured_image) }}" class="card-img-top" alt="{{ $item->title }}">
                    @endif
                    <div class="card-body">
                        <span class="badge bg-primary">{{ $item->category }}</span>
                        <h5 class="card-title mt-2">{{ $item->title }}</h5>
                        <p class="card-text text-muted small">{{ Str::limit($item->excerpt ?? $item->content, 100) }}</p>
                        <small class="text-muted d-block mb-2">{{ $item->published_at->format('d/m/Y') }} oleh {{ $item->author }}</small>
                        <a href="{{ route('news.show', $item) }}" class="btn btn-sm btn-primary">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center text-muted">Belum ada berita yang dipublikasikan</p>
            </div>
        @endforelse
    </div>

    <div class="row mt-4">
        <div class="col-12">
            {{ $news->links() }}
        </div>
    </div>
</div>
@endsection