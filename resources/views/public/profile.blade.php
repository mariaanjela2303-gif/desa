@extends('layouts.public')

@section('title', 'Profil Desa Tautpah - Sejarah, Visi & Misi')

@section('content')
<!-- Header Banner -->
<section class="py-5 text-white" style="background: linear-gradient(135deg, #14532d, #15803d);">
    <div class="container py-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white text-decoration-none">Beranda</a></li>
                <li class="breadcrumb-item text-white-50 active" aria-current="page">Profil Desa</li>
            </ol>
        </nav>
        <h1 class="fw-bold mb-2">Profil Desa Tautpah</h1>
        <p class="lead text-white-50 mb-0">Mengenal sejarah, visi, misi, dan potensi wilayah Desa Tautpah, Timor Tengah Utara.</p>
    </div>
</section>

<div class="container py-5">
    <div class="row g-5">
        <div class="col-lg-8">
            <!-- Gambaran Umum -->
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 mb-5 bg-white">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="bg-success text-white p-3 rounded-3">
                        <i class="bi bi-info-circle-fill fs-4"></i>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-0">Gambaran Umum Wilayah</h3>
                        <small class="text-muted">Kecamatan Biboki Selatan, Kabupaten Timor Tengah Utara, NTT</small>
                    </div>
                </div>
                <div class="text-secondary lh-lg mb-4">
                    {!! nl2br(e($profile->about ?? 'Desa Tautpah merupakan salah satu desa di wilayah Kecamatan Biboki Selatan, Kabupaten Timor Tengah Utara, Provinsi Nusa Tenggara Timur. Masyarakat Desa Tautpah dikenal rukun, menjunjung tinggi adat istiadat, dan mengedepankan asas gotong royong dalam kehidupan bermasyarakat.')) !!}
                </div>

                <div class="row g-3 text-center pt-3 border-top">
                    <div class="col-sm-4">
                        <div class="p-3 bg-light rounded-3">
                            <span class="text-muted small d-block">Desa</span>
                            <strong class="text-dark">{{ $profile->village_name ?? 'Desa Tautpah' }}</strong>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="p-3 bg-light rounded-3">
                            <span class="text-muted small d-block">Kecamatan</span>
                            <strong class="text-dark">{{ $profile->district ?? 'Biboki Selatan' }}</strong>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="p-3 bg-light rounded-3">
                            <span class="text-muted small d-block">Kabupaten</span>
                            <strong class="text-dark">{{ $profile->regency ?? 'Timor Tengah Utara' }}</strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Visi & Misi -->
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 mb-5 bg-white">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="bg-success text-white p-3 rounded-3">
                        <i class="bi bi-compass-fill fs-4"></i>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-0">Visi & Misi Desa</h3>
                        <small class="text-muted">Arah pembangunan dan cita-cita luhur Desa Tautpah</small>
                    </div>
                </div>

                <div class="p-4 bg-success bg-opacity-10 rounded-4 border border-success border-opacity-25 mb-4">
                    <h5 class="fw-bold text-success mb-2"><i class="bi bi-eye-fill me-2"></i> Visi:</h5>
                    <p class="fs-5 fw-semibold text-dark mb-0 fst-italic">
                        "{{ $profile->vision ?? 'Terwujudnya Desa Tautpah yang Maju, Mandiri, Sejahtera, dan Berbudaya berbasis Gotong Royong.' }}"
                    </p>
                </div>

                <div>
                    <h5 class="fw-bold text-dark mb-3"><i class="bi bi-list-check text-success me-2"></i> Misi Pembangunan:</h5>
                    <div class="text-secondary lh-lg ps-2">
                        {!! nl2br(e($profile->mission ?? "1. Mewujudkan tata kelola pemerintahan desa yang bersih, transparan, akuntabel, dan responsif terhadap kebutuhan masyarakat.\n2. Meningkatkan pembangunan infrastruktur dasar desa dan fasilitas umum yang berkualitas.\n3. Mengembangkan potensi ekonomi desa melalui sektor pertanian, peternakan, dan usaha mikro lokal.\n4. Memperkuat kerukunan warga, pelestarian adat istiadat, dan nilai-nilai kearifan lokal Biboki Selatan.")) !!}
                    </div>
                </div>
            </div>

            <!-- Sejarah Desa -->
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="bg-success text-white p-3 rounded-3">
                        <i class="bi bi-clock-history fs-4"></i>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-0">Sejarah Singkat Desa</h3>
                        <small class="text-muted">Asal-usul dan jejak perkembangan Desa Tautpah</small>
                    </div>
                </div>

                <div class="text-secondary lh-lg">
                    {!! nl2br(e($profile->history ?? "Desa Tautpah memiliki sejarah dan kebudayaan yang mengakar kuat pada kearifan lokal masyarakat Timor Tengah Utara. Informasi sejarah lengkap desa akan diperbarui secara resmi melalui dokumen monografi desa oleh pemerintah desa.")) !!}
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Kartu Kepala Desa -->
            <div class="card border-0 shadow-sm rounded-4 p-4 text-center mb-4 bg-white sticky-top" style="top: 100px;">
                <div class="position-relative mx-auto mb-3" style="width: 140px; height: 140px;">
                    @if($profile->leader_photo)
                        <img src="{{ asset('storage/' . $profile->leader_photo) }}" class="rounded-circle w-100 h-100 object-fit-cover shadow" alt="{{ $profile->leader_name }}">
                    @else
                        <div class="rounded-circle w-100 h-100 bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center fs-1 shadow-sm">
                            <i class="bi bi-person-fill"></i>
                        </div>
                    @endif
                </div>
                <h5 class="fw-bold mb-1">{{ $profile->leader_name ?? 'Kepala Desa Tautpah' }}</h5>
                <span class="badge bg-success bg-opacity-10 text-success px-3 py-1 rounded-pill fw-semibold mb-3">
                    Kepala Desa Tautpah
                </span>
                <p class="small text-muted mb-4 fst-italic">
                    "{{ Str::limit($profile->welcome_message ?? 'Selamat datang di website resmi Desa Tautpah. Kami berkomitmen memberikan pelayanan terbaik bagi masyarakat.', 140) }}"
                </p>
                <div class="d-grid gap-2">
                    <a href="{{ route('public.officials') }}" class="btn btn-desa-primary btn-sm">
                        <i class="bi bi-people me-1"></i> Struktur Pemerintahan
                    </a>
                    <a href="{{ route('public.contact') }}" class="btn btn-desa-outline btn-sm">
                        <i class="bi bi-geo-alt me-1"></i> Hubungi Kantor Desa
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
