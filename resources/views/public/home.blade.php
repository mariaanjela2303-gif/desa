@extends('layouts.public')

@section('title', 'Beranda - Website Resmi Desa Tautpah')

@section('content')
<!-- Hero Section -->
<section class="position-relative py-5 text-white" style="background: linear-gradient(135deg, rgba(20, 83, 45, 0.95), rgba(21, 128, 61, 0.9)), url('https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&w=1600&q=80') center/cover no-repeat;">
    <div class="container py-4 py-lg-5">
        <div class="row align-items-center g-4">
            <div class="col-lg-8">
                <span class="badge bg-white text-success fw-bold px-3 py-2 rounded-pill mb-3">
                    <i class="bi bi-shield-check me-1"></i> Portal Informasi Resmi Pemerintahan Desa
                </span>
                <h1 class="display-4 fw-black mb-3 text-white fw-bold">
                    Selamat Datang di Website Resmi Desa Tautpah
                </h1>
                <p class="lead mb-4 text-white-50">
                    Kecamatan Biboki Selatan, Kabupaten Timor Tengah Utara, Provinsi Nusa Tenggara Timur. Media keterbukaan informasi publik, transparansi pembangunan, dan pelayanan masyarakat.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('public.articles') }}" class="btn btn-light text-success fw-bold px-4 py-2 rounded-3 shadow">
                        <i class="bi bi-newspaper me-1"></i> Baca Berita Desa
                    </a>
                    <a href="{{ route('public.profile') }}" class="btn btn-outline-light fw-bold px-4 py-2 rounded-3">
                        <i class="bi bi-info-circle me-1"></i> Profil & Visi Misi
                    </a>
                </div>
            </div>
            <div class="col-lg-4 text-center">
                <div class="bg-white text-dark p-4 rounded-4 shadow-lg text-start">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="bg-success text-white rounded-circle p-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="bi bi-person-badge fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold">{{ $profile->leader_name ?? 'Kepala Desa Tautpah' }}</h6>
                            <small class="text-muted">Kepala Desa Tautpah</small>
                        </div>
                    </div>
                    <blockquote class="small text-secondary mb-3 fst-italic">
                        "{{ Str::limit($profile->welcome_message ?? 'Selamat datang di portal informasi resmi Desa Tautpah. Kami berkomitmen untuk terus meningkatkan pelayanan masyarakat dan transparansi pembangunan.', 150) }}"
                    </blockquote>
                    <a href="{{ route('public.profile') }}" class="text-success text-decoration-none fw-semibold small">
                        Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Statistik Cepat / Counter Section -->
<section class="py-4 bg-white border-bottom shadow-sm">
    <div class="container">
        <div class="row g-3 text-center">
            <div class="col-6 col-md-3">
                <div class="p-3">
                    <h3 class="fw-bold text-success mb-1">{{ $totalNews }}</h3>
                    <span class="text-muted small fw-semibold"><i class="bi bi-newspaper me-1"></i> Berita Dipublikasikan</span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-3">
                    <h3 class="fw-bold text-success mb-1">{{ $totalAnnouncements }}</h3>
                    <span class="text-muted small fw-semibold"><i class="bi bi-megaphone me-1"></i> Pengumuman Warga</span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-3">
                    <h3 class="fw-bold text-success mb-1">{{ $totalGalleries }}</h3>
                    <span class="text-muted small fw-semibold"><i class="bi bi-images me-1"></i> Dokumentasi Kegiatan</span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-3">
                    <h3 class="fw-bold text-success mb-1">{{ $totalOfficials }}</h3>
                    <span class="text-muted small fw-semibold"><i class="bi bi-people me-1"></i> Aparatur Pemerintah Desa</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Berita Terbaru & Pengumuman -->
