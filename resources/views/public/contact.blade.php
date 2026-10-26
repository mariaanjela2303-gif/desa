@extends('layouts.public')

@section('title', 'Kontak & Lokasi Pelayanan - Desa Tautpah')

@section('content')
<!-- Header Banner -->
<section class="py-5 text-white" style="background: linear-gradient(135deg, #14532d, #15803d);">
    <div class="container py-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white text-decoration-none">Beranda</a></li>
                <li class="breadcrumb-item text-white-50 active" aria-current="page">Kontak</li>
            </ol>
        </nav>
        <h1 class="fw-bold mb-2">Kontak & Pelayanan Kantor Desa</h1>
        <p class="lead text-white-50 mb-0">Informasi alamat, jam pelayanan resmi, dan lokasi kantor pemerintah Desa Tautpah.</p>
    </div>
</section>

<div class="container py-5">
    <div class="row g-5">
        <!-- Informasi Detail Kontak -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white h-100">
                <h4 class="fw-bold text-dark mb-4">Informasi Kantor</h4>

                <div class="d-flex align-items-start gap-3 mb-4">
                    <div class="bg-success bg-opacity-10 text-success rounded-3 p-3 flex-shrink-0">
                        <i class="bi bi-geo-alt-fill fs-4"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Alamat Kantor Desa</h6>
                        <p class="text-secondary small mb-0 lh-base">
                            {{ $contact->address ?? 'Kantor Desa Tautpah, Kecamatan Biboki Selatan, Kabupaten Timor Tengah Utara, Nusa Tenggara Timur.' }}
                        </p>
                    </div>
                </div>

                <div class="d-flex align-items-start gap-3 mb-4">
                    <div class="bg-success bg-opacity-10 text-success rounded-3 p-3 flex-shrink-0">
                        <i class="bi bi-clock-fill fs-4"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Jam Pelayanan Masyarakat</h6>
                        <p class="text-secondary small mb-0 lh-base">
                            {{ $contact->service_hours ?? 'Senin - Jumat: 08.00 - 15.00 WITA' }}
                        </p>
                        <small class="text-muted d-block mt-1">Sabtu, Minggu & Hari Libur Nasional tutup.</small>
                    </div>
                </div>

                <div class="d-flex align-items-start gap-3 mb-4">
                    <div class="bg-success bg-opacity-10 text-success rounded-3 p-3 flex-shrink-0">
                        <i class="bi bi-telephone-fill fs-4"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Telepon / Kontak</h6>
                        <p class="text-secondary small mb-0">
                            {{ $contact->phone ?? '0812-XXXX-XXXX' }}
                        </p>
                    </div>
                </div>

                <div class="d-flex align-items-start gap-3 mb-4">
                    <div class="bg-success bg-opacity-10 text-success rounded-3 p-3 flex-shrink-0">
                        <i class="bi bi-envelope-fill fs-4"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Alamat Email Resmi</h6>
                        <p class="text-secondary small mb-0">
                            {{ $contact->email ?? 'kantor@tautpah.desa.id' }}
                        </p>
                    </div>
                </div>

                <div class="p-3 bg-light rounded-3 border-start border-4 border-success mt-auto">
                    <small class="text-muted d-block">
                        <i class="bi bi-info-circle-fill text-success me-1"></i>
                        Warga yang membutuhkan layanan surat pengantar atau administrasi disarankan membawa kartu identitas (KTP/KK).
                    </small>
                </div>
            </div>
        </div>

        <!-- Peta Interaktif -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white h-100">
                <div class="p-4 bg-light border-bottom d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="fw-bold mb-0">Peta Lokasi Kantor Desa</h5>
                        <small class="text-muted">Kecamatan Biboki Selatan, Timor Tengah Utara</small>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-semibold">
                        <i class="bi bi-pin-map-fill me-1"></i> Google Maps
                    </span>
                </div>
                <div class="p-0 position-relative" style="min-height: 480px; height: 100%;">
                    @if($contact->maps_embed_url)
                        <iframe src="{{ $contact->maps_embed_url }}" width="100%" height="100%" style="border:0; min-height: 480px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    @else
                        <div class="p-5 text-center text-muted bg-light d-flex flex-column align-items-center justify-content-center" style="min-height: 480px;">
                            <i class="bi bi-map fs-1 text-secondary mb-3"></i>
                            <h5 class="fw-bold">Peta Lokasi Belum Disetel</h5>
                            <p class="text-secondary small col-md-8">
                                URL Google Maps embed dapat ditambahkan atau diperbarui melalui dashboard admin desa.
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
