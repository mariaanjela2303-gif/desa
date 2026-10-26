@extends('layouts.admin')

@section('title', 'Kelola Kontak & Peta - Admin Desa Tautpah')
@section('page_title', 'Kelola Kontak, Jam Pelayanan & Peta Kantor')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card border-0 shadow-sm rounded-3 bg-white">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="fw-bold mb-0">Informasi Kontak & Jam Kerja Kantor Desa</h6>
                <small class="text-muted">Data ini akan ditampilkan di halaman kontak publik serta footer website</small>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('admin.contact.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold small">Alamat Lengkap Kantor Desa <span class="text-danger">*</span></label>
                            <textarea name="address" rows="3" class="form-control" placeholder="Contoh: Kantor Desa Tautpah, Kec. Biboki Selatan, Kab. Timor Tengah Utara, NTT" required>{{ old('address', $contact->address) }}</textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Nomor Telepon / Handphone Kantor</label>
                            <input type="text" name="phone" value="{{ old('phone', $contact->phone) }}" class="form-control" placeholder="Contoh: 0812-3456-7890">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Alamat Email Kantor</label>
                            <input type="email" name="email" value="{{ old('email', $contact->email) }}" class="form-control" placeholder="Contoh: kantor@tautpah.desa.id">
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold small">Jam Pelayanan Masyarakat</label>
                            <input type="text" name="service_hours" value="{{ old('service_hours', $contact->service_hours) }}" class="form-control" placeholder="Contoh: Senin - Jumat: 08.00 - 15.00 WITA">
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold small">URL Embed Google Maps</label>
                            <textarea name="maps_embed_url" rows="3" class="form-control" placeholder="https://www.google.com/maps/embed?pb=...">{{ old('maps_embed_url', $contact->maps_embed_url) }}</textarea>
                            <small class="text-muted">
                                Panduan: Buka Google Maps &rarr; Cari Kantor Desa &rarr; Klik Bagikan &rarr; Sematkan Peta (Embed a map) &rarr; Salin nilai URL pada atribut <code>src="..."</code>.
                            </small>
                        </div>
                    </div>

                    @if($contact->maps_embed_url)
                        <div class="mt-4 pt-3 border-top">
                            <h6 class="fw-bold small text-muted mb-2">Pratinjau Peta Saat Ini:</h6>
                            <div class="ratio ratio-21x9 rounded-3 overflow-hidden border">
                                <iframe src="{{ $contact->maps_embed_url }}" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                            </div>
                        </div>
                    @endif

                    <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-success-desa px-4">
                            <i class="bi bi-save me-1"></i> Simpan Kontak & Pelayanan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