<section class="py-5">
    <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4">
            <div>
                <span class="badge bg-success bg-opacity-10 text-success fw-bold px-3 py-1 rounded-pill mb-2">Warta Terkini</span>
                <h2 class="fw-bold mb-0">Berita & Informasi Terbaru</h2>
            </div>
            <a href="{{ route('public.articles') }}" class="btn-desa-outline mt-3 mt-md-0 text-decoration-none d-inline-flex align-items-center">
                Semua Berita <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>

        <div class="row g-4 mb-5">
            @forelse($latestNews as $item)
                <div class="col-md-4">
                    <div class="card card-custom h-100">
                        <div class="position-relative" style="height: 200px; background-color: #e2e8f0; overflow: hidden;">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" class="w-100 h-100 object-fit-cover" alt="{{ $item->title }}">
                            @else
                                <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success">
                                    <i class="bi bi-newspaper fs-1"></i>
                                </div>
                            @endif
                            <span class="position-absolute top-0 start-0 m-3 badge bg-success shadow-sm">
                                {{ $item->category?->name ?? 'Berita Desa' }}
                            </span>
                        </div>
                        <div class="card-body d-flex flex-column p-4">
                            <div class="d-flex align-items-center gap-2 text-muted small mb-2">
                                <span><i class="bi bi-calendar3 me-1"></i> {{ $item->published_at ? $item->published_at->format('d M Y') : $item->created_at->format('d M Y') }}</span>
                                <span>&bull;</span>
                                <span><i class="bi bi-eye me-1"></i> {{ $item->views_count }} tayang</span>
                            </div>
                            <h5 class="card-title fw-bold mb-2">
                                <a href="{{ route('public.articles.detail', $item->slug) }}" class="text-dark text-decoration-none hover-success">
                                    {{ Str::limit($item->title, 65) }}
                                </a>
                            </h5>
                            <p class="card-text text-secondary small mb-4 flex-grow-1">
                                {{ Str::limit(strip_tags($item->summary ?? $item->content), 110) }}
                            </p>
                            <div>
                                <a href="{{ route('public.articles.detail', $item->slug) }}" class="text-success text-decoration-none fw-bold small">
                                    Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="p-4 bg-white rounded-3 border text-center text-muted">
                        <i class="bi bi-info-circle fs-3 d-block mb-2"></i> Belum ada berita yang dipublikasikan saat ini.
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Bagian Pengumuman Warga -->
        @if($latestAnnouncements->count() > 0)
            <div class="bg-success bg-opacity-10 rounded-4 p-4 p-lg-5 mb-5 border border-success border-opacity-25">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-success text-white p-2 rounded-3">
                            <i class="bi bi-megaphone-fill fs-4"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-0 text-success">Pengumuman Penting Desa</h4>
                            <small class="text-muted">Pemberitahuan resmi untuk segenap warga Desa Tautpah</small>
                        </div>
                    </div>
                    <a href="{{ route('public.articles', ['type' => 'pengumuman']) }}" class="btn btn-sm btn-success fw-semibold">
                        Lihat Semua
                    </a>
                </div>

                <div class="row g-3">
                    @foreach($latestAnnouncements as $ann)
                        <div class="col-md-4">
                            <div class="bg-white p-3 rounded-3 shadow-sm border h-100 d-flex flex-column justify-content-between">
                                <div>
                                    <div class="text-muted small mb-1">
                                        <i class="bi bi-clock me-1"></i> {{ $ann->published_at ? $ann->published_at->format('d M Y') : $ann->created_at->format('d M Y') }}
                                    </div>
                                    <h6 class="fw-bold mb-2">
                                        <a href="{{ route('public.articles.detail', $ann->slug) }}" class="text-dark text-decoration-none">
                                            {{ Str::limit($ann->title, 60) }}
                                        </a>
                                    </h6>
                                    <p class="text-secondary small mb-2">
                                        {{ Str::limit(strip_tags($ann->summary ?? $ann->content), 90) }}
                                    </p>
                                </div>
                                <a href="{{ route('public.articles.detail', $ann->slug) }}" class="text-success small fw-semibold text-decoration-none">
                                    Buka Pengumuman <i class="bi bi-arrow-right"></i>
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
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="badge bg-success bg-opacity-10 text-success fw-bold px-3 py-1 rounded-pill mb-2">Tentang Desa</span>
                <h2 class="fw-bold mb-3">Mengenal Desa Tautpah Lebih Dekat</h2>
                <p class="text-secondary mb-4">
                    {{ $profile->about ?? 'Desa Tautpah terletak di Kecamatan Biboki Selatan, Kabupaten Timor Tengah Utara, Provinsi Nusa Tenggara Timur. Desa ini kaya akan potensi pertanian, peternakan, serta kearifan lokal budaya masyarakat Timor.' }}
                </p>
                <div class="p-3 bg-light rounded-3 border-start border-4 border-success mb-4">
                    <h6 class="fw-bold text-dark mb-1"><i class="bi bi-compass me-1 text-success"></i> Visi Desa Tautpah:</h6>
                    <p class="small text-secondary mb-0">
                        "{{ $profile->vision ?? 'Terwujudnya Desa Tautpah yang Maju, Mandiri, Sejahtera, dan Berbudaya berbasis Gotong Royong.' }}"
                    </p>
                </div>
                <div class="d-flex gap-3">
                    <a href="{{ route('public.profile') }}" class="btn btn-desa-primary">
                        <i class="bi bi-book me-1"></i> Sejarah & Visi Misi Lengkap
                    </a>
                    <a href="{{ route('public.officials') }}" class="btn btn-desa-outline">
                        <i class="bi bi-people me-1"></i> Struktur Pemerintahan
                    </a>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card border-0 shadow rounded-4 overflow-hidden">
                    <div class="bg-success text-white p-4">
                        <div class="d-flex align-items-center gap-3">
                            <i class="bi bi-chat-quote-fill fs-1 text-white-50"></i>
                            <div>
                                <h5 class="fw-bold mb-0">Sambutan Kepala Desa</h5>
                                <small class="text-white-50">Pemerintah Desa Tautpah</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4 bg-white">
                        <p class="text-secondary mb-4 lh-base">
                            {{ $profile->welcome_message ?? 'Selamat datang di website resmi Desa Tautpah. Keterbukaan informasi adalah wujud komitmen kami dalam melayani masyarakat dengan penuh tanggung jawab, transparan, dan berkeadilan.' }}
                        </p>
                        <div class="d-flex align-items-center justify-content-between pt-3 border-top">
                            <div>
                                <h6 class="fw-bold mb-0">{{ $profile->leader_name ?? 'Kepala Desa Tautpah' }}</h6>
                                <small class="text-muted">Kepala Desa Tautpah</small>
                            </div>
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-semibold">
                                <i class="bi bi-patch-check-fill me-1"></i> Resmi
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Cuplikan Galeri Kegiatan -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4">
            <div>
                <span class="badge bg-success bg-opacity-10 text-success fw-bold px-3 py-1 rounded-pill mb-2">Dokumentasi</span>
                <h2 class="fw-bold mb-0">Galeri Foto & Video</h2>
            </div>
            <a href="{{ route('public.galleries') }}" class="btn-desa-outline mt-3 mt-md-0 text-decoration-none d-inline-flex align-items-center">
                Lihat Semua Galeri <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>

        <div class="row g-4">
            @forelse($photos->take(4) as $photo)
                <div class="col-6 col-md-3">
                    <div class="card card-custom h-100">
                        <div style="height: 160px; background-color: #cbd5e1; overflow: hidden;">
                            @if($photo->file_path)
                                <img src="{{ asset('storage/' . $photo->file_path) }}" class="w-100 h-100 object-fit-cover" alt="{{ $photo->title }}">
                            @else
                                <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-secondary bg-opacity-10 text-muted">
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
                <div class="col-12 text-center text-muted py-4">
                    Belum ada foto galeri yang diunggah.
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Lokasi Kantor Desa & Kontak Cepat -->
<section class="py-5 bg-white border-top">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-lg-5">
                <span class="badge bg-success bg-opacity-10 text-success fw-bold px-3 py-1 rounded-pill mb-2">Lokasi & Pelayanan</span>
                <h2 class="fw-bold mb-3">Kunjungi Kantor Desa Kami</h2>
                <p class="text-secondary mb-4">
                    Pemerintah Desa Tautpah siap melayani keperluan administrasi, konsultasi, dan pengurusan kebutuhan masyarakat pada jam kerja resmi.
                </p>

                <div class="d-flex flex-column gap-3 mb-4">
                    <div class="d-flex gap-3">
                        <div class="bg-success bg-opacity-10 text-success rounded-circle p-3 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                            <i class="bi bi-geo-alt-fill fs-5"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">Alamat Kantor</h6>
                            <small class="text-muted">{{ $contact->address ?? 'Kec. Biboki Selatan, Kab. Timor Tengah Utara, NTT' }}</small>
                        </div>
                    </div>

                    <div class="d-flex gap-3">
                        <div class="bg-success bg-opacity-10 text-success rounded-circle p-3 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                            <i class="bi bi-clock-fill fs-5"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">Jam Pelayanan</h6>
                            <small class="text-muted">{{ $contact->service_hours ?? 'Senin - Jumat, 08.00 - 15.00 WITA' }}</small>
                        </div>
                    </div>

                    <div class="d-flex gap-3">
                        <div class="bg-success bg-opacity-10 text-success rounded-circle p-3 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                            <i class="bi bi-telephone-fill fs-5"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">Kontak Telepon / Email</h6>
                            <small class="text-muted">{{ $contact->phone ?? '0812-XXXX-XXXX' }} / {{ $contact->email ?? 'kantor@tautpah.desa.id' }}</small>
                        </div>
                    </div>
                </div>

                <a href="{{ route('public.contact') }}" class="btn btn-desa-primary">
                    <i class="bi bi-geo-alt me-1"></i> Buka Halaman Kontak Lengkap
                </a>
            </div>

            <div class="col-lg-7">
                <div class="card border-0 shadow rounded-4 overflow-hidden" style="min-height: 340px;">
                    @if($contact->maps_embed_url)
                        <iframe src="{{ $contact->maps_embed_url }}" width="100%" height="340" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    @else
                        <div class="p-5 text-center text-muted bg-light d-flex flex-column align-items-center justify-content-center" style="height: 340px;">
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
