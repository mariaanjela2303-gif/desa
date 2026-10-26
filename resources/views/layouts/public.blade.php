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
            /* Emerald Botanical Aesthetic Palette */
            --desa-forest-dark: #062e22;
            --desa-forest-surface: #0a4232;
            --desa-emerald-deep: #065f46;
            --desa-emerald-main: #059669;
            --desa-emerald-light: #10b981;
            --desa-emerald-glow: rgba(16, 185, 129, 0.25);
            
            --desa-sage-soft: #f0fdf4;
            --desa-sage-subtle: #dcfce7;
            --desa-sage-border: rgba(5, 150, 105, 0.15);
            
            --desa-bg-canvas: #f8faf8;
            --desa-bg-card: #ffffff;
            
            --desa-text-headline: #071e16;
            --desa-text-body: #334155;
            --desa-text-muted: #64748b;
            
            --desa-amber-soft: #fffbeb;
            --desa-amber-text: #b45309;
            --desa-amber-border: #fde68a;
            
            --desa-shadow-sm: 0 2px 8px -2px rgba(6, 46, 34, 0.05);
            --desa-shadow-md: 0 10px 25px -5px rgba(6, 46, 34, 0.06), 0 8px 10px -6px rgba(6, 46, 34, 0.04);
            --desa-shadow-lg: 0 20px 35px -10px rgba(6, 46, 34, 0.09), 0 10px 15px -5px rgba(6, 46, 34, 0.03);
            --desa-shadow-glow: 0 10px 25px -3px rgba(5, 150, 105, 0.3);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--desa-text-body);
            background-color: var(--desa-bg-canvas);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3, h4, h5, h6 {
            color: var(--desa-text-headline);
            letter-spacing: -0.02em;
        }

        /* Top Bar */
        .top-bar {
            background-color: var(--desa-forest-dark);
            color: #d1fae5;
            font-size: 0.82rem;
            padding: 9px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.07);
        }

        .top-bar a {
            transition: all 0.2s;
        }

        .top-bar a:hover {
            color: #6ee7b7 !important;
        }

        /* Glassmorphic Navbar */
        .navbar-desa {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            box-shadow: 0 4px 24px -2px rgba(6, 46, 34, 0.04);
            border-bottom: 1px solid rgba(6, 78, 59, 0.06);
            padding: 14px 0;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .brand-badge {
            background: linear-gradient(135deg, #059669 0%, #064e3b 100%);
            color: white;
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
            box-shadow: 0 6px 16px -2px rgba(5, 150, 105, 0.35);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: transform 0.25s ease;
        }

        .navbar-brand:hover .brand-badge {
            transform: scale(1.05) rotate(-3deg);
        }

        .navbar-desa .nav-link {
            font-weight: 600;
            color: #475569;
            padding: 8px 16px !important;
            border-radius: 50px;
            transition: all 0.2s ease;
            font-size: 0.92rem;
        }

        .navbar-desa .nav-link:hover {
            color: var(--desa-emerald-main) !important;
            background-color: var(--desa-sage-soft);
        }

        .navbar-desa .nav-link.active {
            color: var(--desa-emerald-deep) !important;
            background-color: var(--desa-sage-subtle);
        }

        /* Aesthetic Buttons */
        .btn-desa-primary {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.15);
            font-weight: 600;
            padding: 10px 22px;
            border-radius: 50px;
            box-shadow: var(--desa-shadow-glow);
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .btn-desa-primary:hover {
            background: linear-gradient(135deg, #047857 0%, #064e3b 100%);
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 14px 28px -4px rgba(5, 150, 105, 0.45);
        }

        .btn-desa-outline {
            border: 1.5px solid var(--desa-emerald-main);
            color: var(--desa-emerald-main);
            font-weight: 600;
            padding: 9px 22px;
            border-radius: 50px;
            background: rgba(255, 255, 255, 0.8);
            transition: all 0.25s ease;
        }

        .btn-desa-outline:hover {
            background-color: var(--desa-emerald-main);
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px -2px rgba(5, 150, 105, 0.25);
        }

        /* Aesthetic Badges */
        .badge-pill-emerald {
            background-color: var(--desa-sage-soft);
            color: var(--desa-emerald-deep);
            border: 1px solid var(--desa-sage-border);
            font-weight: 700;
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 0.78rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .badge-pill-amber {
            background-color: var(--desa-amber-soft);
            color: var(--desa-amber-text);
            border: 1px solid var(--desa-amber-border);
            font-weight: 700;
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 0.78rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        /* Aesthetic Cards */
        .card-custom {
            border: 1px solid rgba(6, 78, 59, 0.08);
            border-radius: 18px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: var(--desa-shadow-sm);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: var(--desa-shadow-lg);
            border-color: rgba(5, 150, 105, 0.25);
        }

        /* Footer */
        footer {
            margin-top: auto;
            background: linear-gradient(180deg, #06241a 0%, #03140e 100%);
            color: #94a3b8;
            padding-top: 4.5rem;
            padding-bottom: 2rem;
            position: relative;
            border-top: 1px solid rgba(16, 185, 129, 0.15);
        }

        footer h5 {
            color: #f1f5f9;
            font-weight: 700;
            margin-bottom: 1.25rem;
            letter-spacing: -0.01em;
        }

        footer a {
            color: #94a3b8;
            text-decoration: none;
            transition: color 0.2s ease, transform 0.2s ease;
        }

        footer a:hover {
            color: #34d399;
            transform: translateX(3px);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            margin-top: 3.5rem;
            padding-top: 1.75rem;
            font-size: 0.85rem;
        }
    </style>

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
