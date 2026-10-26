@extends('layouts.admin')

@section('title', 'Dashboard Administrator - Desa Tautpah')
@section('page_title', 'Ringkasan Dashboard Admin')

@section('content')
<!-- Kartu Statistik Utama -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card-stat d-flex align-items-center gap-3">
            <div class="stat-icon bg-success bg-opacity-10 text-success">
                <i class="bi bi-newspaper"></i>
            </div>
            <div>
                <h4 class="fw-bold mb-0">{{ $totalNews }}</h4>
                <small class="text-muted fw-semibold">Berita Desa</small>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card-stat d-flex align-items-center gap-3">
            <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                <i class="bi bi-megaphone"></i>
            </div>
            <div>
                <h4 class="fw-bold mb-0">{{ $totalAnnouncements }}</h4>
                <small class="text-muted fw-semibold">Pengumuman</small>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card-stat d-flex align-items-center gap-3">
            <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                <i class="bi bi-images"></i>
            </div>
            <div>
                <h4 class="fw-bold mb-0">{{ $totalPhotos + $totalVideos }}</h4>
                <small class="text-muted fw-semibold">Galeri (Foto & Video)</small>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card-stat d-flex align-items-center gap-3">
            <div class="stat-icon bg-info bg-opacity-10 text-info">
                <i class="bi bi-eye"></i>
            </div>
            <div>
                <h4 class="fw-bold mb-0">{{ $totalPageViews }}</h4>
                <small class="text-muted fw-semibold">Total Kunjungan Web</small>
            </div>
        </div>
    </div>
</div>

<!-- Aksi Cepat -->
<div class="card border-0 shadow-sm rounded-3 p-4 mb-4 bg-white">
    <h6 class="fw-bold text-dark mb-3"><i class="bi bi-lightning-charge-fill text-warning me-1"></i> Aksi Cepat Pengelolaan:</h6>
    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('admin.articles.create') }}" class="btn btn-success-desa btn-sm d-flex align-items-center gap-2">
            <i class="bi bi-plus-circle"></i> Tambah Berita / Pengumuman
        </a>
        <a href="{{ route('admin.galleries.index') }}" class="btn btn-outline-success btn-sm d-flex align-items-center gap-2">
            <i class="bi bi-cloud-arrow-up"></i> Upload Galeri
        </a>
        <a href="{{ route('admin.profile.edit') }}" class="btn btn-outline-secondary btn-sm d-flex align-items-center gap-2">
            <i class="bi bi-building"></i> Edit Profil & Visi Misi
        </a>
        <a href="{{ route('admin.officials.index') }}" class="btn btn-outline-secondary btn-sm d-flex align-items-center gap-2">
            <i class="bi bi-people"></i> Struktur Perangkat Desa
        </a>
        <a href="{{ route('admin.contact.edit') }}" class="btn btn-outline-secondary btn-sm d-flex align-items-center gap-2">
            <i class="bi bi-geo-alt"></i> Kontak & Peta
        </a>
    </div>
</div>

<div class="row g-4">
    <!-- Konten Terbaru yang Dikelola -->
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-3 bg-white h-100">
            <div class="card-header bg-white border-bottom py-3 d-flex align-items-center justify-content-between">
                <h6 class="fw-bold mb-0"><i class="bi bi-newspaper text-success me-2"></i> Konten Terbaru</h6>
                <a href="{{ route('admin.articles.index') }}" class="small text-success text-decoration-none fw-semibold">
                    Lihat Semua <i class="bi bi-chevron-right"></i>
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light small">
                            <tr>
                                <th>Judul</th>
                                <th>Jenis</th>
                                <th>Status</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="small">
                            @forelse($recentArticles as $art)
                                <tr>
                                    <td>
                                        <div class="fw-bold text-dark text-truncate" style="max-width: 260px;">{{ $art->title }}</div>
                                        <small class="text-muted">{{ $art->category?->name ?? 'Tanpa Kategori' }} &bull; {{ $art->created_at->format('d/m/Y') }}</small>
                                    </td>
                                    <td>
                                        <span class="badge {{ $art->type === 'pengumuman' ? 'bg-warning text-dark' : 'bg-success' }}">
                                            {{ ucfirst($art->type) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $art->status === 'published' ? 'bg-success bg-opacity-10 text-success' : 'bg-secondary' }}">
                                            {{ $art->status === 'published' ? 'Terbit' : 'Draft' }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.articles.edit', $art->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">Belum ada konten artikel.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Riwayat Aktivitas Admin Terbaru -->
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm rounded-3 bg-white h-100">
            <div class="card-header bg-white border-bottom py-3 d-flex align-items-center justify-content-between">
                <h6 class="fw-bold mb-0"><i class="bi bi-clock-history text-success me-2"></i> Riwayat Aktivitas Terbaru</h6>
                <a href="{{ route('admin.activity_logs.index') }}" class="small text-success text-decoration-none fw-semibold">
                    Semua Log <i class="bi bi-chevron-right"></i>
                </a>
            </div>
            <div class="card-body p-3">
                <div class="d-flex flex-column gap-3">
                    @forelse($recentActivities as $act)
                        <div class="d-flex gap-3 align-items-start border-bottom pb-2">
                            <span class="badge {{ $act->action === 'HAPUS' ? 'bg-danger' : ($act->action === 'EDIT' ? 'bg-primary' : 'bg-success') }} mt-1">
                                {{ $act->action }}
                            </span>
                            <div class="flex-grow-1">
                                <div class="small fw-semibold text-dark">{{ $act->description }}</div>
                                <small class="text-muted" style="font-size: 0.75rem;">
                                    {{ $act->user_name }} &bull; {{ $act->created_at->diffForHumans() }}
                                </small>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted small text-center py-4 mb-0">Belum ada catatan aktivitas.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
