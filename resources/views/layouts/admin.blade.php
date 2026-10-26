<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Website Desa Tautpah</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --admin-sidebar-bg: #0f172a;
            --admin-sidebar-active: #15803d;
            --admin-accent: #15803d;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f1f5f9;
            color: #1e293b;
        }

        #admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        #admin-sidebar {
            width: 270px;
            background-color: var(--admin-sidebar-bg);
            color: #cbd5e1;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
        }

        .sidebar-brand {
            padding: 24px 20px;
            border-bottom: 1px solid #1e293b;
        }

        .sidebar-menu {
            padding: 20px 14px;
            flex-grow: 1;
        }

        .menu-header {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: #64748b;
            font-weight: 700;
            margin: 16px 10px 8px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            color: #94a3b8;
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
            color: #f8fafc;
            background-color: #1e293b;
        }

        .sidebar-link.active {
            color: #ffffff;
            background-color: var(--admin-sidebar-active);
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(21, 128, 61, 0.35);
        }

        #admin-content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        .admin-header {
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 14px 28px;
        }

        .admin-main {
            padding: 28px;
            flex-grow: 1;
        }

        .card-stat {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            background: #ffffff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
            transition: transform 0.2s;
        }

        .card-stat:hover {
            transform: translateY(-2px);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
        }

        .btn-success-desa {
            background-color: #15803d;
            color: white;
            border: none;
            font-weight: 600;
        }

        .btn-success-desa:hover {
            background-color: #166534;
            color: white;
        }

        .badge-role {
            font-size: 0.72rem;
            padding: 4px 10px;
            border-radius: 20px;
            font-weight: 700;
        }
    </style>
    @stack('styles')
</head>
<body>

<div id="admin-wrapper">
    <!-- Sidebar -->
    <aside id="admin-sidebar">
        <div class="sidebar-brand d-flex align-items-center gap-3">
            <div class="bg-success text-white rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                <i class="bi bi-shield-lock-fill fs-5"></i>
            </div>
            <div>
                <h6 class="mb-0 text-white fw-bold">Admin Desa</h6>
                <small class="text-secondary" style="font-size: 0.75rem;">Desa Tautpah</small>
            </div>
        </div>

        <div class="sidebar-menu">
            <div class="menu-header">Utama</div>
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>

            <div class="menu-header">Konten & Publikasi</div>
            <a href="{{ route('admin.articles.index') }}" class="sidebar-link {{ request()->routeIs('admin.articles*') ? 'active' : '' }}">
                <i class="bi bi-newspaper"></i> Berita & Pengumuman
            </a>
            <a href="{{ route('admin.categories.index') }}" class="sidebar-link {{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
                <i class="bi bi-tags"></i> Kategori
            </a>
            <a href="{{ route('admin.galleries.index') }}" class="sidebar-link {{ request()->routeIs('admin.galleries*') ? 'active' : '' }}">
                <i class="bi bi-images"></i> Galeri Foto & Video
            </a>

            <div class="menu-header">Profil & Informasi</div>
            <a href="{{ route('admin.profile.edit') }}" class="sidebar-link {{ request()->routeIs('admin.profile*') ? 'active' : '' }}">
                <i class="bi bi-building"></i> Profil, Sejarah & Visi Misi
            </a>
            <a href="{{ route('admin.officials.index') }}" class="sidebar-link {{ request()->routeIs('admin.officials*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Struktur Pemerintahan
            </a>
            <a href="{{ route('admin.contact.edit') }}" class="sidebar-link {{ request()->routeIs('admin.contact*') ? 'active' : '' }}">
                <i class="bi bi-geo-alt"></i> Kontak & Peta Kantor
            </a>

            <div class="menu-header">Audit & Keamanan</div>
            <a href="{{ route('admin.activity_logs.index') }}" class="sidebar-link {{ request()->routeIs('admin.activity_logs*') ? 'active' : '' }}">
                <i class="bi bi-clock-history"></i> Riwayat Aktivitas Admin
            </a>

            <div class="menu-header">Situs Publik</div>
            <a href="{{ route('home') }}" target="_blank" class="sidebar-link">
                <i class="bi bi-box-arrow-up-right"></i> Lihat Website Publik
            </a>
        </div>

        <div class="p-3 border-top border-dark border-opacity-50">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2 overflow-hidden">
                    <i class="bi bi-person-circle fs-4 text-secondary"></i>
                    <div class="text-truncate">
                        <div class="text-white small fw-bold text-truncate">{{ auth()->user()->name }}</div>
                        <span class="badge bg-success badge-role">Administrator</span>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm border-0" title="Keluar / Logout">
                        <i class="bi bi-box-arrow-right fs-5"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Content Area -->
    <div id="admin-content">
        <!-- Header -->
        <header class="admin-header d-flex align-items-center justify-content-between">
            <div>
                <h5 class="mb-0 fw-bold">@yield('page_title', 'Dashboard')</h5>
                <small class="text-muted">Kelola data dan informasi publik Desa Tautpah</small>
            </div>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('home') }}" target="_blank" class="btn btn-sm btn-outline-secondary d-none d-sm-inline-flex align-items-center gap-1">
                    <i class="bi bi-globe"></i> Website Publik
                </a>
                <div class="dropdown">
                    <button class="btn btn-sm btn-light border dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-fill text-success"></i>
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
        <main class="admin-main">
            <!-- Flash Message -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <i class="bi bi-x-circle-fill me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <i class="bi bi-exclamation-circle-fill me-2"></i> Terdapat kesalahan pada formulir yang Anda kirim:
                    <ul class="mb-0 mt-2 small">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
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
