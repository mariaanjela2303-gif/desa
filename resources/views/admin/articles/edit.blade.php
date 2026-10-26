@extends('layouts.admin')

@section('title', 'Edit ' . ucfirst($article->type) . ' - Admin Desa Tautpah')
@section('page_title', 'Edit Konten')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card border-0 shadow-sm rounded-3 bg-white">
            <div class="card-header bg-white border-bottom py-3 d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="fw-bold mb-0">Edit {{ ucfirst($article->type) }}: {{ $article->title }}</h6>
                    <small class="text-muted">Perbarui data atau foto publikasi</small>
                </div>
                <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label fw-semibold small">Judul Informasi <span class="text-danger">*</span></label>
                            <input type="text" name="title" value="{{ old('title', $article->title) }}" class="form-control @error('title') is-invalid @enderror" required>
                            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Jenis Informasi <span class="text-danger">*</span></label>
                            <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                                <option value="berita" {{ old('type', $article->type) == 'berita' ? 'selected' : '' }}>Berita Desa</option>
                                <option value="pengumuman" {{ old('type', $article->type) == 'pengumuman' ? 'selected' : '' }}>Pengumuman Warga</option>
                            </select>
                            @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Kategori Informasi</label>
                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id', $article->category_id) == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Status Publikasi <span class="text-danger">*</span></label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="published" {{ old('status', $article->status) == 'published' ? 'selected' : '' }}>Terbitkan (Published)</option>
                                <option value="draft" {{ old('status', $article->status) == 'draft' ? 'selected' : '' }}>Simpan Sebagai Draf (Draft)</option>
                            </select>
                            @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold small">Foto / Gambar Sampul (Opsional)</label>
                            @if($article->image)
                                <div class="mb-2 d-flex align-items-center gap-3 p-2 bg-light rounded border">
                                    <img src="{{ asset('storage/' . $article->image) }}" class="rounded object-fit-cover" width="80" height="60" alt="{{ $article->title }}">
                                    <small class="text-muted">Gambar saat ini. Unggah file baru untuk menggantinya.</small>
                                </div>
                            @endif
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/jpeg,image/png,image/jpg,image/webp">
                            <small class="text-muted">Format: JPG, PNG, WEBP. Maksimal 2 MB.</small>
                            @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold small">Ringkasan Singkat</label>
                            <textarea name="summary" rows="2" class="form-control @error('summary') is-invalid @enderror">{{ old('summary', $article->summary) }}</textarea>
                            @error('summary') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold small">Isi Konten Lengkap <span class="text-danger">*</span></label>
                            <textarea name="content" rows="10" class="form-control @error('content') is-invalid @enderror" required>{{ old('content', $article->content) }}</textarea>
                            @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                        <a href="{{ route('admin.articles.index') }}" class="btn btn-light border">Batal</a>
                        <button type="submit" class="btn btn-success-desa px-4">
                            <i class="bi bi-check-circle me-1"></i> Perbarui Konten
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
