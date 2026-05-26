@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <!-- Back Button -->
            <a href="{{ route('news.index') }}" class="btn btn-outline-secondary mb-4">
                <i class="fas fa-arrow-left"></i> Kembali ke Berita
            </a>

            <!-- Featured Image -->
            @if($news->featured_image)
                <img src="{{ asset('storage/' . $news->featured_image) }}" 
                     alt="{{ $news->title }}" class="img-fluid rounded-lg shadow-sm mb-4" style="width: 100%; height: 400px; object-fit: cover;">
            @else
                <div class="bg-light rounded-lg d-flex align-items-center justify-content-center mb-4" style="width: 100%; height: 400px;">
                    <i class="fas fa-image fa-5x text-muted"></i>
                </div>
            @endif

            <!-- Article Card -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-5">
                    <!-- Header -->
                    <div class="mb-4">
                        <span class="badge bg-primary mb-2">
                            {{ $news->category }}
                        </span>
                        <h1 class="display-5 fw-bold text-dark mb-3">{{ $news->title }}</h1>
                        
                        <!-- Meta Information -->
                        <div class="row text-muted small border-bottom pb-3 mb-4">
                            <div class="col-md-3">
                                <i class="fas fa-user-circle"></i> {{ $news->author }}
                            </div>
                            <div class="col-md-3">
                                <i class="fas fa-calendar-alt"></i> {{ $news->published_at->format('d F Y') }}
                            </div>
                            <div class="col-md-3">
                                <i class="fas fa-clock"></i> {{ $news->published_at->format('H:i') }}
                            </div>
                            <div class="col-md-3">
                                <i class="fas fa-eye"></i> {{ $news->views }} views
                            </div>
                        </div>
                    </div>

                    <!-- Excerpt -->
                    @if($news->excerpt)
                        <div class="alert alert-light border-left border-primary border-3 mb-4">
                            <p class="lead mb-0">{{ $news->excerpt }}</p>
                        </div>
                    @endif

                    <!-- Content -->
                    <div class="article-content text-justify" style="line-height: 1.8; font-size: 1.05rem;">
                        {!! nl2br(e($news->content)) !!}
                    </div>

                    <!-- Footer Actions -->
                    <div class="border-top mt-5 pt-4">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="d-flex gap-2">
                                    @auth
                                        <a href="{{ route('news.edit', $news) }}" class="btn btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('news.destroy', $news) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    @endauth
                                </div>
                            </div>
                            <div class="col-md-6 text-end">
                                <small class="text-muted">
                                    Terakhir diperbarui: {{ $news->updated_at->format('d F Y H:i') }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related News -->
            @if($relatedNews->count())
                <div class="mt-5">
                    <h3 class="fw-bold mb-4">
                        <i class="fas fa-link"></i> Berita Terkait
                    </h3>
                    <div class="row">
                        @foreach($relatedNews as $related)
                            <div class="col-md-6 mb-3">
                                <div class="card h-100 shadow-sm border-0">
                                    @if($related->featured_image)
                                        <img src="{{ asset('storage/' . $related->featured_image) }}" 
                                             class="card-img-top" alt="{{ $related->title }}" style="height: 150px; object-fit: cover;">
                                    @endif
                                    <div class="card-body">
                                        <h6 class="card-title fw-bold">{{ Str::limit($related->title, 40) }}</h6>
                                        <p class="card-text text-muted small">
                                            {{ Str::limit($related->excerpt ?? $related->content, 60) }}
                                        </p>
                                        <a href="{{ route('news.show', $related) }}" class="btn btn-sm btn-primary">
                                            Baca <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .article-content {
        color: #333;
    }

    .article-content p {
        margin-bottom: 1.5rem;
    }

    .border-left {
        border-left: 4px solid;
    }
</style>
@endsection