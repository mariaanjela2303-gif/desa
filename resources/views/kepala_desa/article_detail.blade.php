@extends('layouts.kepala_desa')

@section('title', 'Tinjau Konten: ' . $article->title)
@section('page_title', 'Tinjau Konten Publikasi')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                <a href="{{ route('kepaladesa.articles') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
                </a>
                <span class="badge bg-light text-primary border px-3 py-2">
                    <i class="bi bi-eye-fill me-1"></i> Mode Pemantauan Kepala Desa
                </span>
            </div>

            <div class="d-flex align-items-center gap-2 mb-2">
                <span class="badge {{ $article->type === 'pengumuman' ? 'bg-warning text-dark' : 'bg-success' }}">
                    {{ ucfirst($article->type) }}
                </span>
                <span class="badge bg-light text-muted border">
                    {{ $article->category?->name ?? 'Umum' }}
                </span>
                <span class="badge bg-light text-dark border">
                    <i class="bi bi-eye me-1"></i> {{ $article->views_count }} total pembaca
                </span>
            </div>

            <h3 class="fw-bold mb-3">{{ $article->title }}</h3>

            <div class="d-flex gap-3 text-muted small mb-4 pb-3 border-bottom">
                <span><i class="bi bi-person me-1"></i> Ditulis oleh: <strong>{{ $article->user?->name ?? 'Admin Desa' }}</strong></span>
                <span>&bull;</span>
                <span><i class="bi bi-calendar3 me-1"></i> Tanggal: {{ $article->published_at ? $article->published_at->format('d F Y, H:i') : '-' }} WITA</span>
            </div>

            @if($article->image)
                <div class="rounded-4 overflow-hidden mb-4" style="max-height: 420px;">
                    <img src="{{ asset('storage/' . $article->image) }}" class="w-100 h-100 object-fit-cover" alt="{{ $article->title }}">
                </div>
            @endif

            @if($article->summary)
                <div class="p-3 bg-light rounded-3 border-start border-4 border-primary mb-4 text-muted">
                    <strong>Ringkasan:</strong> {{ $article->summary }}
                </div>
            @endif

            <div class="lh-lg text-secondary mb-4">
                {!! $article->content !!}
            </div>

            <div class="p-3 rounded-3 bg-light border text-center small text-muted">
                <i class="bi bi-shield-check text-success me-1"></i> Halaman ini adalah pratinjau konten. Kepala desa tidak memiliki kewenangan mengubah isi konten sesuai PRD versi 1.0.
            </div>
        </div>
    </div>
</div>
@endsection
