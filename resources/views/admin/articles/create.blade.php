@extends('layouts.admin')

@section('title', 'Tambah Berita / Pengumuman - Admin Desa Tautpah')
@section('page_title', 'Tambah Konten Baru')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card border-0 shadow-sm rounded-3 bg-white">
            <div class="card-header bg-white border-bottom py-3 d-flex align-items-center justify-content-between">
                <h6 class="fw-bold mb-0">Formulir Tambah Berita / Pengumuman</h6>
                <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label fw-semibold small">Judul Informasi <span class="text-danger">*</span></label>
                            <input type="text" name="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" placeholder="Contoh: Musyawarah Pembangunan Desa Tautpah" required>
                            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Jenis Informasi <span class="text-danger">*</span></label>
                            <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                                <option value="berita" {{ old('type') == 'berita' ? 'selected' : '' }}>Berita Desa</option>
                                <option value="pengumuman" {{ old('type') == 'pengumuman' ? 'selected' : '' }}>Pengumuman Warga</option>
                            </select>
                            @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Kategori Informasi</label>
                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Status Publikasi <span class="text-danger">*</span></label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="published" {{ old('status', 'published') == 'published' ? 'selected' : '' }}>Langsung Terbitkan (Published)</option>
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Simpan Sebagai Draf (Draft)</option>
                            </select>
                            @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold small">Foto / Gambar Sampul (Opsional, Maks. 2MB)</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/jpeg,image/png,image/jpg,image/webp">
                            <small class="text-muted">Format: JPG, PNG, WEBP. Maksimal ukuran file 2 MB.</small>
                            @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold small">Ringkasan Singkat (Opsional)</label>
                            <textarea name="summary" rows="2" class="form-control @error('summary') is-invalid @enderror" placeholder="Ringkasan singkat yang akan muncul di kartu cuplikan berita...">{{ old('summary') }}</textarea>
                            @error('summary') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold small">Isi Konten Lengkap <span class="text-danger">*</span></label>
                            <textarea name="content" rows="10" class="form-control @error('content') is-invalid @enderror" placeholder="Tuliskan berita atau informasi pengumuman secara rinci..." required>{{ old('content') }}</textarea>
                            @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                        <a href="{{ route('admin.articles.index') }}" class="btn btn-light border">Batal</a>
                        <button type="submit" class="btn btn-success-desa px-4">
                            <i class="bi bi-save me-1"></i> Simpan Konten
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
