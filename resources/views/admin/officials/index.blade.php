@extends('layouts.admin')

@section('title', 'Struktur Pemerintahan - Admin Desa Tautpah')
@section('page_title', 'Kelola Struktur Pemerintahan & Perangkat Desa')

@section('content')
<div class="card border-0 shadow-sm rounded-3 bg-white">
    <div class="card-header bg-white border-bottom py-3 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <h6 class="fw-bold mb-0">Daftar Aparatur & Perangkat Desa</h6>
            <small class="text-muted">Kelola susunan perangkat desa yang tampil di halaman publik</small>
        </div>
        <button type="button" class="btn btn-success-desa btn-sm d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#createOfficialModal">
            <i class="bi bi-person-plus"></i> Tambah Perangkat Desa
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light small">
                <tr>
                    <th style="width: 60px;">Urutan</th>
                    <th>Foto</th>
                    <th>Nama Lengkap</th>
                    <th>Jabatan</th>
                    <th>Status</th>
                    <th class="text-end" style="width: 140px;">Aksi</th>
                </tr>
            </thead>
            <tbody class="small">
                @forelse($officials as $item)
                    <tr>
                        <td class="fw-bold text-center">{{ $item->order }}</td>
                        <td>
                            <div style="width: 45px; height: 45px; border-radius: 50%; background-color: #f1f5f9; overflow: hidden;">
                                @if($item->photo)
                                    <img src="{{ asset('storage/' . $item->photo) }}" class="w-100 h-100 object-fit-cover" alt="{{ $item->name }}">
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                                        <i class="bi bi-person"></i>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td class="fw-bold text-dark">{{ $item->name }}</td>
                        <td><span class="text-success fw-semibold">{{ $item->position }}</span></td>
                        <td>
                            <span class="badge {{ $item->status === 'active' ? 'bg-success bg-opacity-10 text-success' : 'bg-secondary' }}">
                                {{ $item->status === 'active' ? 'Aktif' : 'Non-Aktif' }}
                            </span>
                        </td>
                        <td class="text-end">
                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editOfficialModal{{ $item->id }}" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <form action="{{ route('admin.officials.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data perangkat ini?');" class="d-inline m-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>

                            <!-- Modal Edit Perangkat -->
                            <div class="modal fade" id="editOfficialModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content text-start">
                                        <form action="{{ route('admin.officials.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h6 class="modal-title fw-bold">Edit Perangkat Desa</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold small">Nama Lengkap <span class="text-danger">*</span></label>
                                                    <input type="text" name="name" value="{{ $item->name }}" class="form-control" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold small">Jabatan <span class="text-danger">*</span></label>
                                                    <input type="text" name="position" value="{{ $item->position }}" class="form-control" placeholder="Contoh: Sekretaris Desa" required>
                                                </div>
                                                <div class="row g-2 mb-3">
                                                    <div class="col-6">
                                                        <label class="form-label fw-semibold small">Nomor Urutan Tampil</label>
                                                        <input type="number" name="order" value="{{ $item->order }}" class="form-control" min="0">
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label fw-semibold small">Status</label>
                                                        <select name="status" class="form-select">
                                                            <option value="active" {{ $item->status === 'active' ? 'selected' : '' }}>Aktif</option>
                                                            <option value="inactive" {{ $item->status === 'inactive' ? 'selected' : '' }}>Non-Aktif</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold small">Ganti Foto (Opsional)</label>
                                                    <input type="file" name="photo" class="form-control" accept="image/*">
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
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Belum ada perangkat desa yang ditambahkan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Perangkat Desa Baru -->
<div class="modal fade" id="createOfficialModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('admin.officials.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h6 class="modal-title fw-bold">Tambah Perangkat Desa Baru</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="Nama lengkap beserta gelar (jika ada)" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Jabatan <span class="text-danger">*</span></label>
                        <input type="text" name="position" class="form-control" placeholder="Contoh: Kepala Seksi Pemerintahan" required>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold small">Nomor Urutan Tampil</label>
                            <input type="number" name="order" value="{{ count($officials) + 1 }}" class="form-control" min="0">
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold small">Status</label>
                            <select name="status" class="form-select">
                                <option value="active">Aktif</option>
                                <option value="inactive">Non-Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Foto Formal (Maks. 2MB)</label>
                        <input type="file" name="photo" class="form-control" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light border btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success-desa btn-sm">Simpan Perangkat</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
