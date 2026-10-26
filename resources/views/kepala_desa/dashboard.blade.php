@extends('layouts.kepala_desa')

@section('title', 'Dashboard Monitoring Kepala Desa - Desa Tautpah')
@section('page_title', 'Ringkasan Pemantauan Website Desa')

@section('content')
<!-- Banner Sambutan & Status Hak Akses -->
<div class="card border-0 shadow-sm rounded-4 p-4 mb-4 text-white" style="background: linear-gradient(135deg, #312e81, #4338ca);">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <span class="badge bg-white text-primary fw-bold px-3 py-1 rounded-pill mb-2">
                <i class="bi bi-shield-check me-1"></i> Mode Pemantauan Eksekutif
            </span>
            <h4 class="fw-bold mb-1">Selamat Datang, Bapak/Ibu Kepala Desa</h4>
            <p class="mb-0 text-white-50 small">
                Panel ini disediakan untuk memantau publikasi informasi, aktivitas admin pengelola, dan statistik keterbacaan website Desa Tautpah.
            </p>
        </div>
        <div class="text-md-end">
            <span class="badge bg-indigo-900 border border-indigo-400 p-2 px-3 rounded-3" style="background: rgba(0,0,0,0.25);">
                <i class="bi bi-lock-fill me-1"></i> Hak Akses: Hanya Lihat (Read-Only)
            </span>
        </div>
    </div>
</div>

<!-- Kartu Statistik Monitoring -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm rounded-3 p-3 bg-white d-flex flex-row align-items-center gap-3">
            <div class="p-3 rounded-3 bg-success bg-opacity-10 text-success fs-3">
                <i class="bi bi-newspaper"></i>
            </div>
            <div>
                <h3 class="fw-bold mb-0 text-dark">{{ $totalPublishedNews }}</h3>
                <small class="text-muted fw-semibold">Berita Terbit (dari {{ $totalNews }})</small>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm rounded-3 p-3 bg-white d-flex flex-row align-items-center gap-3">
            <div class="p-3 rounded-3 bg-warning bg-opacity-10 text-warning fs-3">
                <i class="bi bi-megaphone"></i>
            </div>
            <div>
                <h3 class="fw-bold mb-0 text-dark">{{ $totalPublishedAnnouncements }}</h3>
                <small class="text-muted fw-semibold">Pengumuman Terbit</small>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm rounded-3 p-3 bg-white d-flex flex-row align-items-center gap-3">
            <div class="p-3 rounded-3 bg-primary bg-opacity-10 text-primary fs-3">
                <i class="bi bi-images"></i>
            </div>
            <div>
                <h3 class="fw-bold mb-0 text-dark">{{ $totalPhotos + $totalVideos }}</h3>
                <small class="text-muted fw-semibold">Total Galeri (Foto & Video)</small>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm rounded-3 p-3 bg-white d-flex flex-row align-items-center gap-3">
            <div class="p-3 rounded-3 bg-info bg-opacity-10 text-info fs-3">
                <i class="bi bi-bar-chart-line"></i>
            </div>
            <div>
                <h3 class="fw-bold mb-0 text-dark">{{ $totalPageViews }}</h3>
                <small class="text-muted fw-semibold">Total Kunjungan Halaman</small>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Daftar Konten yang Telah Dipublikasikan -->
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-3 bg-white h-100">
            <div class="card-header bg-white border-bottom py-3 d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="fw-bold mb-0"><i class="bi bi-check-circle-fill text-success me-2"></i> Konten yang Telah Dipublikasikan</h6>
                    <small class="text-muted">Daftar warta yang dapat dibaca masyarakat</small>
                </div>
                <a href="{{ route('kepaladesa.articles') }}" class="small text-primary text-decoration-none fw-semibold">
                    Lihat Semua <i class="bi bi-chevron-right"></i>
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light small">
                        <tr>
                            <th>Judul Informasi</th>
                            <th>Kategori</th>
                            <th>Pembaca</th>
                            <th class="text-end">Tinjau</th>
                        </tr>
                    </thead>
                    <tbody class="small">
                        @forelse($publishedArticles as $art)
                            <tr>
                                <td>
                                    <div class="fw-bold text-dark text-truncate" style="max-width: 250px;">{{ $art->title }}</div>
                                    <small class="text-muted"><i class="bi bi-clock me-1"></i> {{ $art->published_at ? $art->published_at->format('d/m/Y') : '-' }}</small>
                                </td>
                                <td>
                                    <span class="badge {{ $art->type === 'pengumuman' ? 'bg-warning text-dark' : 'bg-success' }}">
                                        {{ $art->category?->name ?? ucfirst($art->type) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        <i class="bi bi-eye me-1"></i> {{ $art->views_count }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('kepaladesa.articles.show', $art->id) }}" class="btn btn-sm btn-outline-primary" title="Lihat Pratinjau Lengkap">
                                        <i class="bi bi-search"></i> Lihat
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">Belum ada konten publikasi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Riwayat Aktivitas Admin (Pengawasan) -->
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm rounded-3 bg-white h-100">
            <div class="card-header bg-white border-bottom py-3 d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="fw-bold mb-0"><i class="bi bi-clock-history text-indigo me-2" style="color: #4f46e5;"></i> Riwayat Aktivitas Admin</h6>
                    <small class="text-muted">Pemantauan perubahan data oleh admin</small>
                </div>
                <a href="{{ route('kepaladesa.activities') }}" class="small text-primary text-decoration-none fw-semibold">
                    Semua Log <i class="bi bi-chevron-right"></i>
                </a>
            </div>
            <div class="card-body p-3">
                <div class="d-flex flex-column gap-3">
                    @forelse($recentActivities as $act)
                        <div class="d-flex gap-2 align-items-start border-bottom pb-2">
                            <span class="badge {{ $act->action === 'HAPUS' ? 'bg-danger' : ($act->action === 'EDIT' ? 'bg-primary' : 'bg-success') }} mt-1">
                                {{ $act->action }}
                            </span>
                            <div class="flex-grow-1">
                                <div class="small fw-semibold text-dark">{{ $act->description }}</div>
                                <small class="text-muted" style="font-size: 0.75rem;">
                                    Oleh: <strong>{{ $act->user_name }}</strong> &bull; {{ $act->created_at->diffForHumans() }}
                                </small>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted small text-center py-4 mb-0">Belum ada catatan aktivitas admin.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
