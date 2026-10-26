<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Website Informasi Desa Tautpah') - Biboki Selatan, Timor Tengah Utara</title>
    <meta name="description" content="Website Informasi Resmi Desa Tautpah, Kecamatan Biboki Selatan, Kabupaten Timor Tengah Utara, Nusa Tenggara Timur.">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 & Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --desa-green-dark: #14532d;
            --desa-green-primary: #15803d;
            --desa-green-light: #22c55e;
            --desa-green-soft: #f0fdf4;
            --desa-text-dark: #1e293b;
            --desa-text-muted: #64748b;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--desa-text-dark);
            background-color: #f8fafc;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .top-bar {
            background-color: var(--desa-green-dark);
            color: #e2e8f0;
            font-size: 0.85rem;
            padding: 8px 0;
        }

        .navbar-desa {
            background-color: #ffffff;
            box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.06);
            padding: 14px 0;
            transition: all 0.3s ease;
        }

        .navbar-desa .nav-link {
            font-weight: 600;
            color: #334155;
            padding: 8px 16px !important;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .navbar-desa .nav-link:hover,
        .navbar-desa .nav-link.active {
            color: var(--desa-green-primary) !important;
            background-color: var(--desa-green-soft);
        }

        .brand-badge {
            background: linear-gradient(135deg, var(--desa-green-primary), var(--desa-green-dark));
            color: white;
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
            box-shadow: 0 4px 10px rgba(21, 128, 61, 0.3);
        }

        .btn-desa-primary {
            background-color: var(--desa-green-primary);
            color: #ffffff;
            border: none;
            font-weight: 600;
            padding: 10px 22px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .btn-desa-primary:hover {
            background-color: var(--desa-green-dark);
            color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(21, 128, 61, 0.25);
        }

        .btn-desa-outline {
            border: 2px solid var(--desa-green-primary);
            color: var(--desa-green-primary);
            font-weight: 600;
            padding: 8px 20px;
            border-radius: 8px;
            background: transparent;
            transition: all 0.2s ease;
        }

        .btn-desa-outline:hover {
            background-color: var(--desa-green-primary);
            color: #ffffff;
        }

        .section-title {
            position: relative;
            margin-bottom: 2.5rem;
        }

        .section-title h2 {
            font-weight: 800;
            color: #0f172a;
        }

        .section-title .badge-sub {
            background-color: var(--desa-green-soft);
            color: var(--desa-green-primary);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.75rem;
            padding: 6px 14px;
            border-radius: 50px;
            display: inline-block;
            margin-bottom: 8px;
        }

        .card-custom {
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            overflow: hidden;
            background: #ffffff;
            transition: all 0.25s ease;
        }

        .card-custom:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -6px rgba(0, 0, 0, 0.08);
            border-color: #cbd5e1;
        }

        footer {
            margin-top: auto;
            background-color: #0f172a;
            color: #94a3b8;
            padding-top: 4rem;
            padding-bottom: 2rem;
        }

        footer h5 {
            color: #f8fafc;
            font-weight: 700;
            margin-bottom: 1.25rem;
        }

        footer a {
            color: #94a3b8;
            text-decoration: none;
            transition: color 0.2s;
        }

        footer a:hover {
            color: #4ade80;
        }

        .footer-bottom {
            border-top: 1px solid #1e293b;
            margin-top: 3rem;
            padding-top: 1.5rem;
            font-size: 0.85rem;
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Baris Informasi Atas -->
    <div class="top-bar d-none d-md-block">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-4">
                <span><i class="bi bi-geo-alt-fill text-success me-1"></i> Kec. Biboki Selatan, Kab. Timor Tengah Utara, NTT</span>
                <span><i class="bi bi-clock-fill text-success me-1"></i> Pelayanan: Senin - Jumat (08.00 - 15.00 WITA)</span>
            </div>
            <div>
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="text-white text-decoration-none fw-semibold">
                            <i class="bi bi-speedometer2 me-1"></i> Dashboard Admin
                        </a>
                    @else
                        <a href="{{ route('kepaladesa.dashboard') }}" class="text-white text-decoration-none fw-semibold">
                            <i class="bi bi-shield-check me-1"></i> Panel Kepala Desa
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="text-white text-decoration-none fw-semibold">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Login Perangkat Desa
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Navigasi Utama -->
    <nav class="navbar navbar-expand-lg navbar-desa sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-3" href="{{ route('home') }}">
                <div class="brand-badge">
                    <i class="bi bi-houses-fill"></i>
                </div>
                <div>
                    <span class="d-block fw-bold text-dark fs-5 lh-1">Desa Tautpah</span>
                    <small class="text-muted" style="font-size: 0.75rem;">Kec. Biboki Selatan, Kab. TTU, NTT</small>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navPublicContent" aria-controls="navPublicContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navPublicContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center gap-1">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="bi bi-house-door me-1"></i> Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('public.profile') ? 'active' : '' }}" href="{{ route('public.profile') }}">
                            <i class="bi bi-info-circle me-1"></i> Profil Desa
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('public.officials') ? 'active' : '' }}" href="{{ route('public.officials') }}">
                            <i class="bi bi-people me-1"></i> Pemerintahan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('public.articles*') ? 'active' : '' }}" href="{{ route('public.articles') }}">
                            <i class="bi bi-newspaper me-1"></i> Berita & Pengumuman
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('public.galleries') ? 'active' : '' }}" href="{{ route('public.galleries') }}">
                            <i class="bi bi-images me-1"></i> Galeri
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('public.contact') ? 'active' : '' }}" href="{{ route('public.contact') }}">
                            <i class="bi bi-telephone me-1"></i> Kontak
                        </a>
                    </li>
                    <li class="nav-item ms-lg-2 d-lg-none mt-2">
                        @auth
                            <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('kepaladesa.dashboard') }}" class="btn btn-desa-primary w-100">
                                <i class="bi bi-speedometer2 me-1"></i> Masuk Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-desa-outline w-100">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Login Pengelola
                            </a>
                        @endauth
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Notifikasi Flash Message -->
    <div class="container mt-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('warning'))
            <div class="alert alert-warning alert-dismissible fade show border-0 shadow-sm" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                <i class="bi bi-x-circle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('info'))
            <div class="alert alert-info alert-dismissible fade show border-0 shadow-sm" role="alert">
                <i class="bi bi-info-circle-fill me-2"></i> {{ session('info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <!-- Konten Halaman -->
    <main class="flex-grow-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-5 col-md-6">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="brand-badge">
                            <i class="bi bi-houses-fill"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 text-white">Desa Tautpah</h5>
                            <small class="text-muted">Kecamatan Biboki Selatan, Kabupaten Timor Tengah Utara</small>
                        </div>
                    </div>
                    <p class="small text-secondary pe-lg-4">
                        Media komunikasi dan portal resmi Pemerintah Desa Tautpah untuk menyampaikan informasi seputar pembangunan, pelayanan publik, pemerintahan, dan kegiatan kemasyarakatan.
                    </p>
                    <div class="d-flex gap-3 text-secondary">
                        <span><i class="bi bi-shield-check text-success me-1"></i> Transparan</span>
                        <span><i class="bi bi-heart text-success me-1"></i> Melayani</span>
                        <span><i class="bi bi-people text-success me-1"></i> Gotong Royong</span>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5>Tautan Cepat</h5>
                    <ul class="list-unstyled small d-flex flex-column gap-2">
                        <li><a href="{{ route('home') }}"><i class="bi bi-chevron-right me-1 text-success"></i> Beranda</a></li>
                        <li><a href="{{ route('public.profile') }}"><i class="bi bi-chevron-right me-1 text-success"></i> Profil & Visi Misi</a></li>
                        <li><a href="{{ route('public.officials') }}"><i class="bi bi-chevron-right me-1 text-success"></i> Struktur Pemerintahan</a></li>
                        <li><a href="{{ route('public.articles') }}"><i class="bi bi-chevron-right me-1 text-success"></i> Berita & Pengumuman</a></li>
                        <li><a href="{{ route('public.galleries') }}"><i class="bi bi-chevron-right me-1 text-success"></i> Galeri Kegiatan</a></li>
                        <li><a href="{{ route('public.contact') }}"><i class="bi bi-chevron-right me-1 text-success"></i> Kontak & Peta Lokasi</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12">
                    <h5>Kantor Pelayanan Desa</h5>
                    <ul class="list-unstyled small text-secondary d-flex flex-column gap-2 mb-3">
                        <li>
                            <i class="bi bi-geo-alt-fill text-success me-2"></i>
                            Kecamatan Biboki Selatan, Kabupaten Timor Tengah Utara, Nusa Tenggara Timur (NTT)
                        </li>
                        <li>
                            <i class="bi bi-clock-fill text-success me-2"></i>
                            Senin s.d. Jumat | 08.00 - 15.00 WITA
                        </li>
                        <li>
                            <i class="bi bi-shield-lock-fill text-success me-2"></i>
                            Akses Pengelola: 
                            <a href="{{ route('login') }}" class="text-success text-decoration-underline ms-1">Login Admin / Kepala Desa</a>
                        </li>
                    </ul>
                    <div class="p-3 rounded-3 bg-dark border border-secondary border-opacity-25 small">
                        <span class="text-white fw-semibold d-block mb-1"><i class="bi bi-info-circle text-warning me-1"></i> Catatan Data</span>
                        <span class="text-secondary">Seluruh data yang bertanda [DATA CONTOH] disiapkan untuk pengujian dan dapat diperbarui sewaktu-waktu oleh admin desa.</span>
                    </div>
                </div>
            </div>

            <div class="footer-bottom d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
                <p class="mb-0 text-center text-md-start">
                    &copy; {{ date('Y') }} Pemerintah Desa Tautpah. Hak Cipta Dilindungi Undang-Undang.
                </p>
                <p class="mb-0 text-center text-md-end text-secondary">
                    Biboki Selatan, Timor Tengah Utara, Nusa Tenggara Timur
                </p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
