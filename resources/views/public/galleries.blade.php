@extends('layouts.public')

@section('title', 'Galeri Foto & Video - Desa Tautpah')

@section('content')
<!-- Header Banner Modern & Aesthetic -->
<section class="py-5 text-white position-relative overflow-hidden" style="background: radial-gradient(circle at 10% 20%, rgba(16, 185, 129, 0.22) 0%, transparent 45%), radial-gradient(circle at 90% 80%, rgba(5, 150, 105, 0.25) 0%, transparent 50%), linear-gradient(135deg, #05231a 0%, #064e3b 60%, #083c2e 100%);">
    <div class="container py-4 position-relative" style="z-index: 1;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-emerald-200 text-decoration-none" style="color: #a7f3d0;">Beranda</a></li>
                <li class="breadcrumb-item text-white-50 active" aria-current="page">Galeri</li>
            </ol>
        </nav>
        <span class="badge-pill-emerald mb-2" style="background: rgba(255, 255, 255, 0.12); color: #6ee7b7; border-color: rgba(255, 255, 255, 0.2);">
            <i class="bi bi-camera"></i> Dokumentasi Visual
        </span>
        <h1 class="fw-bold mb-2 text-white">Galeri Foto & Video Desa Tautpah</h1>
        <p class="lead text-emerald-100 mb-0" style="color: #cbd5e1; font-size: 1.05rem;">Dokumentasi visual rangkaian kegiatan kemasyarakatan, pembangunan, dan adat budaya Biboki Selatan.</p>
    </div>
</section>

<div class="container py-5">
    <!-- Nav Tabs untuk Foto dan Video -->
    <ul class="nav nav-pills justify-content-center mb-5 gap-2" id="galleryTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active px-4 py-2 fw-semibold rounded-pill" id="photos-tab" data-bs-toggle="pill" data-bs-target="#photos-content" type="button" role="tab">
                <i class="bi bi-images me-1"></i> Galeri Foto ({{ $photos->total() }})
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link px-4 py-2 fw-semibold rounded-pill" id="videos-tab" data-bs-toggle="pill" data-bs-target="#videos-content" type="button" role="tab">
                <i class="bi bi-play-circle me-1"></i> Galeri Video ({{ $videos->total() }})
            </button>
        </li>
    </ul>

    <div class="tab-content" id="galleryTabContent">
        <!-- Tab Foto -->
        <div class="tab-pane fade show active" id="photos-content" role="tabpanel">
            <div class="row g-4 mb-4">
                @forelse($photos as $photo)
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card card-custom h-100 shadow-sm">
                            <div style="height: 190px; background-color: #cbd5e1; overflow: hidden; position: relative;">
                                @if($photo->file_path)
                                    <img src="{{ asset('storage/' . $photo->file_path) }}" class="w-100 h-100 object-fit-cover" alt="{{ $photo->title }}">
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-secondary bg-opacity-10 text-muted">
                                        <i class="bi bi-image fs-1"></i>
                                    </div>
                                @endif
                                <span class="badge bg-dark bg-opacity-75 position-absolute bottom-0 end-0 m-2 small">
                                    <i class="bi bi-calendar-event me-1"></i> {{ $photo->created_at->format('d/m/Y') }}
                                </span>
                            </div>
                            <div class="card-body p-3">
                                <h6 class="fw-bold mb-1 fs-6">{{ $photo->title }}</h6>
                                @if($photo->caption)
                                    <p class="text-secondary small mb-0">{{ $photo->caption }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5 text-muted">
                        <i class="bi bi-images fs-1 d-block mb-2"></i> Belum ada foto kegiatan dalam galeri.
                    </div>
                @endforelse
            </div>
            <div class="d-flex justify-content-center">
                {{ $photos->links() }}
            </div>
        </div>

        <!-- Tab Video -->
        <div class="tab-pane fade" id="videos-content" role="tabpanel">
            <div class="row g-4 mb-4">
                @forelse($videos as $video)
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white h-100">
                            <div class="ratio ratio-16x9 bg-dark">
                                @if($video->youtube_embed_url)
                                    <iframe src="{{ $video->youtube_embed_url }}" title="{{ $video->title }}" allowfullscreen></iframe>
                                @else
                                    <div class="d-flex align-items-center justify-content-center text-white p-4 text-center">
                                        <div>
                                            <i class="bi bi-play-btn fs-1 mb-2 d-block"></i>
                                            <a href="{{ $video->video_url }}" target="_blank" class="btn btn-sm btn-outline-light">
                                                Buka Tautan Video <i class="bi bi-box-arrow-up-right ms-1"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="card-body p-4">
                                <h5 class="fw-bold mb-2">{{ $video->title }}</h5>
                                @if($video->caption)
                                    <p class="text-secondary small mb-0">{{ $video->caption }}</p>
                                @endif
                                <div class="mt-3 pt-3 border-top d-flex justify-content-between align-items-center text-muted small">
                                    <span><i class="bi bi-calendar3 me-1"></i> {{ $video->created_at->format('d M Y') }}</span>
                                    <a href="{{ $video->video_url }}" target="_blank" class="text-success text-decoration-none fw-semibold">
                                        Tonton di YouTube <i class="bi bi-arrow-up-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5 text-muted">
                        <i class="bi bi-play-circle fs-1 d-block mb-2"></i> Belum ada video dokumentasi yang ditambahkan.
                    </div>
                @endforelse
            </div>
            <div class="d-flex justify-content-center">
                {{ $videos->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
