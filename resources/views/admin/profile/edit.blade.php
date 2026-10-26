@extends('layouts.admin')

@section('title', 'Kelola Profil & Sejarah Desa - Admin Desa Tautpah')
@section('page_title', 'Kelola Profil, Sejarah, Visi & Misi Desa')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card border-0 shadow-sm rounded-3 bg-white">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="fw-bold mb-0">Informasi Pokok Desa Tautpah</h6>
                <small class="text-muted">Perbarui data profil umum, naskah sejarah resmi, visi misi, dan sambutan kepala desa</small>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <h6 class="fw-bold text-success mb-3 pb-2 border-bottom">1. Data Wilayah Administrasi</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Nama Desa <span class="text-danger">*</span></label>
                            <input type="text" name="village_name" value="{{ old('village_name', $profile->village_name) }}" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Kecamatan <span class="text-danger">*</span></label>
                            <input type="text" name="district" value="{{ old('district', $profile->district) }}" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Kabupaten <span class="text-danger">*</span></label>
                            <input type="text" name="regency" value="{{ old('regency', $profile->regency) }}" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Provinsi <span class="text-danger">*</span></label>
                            <input type="text" name="province" value="{{ old('province', $profile->province) }}" class="form-control" required>
                        </div>
                    </div>

                    <h6 class="fw-bold text-success mb-3 pb-2 border-bottom">2. Gambaran Umum & Sejarah Desa</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-12">
                            <label class="form-label fw-semibold small">Gambaran Umum Desa</label>
                            <textarea name="about" rows="4" class="form-control" placeholder="Deskripsi mengenai wilayah, kebudayaan, dan potensi Desa Tautpah...">{{ old('about', $profile->about) }}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold small">Sejarah Singkat Desa</label>
                            <textarea name="history" rows="6" class="form-control" placeholder="Naskah sejarah pembentukan atau asal-usul Desa Tautpah...">{{ old('history', $profile->history) }}</textarea>
                            <small class="text-muted">Dapat diganti dengan data resmi yang telah diverifikasi oleh pemerintah desa.</small>
                        </div>
                    </div>

                    <h6 class="fw-bold text-success mb-3 pb-2 border-bottom">3. Visi & Misi Pembangunan</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-12">
                            <label class="form-label fw-semibold small">Visi Desa</label>
                            <textarea name="vision" rows="2" class="form-control" placeholder="Visi pembangunan desa...">{{ old('vision', $profile->vision) }}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold small">Misi Desa</label>
                            <textarea name="mission" rows="5" class="form-control" placeholder="1. Poin misi pertama&#10;2. Poin misi kedua...">{{ old('mission', $profile->mission) }}</textarea>
                        </div>
                    </div>

                    <h6 class="fw-bold text-success mb-3 pb-2 border-bottom">4. Sambutan & Identitas Kepala Desa</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Nama Lengkap Kepala Desa</label>
                            <input type="text" name="leader_name" value="{{ old('leader_name', $profile->leader_name) }}" class="form-control" placeholder="Nama Kepala Desa">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Foto Kepala Desa (Opsional, Maks. 2MB)</label>
                            @if($profile->leader_photo)
                                <div class="mb-2 d-flex align-items-center gap-2">
                                    <img src="{{ asset('storage/' . $profile->leader_photo) }}" class="rounded-circle object-fit-cover" width="45" height="45" alt="Foto Kades">
                                    <small class="text-muted">Foto saat ini</small>
                                </div>
                            @endif
                            <input type="file" name="leader_photo" class="form-control" accept="image/*">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold small">Sambutan Kepala Desa</label>
                            <textarea name="welcome_message" rows="4" class="form-control" placeholder="Kata sambutan kepala desa untuk masyarakat dan pengunjung website...">{{ old('welcome_message', $profile->welcome_message) }}</textarea>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                        <button type="submit" class="btn btn-success-desa px-4">
                            <i class="bi bi-save me-1"></i> Simpan Pembaruan Profil
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
