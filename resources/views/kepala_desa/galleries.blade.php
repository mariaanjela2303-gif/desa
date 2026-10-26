@extends('layouts.kepala_desa')

@section('title', 'Pemantauan Galeri - Kepala Desa Tautpah')
@section('page_title', 'Pemantauan Galeri Foto & Video')

@section('content')
<div class="card border-0 shadow-sm rounded-3 bg-white">
    <div class="card-header bg-white border-bottom py-3 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <h6 class="fw-bold mb-0">Galeri yang Ditampilkan di Website</h6>
            <small class="text-muted">Memantau dokumentasi foto kegiatan dan tautan video resmi desa</small>
        </div>
        <form action="{{ route('kepaladesa.galleries') }}" method="GET" class="d-flex gap-2">
            <select name="type" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="">Semua Galeri</option>
                <option value="foto" {{ request('type') == 'foto' ? 'selected' : '' }}>Foto</option>
                <option value="video" {{ request('type') == 'video' ? 'selected' : '' }}>Video</option>
            </select>
        </form>
    </div>

    <div class="card-body p-4">
        <div class="row g-4">
            @forelse($galleries as $item)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 border rounded-3 overflow-hidden shadow-sm">
                        <div style="height: 160px; background-color: #f1f5f9; position: relative;">
                            @if($item->type === 'foto')
                                @if($item->file_path)
                                    <img src="{{ asset('storage/' . $item->file_path) }}" class="w-100 h-100 object-fit-cover" alt="{{ $item->title }}">
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                                        <i class="bi bi-image fs-1"></i>
                                    </div>
                                @endif
                                <span class="badge bg-success position-absolute top-0 start-0 m-2">Foto</span>
                            @else
                                <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-dark text-white">
                                    <i class="bi bi-play-circle fs-1 text-danger"></i>
                                </div>
                                <span class="badge bg-danger position-absolute top-0 start-0 m-2">Video</span>
                            @endif
                        </div>
                        <div class="card-body p-3 d-flex flex-column">
                            <h6 class="fw-bold small mb-1">{{ $item->title }}</h6>
                            <p class="text-secondary small mb-3 flex-grow-1" style="font-size: 0.8rem;">
                                {{ $item->caption ?? 'Tanpa keterangan' }}
                            </p>
                            @if($item->type === 'video' && $item->video_url)
                                <a href="{{ $item->video_url }}" target="_blank" class="small text-danger text-decoration-none fw-semibold">
                                    <i class="bi bi-youtube me-1"></i> Buka Tautan Video
                                </a>
                            @endif
                            <div class="mt-2 pt-2 border-top text-muted" style="font-size: 0.72rem;">
                                <i class="bi bi-calendar3 me-1"></i> {{ $item->created_at->format('d/m/Y') }}
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5 text-muted">
                    <i class="bi bi-images fs-1 d-block mb-2"></i> Belum ada galeri yang diunggah.
                </div>
            @endforelse
        </div>
    </div>

    @if($galleries->hasPages())
        <div class="card-footer bg-white py-3">
            {{ $galleries->links() }}
        </div>
    @endif
</div>
@endsection
