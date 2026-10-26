<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Monitoring Kepala Desa') - Desa Tautpah</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --kades-sidebar-bg: #1e1b4b;
            --kades-accent: #4338ca;
            --kades-active: #4f46e5;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
        }

        #kades-wrapper {
            display: flex;
            min-height: 100vh;
        }

        #kades-sidebar {
            width: 270px;
            background-color: var(--kades-sidebar-bg);
            color: #cbd5e1;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
        }

        .sidebar-brand {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-menu {
            padding: 20px 14px;
            flex-grow: 1;
        }

        .menu-header {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: #818cf8;
            font-weight: 700;
            margin: 16px 10px 8px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            color: #c7d2fe;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            margin-bottom: 4px;
        }

        .sidebar-link i {
            font-size: 1.15rem;
        }

        .sidebar-link:hover {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.08);
        }

        .sidebar-link.active {
            color: #ffffff;
            background-color: var(--kades-active);
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.4);
        }

        #kades-content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        .kades-header {
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 14px 28px;
        }

        .kades-main {
            padding: 28px;
            flex-grow: 1;
        }

        .monitoring-badge {
            background: linear-gradient(135deg, #4338ca, #312e81);
            color: white;
            font-size: 0.72rem;
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
    </style>
    @stack('styles')
</head>
<body>

<div id="kades-wrapper">
    <!-- Sidebar Kepala Desa -->
    <aside id="kades-sidebar">
        <div class="sidebar-brand d-flex align-items-center gap-3">
            <div class="bg-indigo text-white rounded-3 p-2 d-flex align-items-center justify-content-center" style="background-color: #4f46e5; width: 40px; height: 40px;">
                <i class="bi bi-award-fill fs-5"></i>
            </div>
            <div>
                <h6 class="mb-0 text-white fw-bold">Kepala Desa</h6>
                <small class="text-indigo-200" style="color: #a5b4fc; font-size: 0.75rem;">Panel Pemantauan (Read-Only)</small>
            </div>
        </div>

        <div class="sidebar-menu">
            <div class="menu-header">Monitoring Utama</div>
            <a href="{{ route('kepaladesa.dashboard') }}" class="sidebar-link {{ request()->routeIs('kepaladesa.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard Monitoring
            </a>

            <div class="menu-header">Pemantauan Konten</div>
            <a href="{{ route('kepaladesa.articles') }}" class="sidebar-link {{ request()->routeIs('kepaladesa.articles*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-text"></i> Berita & Pengumuman
            </a>
            <a href="{{ route('kepaladesa.galleries') }}" class="sidebar-link {{ request()->routeIs('kepaladesa.galleries*') ? 'active' : '' }}">
                <i class="bi bi-images"></i> Galeri Foto & Video
            </a>

            <div class="menu-header">Pengawasan & Statistik</div>
            <a href="{{ route('kepaladesa.activities') }}" class="sidebar-link {{ request()->routeIs('kepaladesa.activities*') ? 'active' : '' }}">
                <i class="bi bi-journal-text"></i> Riwayat Aktivitas Admin
            </a>
            <a href="{{ route('kepaladesa.page_views') }}" class="sidebar-link {{ request()->routeIs('kepaladesa.page_views*') ? 'active' : '' }}">
                <i class="bi bi-bar-chart-line"></i> Statistik Kunjungan Web
            </a>

            <div class="menu-header">Situs Publik</div>
            <a href="{{ route('home') }}" target="_blank" class="sidebar-link">
                <i class="bi bi-box-arrow-up-right"></i> Lihat Website Publik
            </a>
        </div>

        <div class="p-3 border-top border-white border-opacity-10">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2 overflow-hidden">
                    <i class="bi bi-person-badge fs-4" style="color: #c7d2fe;"></i>
                    <div class="text-truncate">
                        <div class="text-white small fw-bold text-truncate">{{ auth()->user()->name }}</div>
                        <span class="badge" style="background-color: #6366f1; font-size: 0.7rem;">Kepala Desa</span>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm border-0 text-white" title="Keluar / Logout">
                        <i class="bi bi-box-arrow-right fs-5"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div id="kades-content">
        <!-- Header -->
        <header class="kades-header d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-3">
                <div>
                    <h5 class="mb-0 fw-bold">@yield('page_title', 'Dashboard Monitoring')</h5>
                    <small class="text-muted">Desa Tautpah, Kec. Biboki Selatan, Kab. Timor Tengah Utara</small>
                </div>
                <span class="monitoring-badge d-none d-md-inline-block">
                    <i class="bi bi-eye-fill me-1"></i> Mode Pemantauan (Read-Only)
                </span>
            </div>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('home') }}" target="_blank" class="btn btn-sm btn-outline-secondary d-none d-sm-inline-flex align-items-center gap-1">
                    <i class="bi bi-globe"></i> Website Publik
                </a>
                <div class="dropdown">
                    <button class="btn btn-sm btn-light border dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle text-primary"></i>
                        <span>{{ auth()->user()->name }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="kades-main">
            @if(session('info'))
                <div class="alert alert-info alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <i class="bi bi-info-circle-fill me-2"></i> {{ session('info') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
