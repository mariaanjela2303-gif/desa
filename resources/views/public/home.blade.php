@extends('layouts.public')

@section('title', 'Beranda - Website Resmi Desa Tautpah')

@section('content')
<!-- Hero Section Modern & Aesthetic -->
<section class="position-relative py-5 text-white overflow-hidden" style="background: radial-gradient(circle at 15% 20%, rgba(16, 185, 129, 0.22) 0%, transparent 45%), radial-gradient(circle at 85% 75%, rgba(5, 150, 105, 0.28) 0%, transparent 50%), linear-gradient(135deg, #05231a 0%, #064e3b 55%, #083c2e 100%);">
    <!-- Subtle glow orb decoration -->
    <div class="position-absolute rounded-circle" style="width: 500px; height: 500px; background: radial-gradient(circle, rgba(16, 185, 129, 0.15) 0%, transparent 70%); top: -150px; right: -100px; pointer-events: none;"></div>

    <div class="container py-4 py-lg-5 position-relative" style="z-index: 1;">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-2 rounded-pill mb-3" style="background: rgba(255, 255, 255, 0.08); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.18);">
                    <span class="rounded-circle bg-success p-1" style="width: 8px; height: 8px;"></span>
                    <span class="small fw-semibold text-emerald-200" style="color: #a7f3d0; font-size: 0.8rem; letter-spacing: 0.5px;">Portal Informasi Resmi Pemerintahan Desa</span>
                </div>

                <h1 class="display-4 fw-extrabold mb-3 text-white" style="letter-spacing: -0.03em; line-height: 1.15;">
                    Keterbukaan Informasi & Kemajuan <span style="background: linear-gradient(135deg, #6ee7b7, #34d399); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Desa Tautpah</span>
                </h1>

                <p class="lead mb-4 text-emerald-100" style="color: #cbd5e1; font-weight: 400; line-height: 1.7; font-size: 1.1rem;">
                    Kecamatan Biboki Selatan, Kabupaten Timor Tengah Utara, Provinsi Nusa Tenggara Timur. Menghubungkan masyarakat dengan layanan, transparansi pembangunan, dan kearifan budaya desa.
                </p>

                <div class="d-flex flex-wrap gap-3 pt-2">
                    <a href="{{ route('public.articles') }}" class="btn btn-light fw-bold px-4 py-3 rounded-pill shadow-lg d-inline-flex align-items-center gap-2" style="color: #064e3b;">
                        <i class="bi bi-newspaper"></i> Baca Warta Terkini
                    </a>
                    <a href="{{ route('public.profile') }}" class="btn px-4 py-3 rounded-pill fw-semibold text-white d-inline-flex align-items-center gap-2" style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.25); backdrop-filter: blur(10px);">
                        <i class="bi bi-compass"></i> Profil & Visi Misi
                    </a>
                </div>
            </div>

            <!-- Sambutan Kepala Desa Floating Card -->
            <div class="col-lg-5">
                <div class="p-4 p-md-5 rounded-4 shadow-2xl position-relative" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.6); box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35);">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center text-white" style="background: linear-gradient(135deg, #059669, #064e3b); width: 52px; height: 52px; box-shadow: 0 8px 16px -2px rgba(5, 150, 105, 0.35);">
                            <i class="bi bi-quote fs-3"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold text-dark">{{ $profile->leader_name ?? 'Kepala Desa Tautpah' }}</h6>
                            <small class="text-success fw-semibold" style="font-size: 0.8rem;">Kepala Desa Tautpah</small>
                        </div>
                    </div>

                    <blockquote class="text-secondary mb-4 fst-italic lh-base" style="font-size: 0.95rem;">
                        "{{ Str::limit($profile->welcome_message ?? 'Selamat datang di portal informasi resmi Desa Tautpah. Kami berkomitmen untuk terus meningkatkan pelayanan masyarakat dan transparansi pembangunan berbasis gotong royong.', 170) }}"
                    </blockquote>

                    <div class="d-flex align-items-center justify-content-between pt-3 border-top border-secondary border-opacity-10">
                        <a href="{{ route('public.profile') }}" class="text-success fw-bold text-decoration-none small d-inline-flex align-items-center gap-1">
                            Selengkapnya tentang Desa <i class="bi bi-arrow-right"></i>
                        </a>
                        <span class="badge rounded-pill px-3 py-1" style="background: #ecfdf5; color: #047857; font-weight: 600; font-size: 0.75rem;">
                            Resmi
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Statistik Cepat / Counter Section -->
<section class="py-4 position-relative" style="background: #ffffff; border-bottom: 1px solid rgba(6, 78, 59, 0.08); box-shadow: 0 4px 20px -2px rgba(6, 46, 34, 0.03);">
    <div class="container">
        <div class="row g-3 text-center">
            <div class="col-6 col-md-3">
                <div class="p-3">
                    <h2 class="fw-extrabold mb-1" style="color: #059669; font-weight: 800;">{{ $totalNews }}</h2>
                    <span class="text-muted small fw-semibold"><i class="bi bi-newspaper me-1 text-success"></i> Berita Terbit</span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-3">
                    <h2 class="fw-extrabold mb-1" style="color: #d97706; font-weight: 800;">{{ $totalAnnouncements }}</h2>
                    <span class="text-muted small fw-semibold"><i class="bi bi-megaphone me-1 text-warning"></i> Pengumuman Warga</span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-3">
                    <h2 class="fw-extrabold mb-1" style="color: #0284c7; font-weight: 800;">{{ $totalGalleries }}</h2>
                    <span class="text-muted small fw-semibold"><i class="bi bi-images me-1 text-info"></i> Galeri Dokumentasi</span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-3">
                    <h2 class="fw-extrabold mb-1" style="color: #064e3b; font-weight: 800;">{{ $totalOfficials }}</h2>
                    <span class="text-muted small fw-semibold"><i class="bi bi-people me-1 text-success"></i> Aparatur Desa</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Berita Terbaru & Pengumuman -->
