@extends('layouts.kepala_desa')

@section('title', 'Statistik Kunjungan Website - Kepala Desa Tautpah')
@section('page_title', 'Statistik Kunjungan Halaman Website')

@section('content')
<!-- Ringkasan Total Kunjungan -->
<div class="row g-3 mb-4">
    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white d-flex flex-row align-items-center gap-3">
            <div class="p-3 rounded-3 bg-info bg-opacity-10 text-info fs-2">
                <i class="bi bi-eye-fill"></i>
            </div>
            <div>
                <h2 class="fw-bold mb-0 text-dark">{{ $totalViews }}</h2>
                <span class="text-muted small fw-semibold">Total Hit / Tayangan Halaman</span>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-light border">
            <div class="d-flex align-items-start gap-3">
                <i class="bi bi-info-circle-fill text-info fs-4"></i>
                <div class="small text-secondary">
                    <strong class="text-dark d-block mb-1">Catatan Statistik Sederhana Versi 1.0:</strong>
                    Sesuai dokumen PRD, statistik kunjungan website versi pertama bersifat pencatatan hit pembacaan halaman secara keseluruhan (page views sederhana) dan bukan kalkulasi pengunjung unik harian yang rumit.
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Halaman Terpopuler -->
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm rounded-3 bg-white h-100">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="fw-bold mb-0"><i class="bi bi-trophy-fill text-warning me-2"></i> Halaman Paling Sering Dibuka</h6>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light small">
                        <tr>
                            <th>Halaman</th>
                            <th class="text-end">Jumlah Kunjungan</th>
                        </tr>
                    </thead>
                    <tbody class="small">
                        @forelse($popularPages as $pop)
                            <tr>
                                <td>
                                    <div class="fw-bold text-dark text-truncate" style="max-width: 220px;">
                                        {{ $pop->page_title ?? 'Beranda Desa' }}
                                    </div>
                                    <small class="text-muted text-truncate d-block" style="max-width: 220px;">
                                        {{ $pop->page_url }}
                                    </small>
                                </td>
                                <td class="text-end">
                                    <span class="badge bg-success bg-opacity-10 text-success fw-bold px-3 py-2">
                                        {{ $pop->total }} kali
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center py-4 text-muted">Belum ada data kunjungan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Riwayat Kunjungan Terbaru -->
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-3 bg-white h-100">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="fw-bold mb-0"><i class="bi bi-clock-history text-primary me-2"></i> Catatan Kunjungan Terbaru</h6>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light small">
                        <tr>
                            <th>Halaman yang Dibuka</th>
                            <th>IP Pengunjung</th>
                            <th>Waktu Kunjungan</th>
                        </tr>
                    </thead>
                    <tbody class="small">
                        @forelse($recentViews as $view)
                            <tr>
                                <td>
                                    <div class="fw-semibold text-dark text-truncate" style="max-width: 240px;">
                                        {{ $view->page_title ?? 'Halaman Publik' }}
                                    </div>
                                    <small class="text-muted text-truncate d-block" style="max-width: 240px;">
                                        {{ $view->page_url }}
                                    </small>
                                </td>
                                <td><code>{{ $view->ip_address ?? '127.0.0.1' }}</code></td>
                                <td>
                                    <div>{{ \Carbon\Carbon::parse($view->visited_at)->format('d/m/Y H:i') }}</div>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($view->visited_at)->diffForHumans() }}</small>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-4 text-muted">Belum ada riwayat kunjungan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($recentViews->hasPages())
                <div class="card-footer bg-white py-2">
                    {{ $recentViews->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
