@extends('layouts.public')

@section('title', 'Berita & Pengumuman - Desa Tautpah')

@section('content')
<!-- Header Banner -->
<section class="py-5 text-white" style="background: linear-gradient(135deg, #14532d, #15803d);">
    <div class="container py-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white text-decoration-none">Beranda</a></li>
                <li class="breadcrumb-item text-white-50 active" aria-current="page">Berita & Pengumuman</li>
            </ol>
        </nav>
        <h1 class="fw-bold mb-2">Pusat Berita & Informasi Desa</h1>
        <p class="lead text-white-50 mb-0">Kumpulan berita resmi, kegiatan kemasyarakatan, dan pengumuman untuk seluruh warga.</p>
    </div>
</section>

<div class="container py-5">
    <!-- Filter & Pencarian Bar -->
    <div class="card border-0 shadow-sm rounded-4 p-4 mb-5 bg-white">
        <form action="{{ route('public.articles') }}" method="GET">
            <div class="row g-3 align-items-center">
                <!-- Search Box -->
                <div class="col-md-5">
                    <label class="small text-muted fw-semibold mb-1">Cari Kata Kunci</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-search"></i></span>
                        <input type="text" name="search" value="{{ $searchTerm }}" class="form-control bg-light border-start-0" placeholder="Ketik judul atau isi informasi...">
                    </div>
                </div>

                <!-- Tipe (Berita / Pengumuman) -->
                <div class="col-md-3">
                    <label class="small text-muted fw-semibold mb-1">Jenis Informasi</label>
                    <select name="type" class="form-select bg-light">
                        <option value="">Semua Jenis</option>
                        <option value="berita" {{ $currentType == 'berita' ? 'selected' : '' }}>Berita Desa</option>
                        <option value="pengumuman" {{ $currentType == 'pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                    </select>
                </div>

                <!-- Kategori -->
                <div class="col-md-3">
                    <label class="small text-muted fw-semibold mb-1">Kategori</label>
                    <select name="category" class="form-select bg-light">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->slug }}" {{ $currentCategory == $cat->slug ? 'selected' : '' }}>
                                {{ $cat->name }} ({{ $cat->articles_count }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tombol Filter & Reset -->
                <div class="col-md-1 d-flex gap-2 align-self-end">
                    <button type="submit" class="btn btn-desa-primary w-100" title="Cari Data">
                        <i class="bi bi-search"></i>
                    </button>
                    @if($searchTerm || $currentType || $currentCategory)
                        <a href="{{ route('public.articles') }}" class="btn btn-light border text-danger" title="Reset Filter">
                            <i class="bi bi-x-circle"></i>
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <!-- Hasil Daftar Berita & Pengumuman -->
    @if($articles->count() > 0)
        <div class="row g-4 mb-5">
            @foreach($articles as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="card card-custom h-100">
                        <div class="position-relative" style="height: 200px; background-color: #e2e8f0; overflow: hidden;">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" class="w-100 h-100 object-fit-cover" alt="{{ $item->title }}">
                            @else
                                <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success">
                                    <i class="bi bi-{{ $item->type === 'pengumuman' ? 'megaphone' : 'newspaper' }} fs-1"></i>
                                </div>
                            @endif
                            <div class="position-absolute top-0 start-0 m-3 d-flex gap-2">
                                <span class="badge {{ $item->type === 'pengumuman' ? 'bg-warning text-dark' : 'bg-success' }} shadow-sm">
                                    {{ ucfirst($item->type) }}
                                </span>
                                @if($item->category)
                                    <span class="badge bg-dark bg-opacity-75 shadow-sm">
                                        {{ $item->category->name }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="card-body d-flex flex-column p-4">
                            <div class="d-flex align-items-center gap-2 text-muted small mb-2">
                                <span><i class="bi bi-calendar3 me-1"></i> {{ $item->published_at ? $item->published_at->format('d M Y') : $item->created_at->format('d M Y') }}</span>
                                <span>&bull;</span>
                                <span><i class="bi bi-eye me-1"></i> {{ $item->views_count }} tayang</span>
                            </div>
                            <h5 class="card-title fw-bold mb-2">
                                <a href="{{ route('public.articles.detail', $item->slug) }}" class="text-dark text-decoration-none">
                                    {{ Str::limit($item->title, 70) }}
                                </a>
                            </h5>
                            <p class="card-text text-secondary small mb-4 flex-grow-1">
                                {{ Str::limit(strip_tags($item->summary ?? $item->content), 120) }}
                            </p>
                            <div>
                                <a href="{{ route('public.articles.detail', $item->slug) }}" class="btn btn-sm btn-desa-outline w-100">
                                    Baca Lengkap <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $articles->links() }}
        </div>
    @else
        <div class="card border-0 shadow-sm rounded-4 p-5 text-center bg-white">
            <i class="bi bi-search text-muted fs-1 mb-3"></i>
            <h4 class="fw-bold">Tidak ada informasi yang ditemukan</h4>
            <p class="text-muted mb-4">Coba ubah kata kunci pencarian atau bersihkan filter yang dipilih.</p>
            <div>
                <a href="{{ route('public.articles') }}" class="btn btn-desa-primary">
                    <i class="bi bi-arrow-clockwise me-1"></i> Tampilkan Semua Informasi
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