<section class="py-5 my-md-3">
    <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 pb-2">
            <div>
                <span class="badge-pill-emerald mb-2">
                    <i class="bi bi-stars"></i> Kabar Terkini
                </span>
                <h2 class="fw-bold mb-0">Warta & Informasi Desa</h2>
            </div>
            <a href="{{ route('public.articles') }}" class="btn-desa-outline mt-3 mt-md-0 text-decoration-none d-inline-flex align-items-center">
                Lihat Semua Berita <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>

        <div class="row g-4 mb-5">
            @forelse($latestNews as $item)
                <div class="col-md-4">
                    <div class="card card-custom h-100">
                        <div class="position-relative overflow-hidden" style="height: 210px; background: #e2e8f0;">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" class="w-100 h-100 object-fit-cover" style="transition: transform 0.4s ease;" alt="{{ $item->title }}" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                            @else
                                <div class="w-100 h-100 d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #ecfdf5, #d1fae5); color: #059669;">
                                    <i class="bi bi-newspaper fs-1"></i>
                                </div>
                            @endif
                            <span class="position-absolute top-0 start-0 m-3 badge rounded-pill px-3 py-2 shadow-sm" style="background: rgba(6, 78, 59, 0.85); backdrop-filter: blur(8px); color: #ffffff; font-weight: 600; font-size: 0.75rem;">
                                {{ $item->category?->name ?? 'Berita Desa' }}
                            </span>
                        </div>
                        <div class="card-body d-flex flex-column p-4">
                            <div class="d-flex align-items-center gap-2 text-muted small mb-2" style="font-size: 0.8rem;">
                                <span><i class="bi bi-calendar3 me-1"></i> {{ $item->published_at ? $item->published_at->format('d M Y') : $item->created_at->format('d M Y') }}</span>
                                <span>&bull;</span>
                                <span><i class="bi bi-eye me-1"></i> {{ $item->views_count }} tayang</span>
                            </div>
                            <h5 class="card-title fw-bold mb-2">
                                <a href="{{ route('public.articles.detail', $item->slug) }}" class="text-dark text-decoration-none">
                                    {{ Str::limit($item->title, 65) }}
                                </a>
                            </h5>
                            <p class="card-text text-secondary small mb-4 flex-grow-1 lh-base">
                                {{ Str::limit(strip_tags($item->summary ?? $item->content), 110) }}
                            </p>
                            <div class="pt-2">
                                <a href="{{ route('public.articles.detail', $item->slug) }}" class="text-success text-decoration-none fw-bold small d-inline-flex align-items-center gap-1">
                                    Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="p-5 bg-white rounded-4 border text-center text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i> Belum ada berita yang dipublikasikan saat ini.
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Bagian Pengumuman Warga -->
        @if($latestAnnouncements->count() > 0)
            <div class="rounded-4 p-4 p-lg-5 mb-5 position-relative overflow-hidden" style="background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 100%); border: 1px solid rgba(5, 150, 105, 0.2);">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="p-3 rounded-3 text-white shadow-sm" style="background: linear-gradient(135deg, #d97706, #b45309);">
                            <i class="bi bi-megaphone-fill fs-4"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-0" style="color: #064e3b;">Pengumuman Resmi Warga</h4>
                            <small class="text-muted">Pemberitahuan administratif dan agenda publik desa</small>
                        </div>
                    </div>
                    <a href="{{ route('public.articles', ['type' => 'pengumuman']) }}" class="btn btn-sm btn-outline-success fw-semibold px-3 rounded-pill">
                        Lihat Semua Pengumuman
                    </a>
                </div>

                <div class="row g-3">
                    @foreach($latestAnnouncements as $ann)
                        <div class="col-md-4">
                            <div class="bg-white p-4 rounded-4 shadow-sm border h-100 d-flex flex-column justify-content-between" style="border-color: rgba(6, 78, 59, 0.08) !important;">
                                <div>
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <span class="badge-pill-amber" style="font-size: 0.72rem; padding: 4px 10px;">
                                            Pengumuman
                                        </span>
                                        <small class="text-muted" style="font-size: 0.75rem;">
                                            <i class="bi bi-clock me-1"></i> {{ $ann->published_at ? $ann->published_at->format('d M Y') : $ann->created_at->format('d M Y') }}
                                        </small>
                                    </div>
                                    <h6 class="fw-bold mb-2">
                                        <a href="{{ route('public.articles.detail', $ann->slug) }}" class="text-dark text-decoration-none">
                                            {{ Str::limit($ann->title, 60) }}
                                        </a>
                                    </h6>
                                    <p class="text-secondary small mb-3 lh-base">
                                        {{ Str::limit(strip_tags($ann->summary ?? $ann->content), 90) }}
                                    </p>
                                </div>
                                <a href="{{ route('public.articles.detail', $ann->slug) }}" class="text-success small fw-semibold text-decoration-none d-inline-flex align-items-center gap-1">
                                    Buka Detail <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Cuplikan Sambutan & Profil Desa -->
