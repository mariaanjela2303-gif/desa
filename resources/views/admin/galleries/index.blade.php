@extends('layouts.admin')

@section('title', 'Kelola Galeri - Admin Desa Tautpah')
@section('page_title', 'Kelola Galeri Foto & Video')

@section('content')
<div class="card border-0 shadow-sm rounded-3 bg-white mb-4">
    <div class="card-header bg-white border-bottom py-3 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <h6 class="fw-bold mb-0">Daftar Galeri Kegiatan Desa</h6>
            <small class="text-muted">Kelola foto kegiatan fisik dan video YouTube desa</small>
        </div>
        <button type="button" class="btn btn-success-desa btn-sm d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#createGalleryModal">
            <i class="bi bi-plus-circle"></i> Tambah Galeri Baru
        </button>
    </div>

    <!-- Filter Form -->
    <div class="card-body border-bottom bg-light py-2">
        <form action="{{ route('admin.galleries.index') }}" method="GET" class="d-flex gap-2 align-items-center">
            <select name="type" class="form-select form-select-sm" style="max-width: 200px;" onchange="this.form.submit()">
                <option value="">Semua Tipe Galeri</option>
                <option value="foto" {{ request('type') == 'foto' ? 'selected' : '' }}>Foto Kegiatan</option>
                <option value="video" {{ request('type') == 'video' ? 'selected' : '' }}>Video Dokumentasi</option>
            </select>
            @if(request('type'))
                <a href="{{ route('admin.galleries.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
            @endif
        </form>
    </div>

    <!-- Grid / Cards -->
    <div class="card-body p-4">
        <div class="row g-4">
            @forelse($galleries as $item)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 border rounded-3 overflow-hidden shadow-sm">
                        <div style="height: 160px; background-color: #f1f5f9; position: relative;">
                            @if($item->type === 'foto')
                                @if($item->file_path)
                                    <img src="{{ asset('storage/' . $item->file_path) }}" class="w-100 h-100 object-fit-cover" alt="{{ $item->title }}">
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                                        <i class="bi bi-image fs-1"></i>
                                    </div>
                                @endif
                                <span class="badge bg-success position-absolute top-0 start-0 m-2">Foto</span>
                            @else
                                <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-dark text-white">
                                    <i class="bi bi-play-circle fs-1 text-danger"></i>
                                </div>
                                <span class="badge bg-danger position-absolute top-0 start-0 m-2">Video</span>
                            @endif
                        </div>

                        <div class="card-body p-3 d-flex flex-column">
                            <h6 class="fw-bold small mb-1">{{ Str::limit($item->title, 45) }}</h6>
                            <p class="text-secondary small mb-3 flex-grow-1" style="font-size: 0.8rem;">
                                {{ Str::limit($item->caption, 60) }}
                            </p>
                            @if($item->type === 'video' && $item->video_url)
                                <a href="{{ $item->video_url }}" target="_blank" class="small text-danger text-decoration-none fw-semibold mb-2">
                                    <i class="bi bi-youtube me-1"></i> Buka Tautan Video
                                </a>
                            @endif

                            <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                                <small class="text-muted" style="font-size: 0.72rem;">{{ $item->created_at->format('d/m/Y') }}</small>
                                <div class="d-flex gap-1">
                                    <button type="button" class="btn btn-sm btn-outline-primary p-1 px-2" data-bs-toggle="modal" data-bs-target="#editGalleryModal{{ $item->id }}" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form action="{{ route('admin.galleries.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus item galeri ini?');" class="d-inline m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger p-1 px-2" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Edit Galeri -->
                <div class="modal fade" id="editGalleryModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content text-start">
                            <form action="{{ route('admin.galleries.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h6 class="modal-title fw-bold">Edit Galeri: {{ $item->title }}</h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold small">Judul Dokumentasi <span class="text-danger">*</span></label>
                                        <input type="text" name="title" value="{{ $item->title }}" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold small">Tipe Galeri <span class="text-danger">*</span></label>
                                        <select name="type" class="form-select edit-type-select" required>
                                            <option value="foto" {{ $item->type === 'foto' ? 'selected' : '' }}>Foto Kegiatan</option>
                                            <option value="video" {{ $item->type === 'video' ? 'selected' : '' }}>Video YouTube</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold small">Unggah Foto Baru (Jika Tipe Foto)</label>
                                        <input type="file" name="file_path" class="form-control" accept="image/*">
                                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto saat ini.</small>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold small">Tautan Video YouTube (Jika Tipe Video)</label>
                                        <input type="url" name="video_url" value="{{ $item->video_url }}" class="form-control" placeholder="https://www.youtube.com/watch?v=...">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold small">Keterangan / Kepsyen</label>
                                        <textarea name="caption" rows="2" class="form-control">{{ $item->caption }}</textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light border btn-sm" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-success-desa btn-sm">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5 text-muted">
                    <i class="bi bi-images fs-1 d-block mb-2"></i> Belum ada foto atau video dalam galeri.
                </div>
            @endforelse
        </div>
    </div>

    @if($galleries->hasPages())
        <div class="card-footer bg-white py-3">
            {{ $galleries->links() }}
        </div>
    @endif
</div>

<!-- Modal Tambah Galeri Baru -->
<div class="modal fade" id="createGalleryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h6 class="modal-title fw-bold">Tambah Galeri Kegiatan Baru</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Judul Kegiatan <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" placeholder="Contoh: Musyawarah Dusun II Tautpah" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Jenis Galeri <span class="text-danger">*</span></label>
                        <select name="type" id="createGalleryType" class="form-select" required>
                            <option value="foto">Foto Kegiatan</option>
                            <option value="video">Video YouTube</option>
                        </select>
                    </div>
                    <div class="mb-3" id="photoInputGroup">
                        <label class="form-label fw-semibold small">File Foto (Maks. 3MB) <span class="text-danger">*</span></label>
                        <input type="file" name="file_path" class="form-control" accept="image/*">
                    </div>
                    <div class="mb-3 d-none" id="videoInputGroup">
                        <label class="form-label fw-semibold small">URL Video YouTube <span class="text-danger">*</span></label>
                        <input type="url" name="video_url" class="form-control" placeholder="https://www.youtube.com/watch?v=...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Keterangan / Caption</label>
                        <textarea name="caption" rows="2" class="form-control" placeholder="Tuliskan keterangan singkat mengenai kegiatan..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light border btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success-desa btn-sm">Simpan Galeri</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const galleryType = document.getElementById('createGalleryType');
    const photoGroup = document.getElementById('photoInputGroup');
    const videoGroup = document.getElementById('videoInputGroup');

    galleryType.addEventListener('change', function() {
        if (this.value === 'foto') {
            photoGroup.classList.remove('d-none');
            videoGroup.classList.add('d-none');
        } else {
            photoGroup.classList.add('d-none');
            videoGroup.classList.remove('d-none');
        }
    });
</script>
@endpush
@endsection
