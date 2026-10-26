@extends('layouts.public')

@section('title', $article->title . ' - Desa Tautpah')

@section('content')
<!-- Header Banner -->
<section class="py-5 text-white" style="background: linear-gradient(135deg, #14532d, #15803d);">
    <div class="container py-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white text-decoration-none">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('public.articles') }}" class="text-white text-decoration-none">Berita & Pengumuman</a></li>
                <li class="breadcrumb-item text-white-50 active text-truncate" style="max-width: 250px;" aria-current="page">{{ $article->title }}</li>
            </ol>
        </nav>
        <span class="badge {{ $article->type === 'pengumuman' ? 'bg-warning text-dark' : 'bg-success bg-opacity-75 text-white' }} px-3 py-1 rounded-pill mb-2">
            {{ ucfirst($article->type) }}
        </span>
        <h1 class="fw-bold mb-3">{{ $article->title }}</h1>
        <div class="d-flex flex-wrap align-items-center gap-3 text-white-50 small">
            <span><i class="bi bi-person-fill text-white me-1"></i> {{ $article->user?->name ?? 'Admin Desa' }}</span>
            <span>&bull;</span>
            <span><i class="bi bi-calendar3 text-white me-1"></i> {{ $article->published_at ? $article->published_at->translatedFormat('d F Y') : $article->created_at->translatedFormat('d F Y') }}</span>
            <span>&bull;</span>
            <span><i class="bi bi-tag-fill text-white me-1"></i> {{ $article->category?->name ?? 'Umum' }}</span>
            <span>&bull;</span>
            <span><i class="bi bi-eye-fill text-white me-1"></i> {{ $article->views_count }} kali dilihat</span>
        </div>
    </div>
</section>

<div class="container py-5">
    <div class="row g-5">
        <div class="col-lg-8">
            <article class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                <!-- Featured Image -->
                @if($article->image)
                    <div class="rounded-4 overflow-hidden mb-4 shadow-sm" style="max-height: 480px;">
                        <img src="{{ asset('storage/' . $article->image) }}" class="w-100 h-100 object-fit-cover" alt="{{ $article->title }}">
                    </div>
                @endif

                <!-- Excerpt / Ringkasan jika ada -->
                @if($article->summary)
                    <div class="p-3 bg-light rounded-3 border-start border-4 border-success mb-4 fs-6 text-muted fw-semibold">
                        {{ $article->summary }}
                    </div>
                @endif

                <!-- Isi Konten Artikel -->
                <div class="article-content lh-lg text-secondary fs-6">
                    {!! $article->content !!}
                </div>

                <hr class="my-5">

                <!-- Tombol Bagikan & Kembali -->
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <a href="{{ route('public.articles') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Berita
                    </a>
                    <div class="d-flex align-items-center gap-2 small text-muted">
                        <i class="bi bi-shield-check text-success"></i> Informasi Resmi Pemerintah Desa Tautpah
                    </div>
                </div>
            </article>
        </div>

        <div class="col-lg-4">
            <!-- Informasi Terkait / Sidebar -->
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
                <h5 class="fw-bold mb-3 border-bottom pb-2">Informasi Terkait</h5>
                <div class="d-flex flex-column gap-3">
                    @forelse($relatedArticles as $rel)
                        <div class="d-flex gap-3 align-items-start">
                            <div class="flex-shrink-0" style="width: 70px; height: 60px; background-color: #e2e8f0; border-radius: 8px; overflow: hidden;">
                                @if($rel->image)
                                    <img src="{{ asset('storage/' . $rel->image) }}" class="w-100 h-100 object-fit-cover" alt="{{ $rel->title }}">
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success">
                                        <i class="bi bi-newspaper"></i>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <h6 class="fw-bold small mb-1">
                                    <a href="{{ route('public.articles.detail', $rel->slug) }}" class="text-dark text-decoration-none">
                                        {{ Str::limit($rel->title, 55) }}
                                    </a>
                                </h6>
                                <small class="text-muted" style="font-size: 0.75rem;">
                                    <i class="bi bi-clock me-1"></i> {{ $rel->published_at ? $rel->published_at->format('d M Y') : $rel->created_at->format('d M Y') }}
                                </small>
                            </div>
                        </div>
                    @empty
                        <p class="small text-muted mb-0">Belum ada berita terkait lainnya.</p>
                    @endforelse
                </div>
            </div>

            <!-- Kontak Kantor Cepat -->
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-success bg-opacity-10 border border-success border-opacity-25">
                <h6 class="fw-bold text-success mb-2"><i class="bi bi-info-circle-fill me-1"></i> Butuh Informasi Pelayanan?</h6>
                <p class="small text-secondary mb-3">
                    Hubungi kantor pelayanan Desa Tautpah untuk keperluan administrasi dan konfirmasi informasi.
                </p>
                <a href="{{ route('public.contact') }}" class="btn btn-desa-primary btn-sm">
                    <i class="bi bi-telephone me-1"></i> Kontak Desa
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