<section class="py-5 bg-white border-top border-bottom">
    <div class="container py-md-3">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="badge-pill-emerald mb-2">
                    <i class="bi bi-info-circle"></i> Tentang Kami
                </span>
                <h2 class="fw-bold mb-3">Mengenal Wilayah Desa Tautpah</h2>
                <p class="text-secondary mb-4 lh-lg">
                    {{ $profile->about ?? 'Desa Tautpah terletak di Kecamatan Biboki Selatan, Kabupaten Timor Tengah Utara, Provinsi Nusa Tenggara Timur. Desa ini kaya akan potensi pertanian, peternakan, serta kearifan lokal budaya masyarakat Timor.' }}
                </p>
                <div class="p-4 rounded-4 mb-4 border-start border-4 border-success shadow-sm" style="background: #f8faf9;">
                    <h6 class="fw-bold mb-1" style="color: #065f46;"><i class="bi bi-compass me-1"></i> Visi Desa Tautpah:</h6>
                    <p class="small text-secondary mb-0 fst-italic">
                        "{{ $profile->vision ?? 'Terwujudnya Desa Tautpah yang Maju, Mandiri, Sejahtera, dan Berbudaya berbasis Gotong Royong.' }}"
                    </p>
                </div>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('public.profile') }}" class="btn btn-desa-primary">
                        <i class="bi bi-book me-1"></i> Sejarah & Visi Misi
                    </a>
                    <a href="{{ route('public.officials') }}" class="btn btn-desa-outline">
                        <i class="bi bi-people me-1"></i> Struktur Pemerintahan
                    </a>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="p-4 text-white" style="background: linear-gradient(135deg, #064e3b, #047857);">
                        <div class="d-flex align-items-center gap-3">
                            <i class="bi bi-chat-quote-fill fs-1 text-emerald-300" style="color: #6ee7b7;"></i>
                            <div>
                                <h5 class="fw-bold mb-0">Sambutan Resmi Kepala Desa</h5>
                                <small class="text-emerald-100" style="color: #d1fae5;">Pemerintah Desa Tautpah</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4 p-md-5 bg-white">
                        <p class="text-secondary mb-4 lh-lg">
                            {{ $profile->welcome_message ?? 'Selamat datang di website resmi Desa Tautpah. Keterbukaan informasi adalah wujud komitmen kami dalam melayani masyarakat dengan penuh tanggung jawab, transparan, dan berkeadilan.' }}
                        </p>
                        <div class="d-flex align-items-center justify-content-between pt-3 border-top">
                            <div>
                                <h6 class="fw-bold mb-0 text-dark">{{ $profile->leader_name ?? 'Kepala Desa Tautpah' }}</h6>
                                <small class="text-muted">Kepala Desa Tautpah</small>
                            </div>
                            <span class="badge rounded-pill px-3 py-2 fw-semibold" style="background: #ecfdf5; color: #047857;">
                                <i class="bi bi-patch-check-fill me-1"></i> Terverifikasi
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Cuplikan Galeri Kegiatan -->
<section class="py-5" style="background: #f8faf8;">
    <div class="container py-md-3">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 pb-2">
            <div>
                <span class="badge-pill-emerald mb-2">
                    <i class="bi bi-camera"></i> Dokumentasi
                </span>
                <h2 class="fw-bold mb-0">Galeri Foto & Video</h2>
            </div>
            <a href="{{ route('public.galleries') }}" class="btn-desa-outline mt-3 mt-md-0 text-decoration-none d-inline-flex align-items-center">
                Buka Semua Galeri <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>

        <div class="row g-4">
            @forelse($photos->take(4) as $photo)
                <div class="col-6 col-md-3">
                    <div class="card card-custom h-100">
                        <div style="height: 180px; background-color: #cbd5e1; overflow: hidden; position: relative;">
                            @if($photo->file_path)
                                <img src="{{ asset('storage/' . $photo->file_path) }}" class="w-100 h-100 object-fit-cover" alt="{{ $photo->title }}">
                            @else
                                <div class="w-100 h-100 d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #f1f5f9, #e2e8f0); color: #94a3b8;">
                                    <i class="bi bi-image fs-1"></i>
                                </div>
                            @endif
                        </div>
                        <div class="card-body p-3">
                            <h6 class="card-title fw-bold small mb-1">{{ Str::limit($photo->title, 40) }}</h6>
                            <p class="text-muted small mb-0">{{ Str::limit($photo->caption, 50) }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-5">
                    Belum ada foto galeri yang diunggah.
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Lokasi Kantor Desa & Kontak Cepat -->
<section class="py-5 bg-white border-top">
    <div class="container py-md-3">
        <div class="row g-5 align-items-center">
            <div class="col-lg-5">
                <span class="badge-pill-emerald mb-2">
                    <i class="bi bi-geo-alt"></i> Kontak Pelayanan
                </span>
                <h2 class="fw-bold mb-3">Kantor Pemerintah Desa</h2>
                <p class="text-secondary mb-4 lh-lg">
                    Aparatur Desa Tautpah siap melayani urusan administrasi, perizinan surat pengantar, dan permohonan informasi warga pada hari serta jam dinas.
                </p>

                <div class="d-flex flex-column gap-3 mb-4">
                    <div class="d-flex gap-3 align-items-start">
                        <div class="rounded-circle d-flex align-items-center justify-content-center text-success flex-shrink-0" style="background: #ecfdf5; width: 46px; height: 46px;">
                            <i class="bi bi-geo-alt-fill fs-5"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Alamat Kantor</h6>
                            <small class="text-muted lh-base d-block">{{ $contact->address ?? 'Kec. Biboki Selatan, Kab. Timor Tengah Utara, NTT' }}</small>
                        </div>
                    </div>

                    <div class="d-flex gap-3 align-items-start">
                        <div class="rounded-circle d-flex align-items-center justify-content-center text-success flex-shrink-0" style="background: #ecfdf5; width: 46px; height: 46px;">
                            <i class="bi bi-clock-fill fs-5"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Jam Pelayanan Masyarakat</h6>
                            <small class="text-muted d-block">{{ $contact->service_hours ?? 'Senin - Jumat, 08.00 - 15.00 WITA' }}</small>
                        </div>
                    </div>

                    <div class="d-flex gap-3 align-items-start">
                        <div class="rounded-circle d-flex align-items-center justify-content-center text-success flex-shrink-0" style="background: #ecfdf5; width: 46px; height: 46px;">
                            <i class="bi bi-telephone-fill fs-5"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Kontak & Surat Elektronik</h6>
                            <small class="text-muted d-block">{{ $contact->phone ?? '0812-XXXX-XXXX' }} &bull; {{ $contact->email ?? 'kantor@tautpah.desa.id' }}</small>
                        </div>
                    </div>
                </div>

                <a href="{{ route('public.contact') }}" class="btn btn-desa-primary">
                    <i class="bi bi-geo-alt me-1"></i> Buka Peta & Kontak Lengkap
                </a>
            </div>

            <div class="col-lg-7">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden" style="min-height: 380px;">
                    @if($contact->maps_embed_url)
                        <iframe src="{{ $contact->maps_embed_url }}" width="100%" height="380" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    @else
                        <div class="p-5 text-center text-muted bg-light d-flex flex-column align-items-center justify-content-center" style="height: 380px;">
                            <i class="bi bi-map fs-1 mb-2 text-secondary"></i>
                            <span class="fw-semibold">Peta Lokasi Kantor Desa</span>
                            <small class="text-secondary">Koordinat dan peta interaktif akan tampil setelah disetel melalui admin desa.</small>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
