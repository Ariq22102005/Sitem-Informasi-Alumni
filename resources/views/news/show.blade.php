@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if($news->featured_image)
                <img src="{{ asset('storage/' . $news->featured_image) }}" alt="{{ $news->title }}" class="img-fluid mb-4" style="max-height: 500px; width: 100%; object-fit: cover;">
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <span class="badge bg-primary">{{ $news->category }}</span>
                    </div>

                    <h1 class="card-title mb-3">{{ $news->title }}</h1>

                    <div class="text-muted small mb-4">
                        <p class="mb-1"><strong>Oleh:</strong> {{ $news->author }}</p>
                        <p class="mb-1"><strong>Tanggal:</strong> {{ $news->published_at->format('d F Y H:i') }}</p>
                        <p><strong>Views:</strong> {{ $news->views }}</p>
                    </div>

                    <hr>

                    <div class="card-text mb-4">
                        {!! nl2br(e($news->content)) !!}
                    </div>

                    <hr>

                    @auth
                        @if(Auth::user()->role === 'admin')
                            <div class="d-flex gap-2 mb-4">
                                <a href="{{ route('news.edit', $news) }}" class="btn btn-warning">
                                    <i class="fas fa-edit me-1"></i> Edit
                                </a>
                                <form action="{{ route('news.destroy', $news) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash me-1"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endauth

                    @if($relatedNews->count())
                        <div class="mt-5">
                            <h4>Berita Terkait</h4>
                            <div class="row">
                                @foreach($relatedNews as $related)
                                    <div class="col-md-6 mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h6 class="card-title">{{ $related->title }}</h6>
                                                <p class="card-text small">{{ Str::limit($related->excerpt ?? $related->content, 80) }}</p>
                                                <a href="{{ route('news.show', $related) }}" class="btn btn-sm btn-primary">Baca</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('news.index') }}" class="btn btn-outline-secondary">← Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection