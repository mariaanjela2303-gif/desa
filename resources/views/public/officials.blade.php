@extends('layouts.public')

@section('title', 'Struktur Pemerintahan - Pemerintah Desa Tautpah')

@section('content')
<!-- Header Banner Modern & Aesthetic -->
<section class="py-5 text-white position-relative overflow-hidden" style="background: radial-gradient(circle at 10% 20%, rgba(16, 185, 129, 0.22) 0%, transparent 45%), radial-gradient(circle at 90% 80%, rgba(5, 150, 105, 0.25) 0%, transparent 50%), linear-gradient(135deg, #05231a 0%, #064e3b 60%, #083c2e 100%);">
    <div class="container py-4 position-relative" style="z-index: 1;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-emerald-200 text-decoration-none" style="color: #a7f3d0;">Beranda</a></li>
                <li class="breadcrumb-item text-white-50 active" aria-current="page">Pemerintahan</li>
            </ol>
        </nav>
        <span class="badge-pill-emerald mb-2" style="background: rgba(255, 255, 255, 0.12); color: #6ee7b7; border-color: rgba(255, 255, 255, 0.2);">
            <i class="bi bi-people"></i> Struktur Organisasi
        </span>
        <h1 class="fw-bold mb-2 text-white">Aparatur Pemerintah Desa Tautpah</h1>
        <p class="lead text-emerald-100 mb-0" style="color: #cbd5e1; font-size: 1.05rem;">Susunan kepengurusan dan perangkat desa yang bertugas melayani segenap warga masyarakat.</p>
    </div>
</section>

<div class="container py-5">
    <div class="text-center mb-5">
        <span class="badge bg-success bg-opacity-10 text-success fw-bold px-3 py-1 rounded-pill mb-2">Aparatur Desa</span>
        <h2 class="fw-bold">Pemerintah Desa Tautpah</h2>
        <p class="text-secondary col-md-8 mx-auto">
            Aparatur pemerintah desa yang berdedikasi melayani kepentingan warga masyarakat Desa Tautpah, Kecamatan Biboki Selatan, Kabupaten Timor Tengah Utara.
        </p>
    </div>

    <div class="row g-4 justify-content-center">
        @forelse($officials as $official)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card card-custom text-center h-100 p-4">
                    <div class="position-relative mx-auto mb-3" style="width: 130px; height: 130px;">
                        @if($official->photo)
                            <img src="{{ asset('storage/' . $official->photo) }}" class="rounded-circle w-100 h-100 object-fit-cover shadow-sm border border-3 border-success" alt="{{ $official->name }}">
                        @else
                            <div class="rounded-circle w-100 h-100 bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center fs-1 shadow-sm border border-3 border-success border-opacity-25">
                                <i class="bi bi-person-fill"></i>
                            </div>
                        @endif
                    </div>
                    <h5 class="fw-bold fs-6 mb-1 text-dark">{{ $official->name }}</h5>
                    <p class="text-success fw-semibold small mb-2">{{ $official->position }}</p>
                    <span class="badge bg-light text-muted border small mt-auto">
                        Aparatur Desa Tautpah
                    </span>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-people text-muted fs-1 d-block mb-3"></i>
                <p class="text-muted">Data perangkat desa belum ditambahkan atau sedang dalam pembaruan.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
