@extends('layouts.admin')

@section('title', 'Kelola Berita & Pengumuman - Admin Desa Tautpah')
@section('page_title', 'Kelola Berita & Pengumuman')

@section('content')
<div class="card border-0 shadow-sm rounded-3 bg-white">
    <div class="card-header bg-white border-bottom py-3 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <h6 class="fw-bold mb-0">Daftar Berita & Pengumuman Desa</h6>
            <small class="text-muted">Kelola seluruh publikasi informasi untuk warga</small>
        </div>
        <a href="{{ route('admin.articles.create') }}" class="btn btn-success-desa btn-sm d-flex align-items-center gap-2">
            <i class="bi bi-plus-circle"></i> Tambah Konten Baru
        </a>
    </div>

    <!-- Filter Form -->
    <div class="card-body border-bottom bg-light py-3">
        <form action="{{ route('admin.articles.index') }}" method="GET" class="row g-2 align-items-center">
            <div class="col-md-4">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Cari judul artikel...">
            </div>
            <div class="col-md-3">
                <select name="type" class="form-select form-select-sm">
                    <option value="">Semua Jenis</option>
                    <option value="berita" {{ request('type') == 'berita' ? 'selected' : '' }}>Berita</option>
                    <option value="pengumuman" {{ request('type') == 'pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="category_id" class="form-select form-select-sm">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-sm btn-dark w-100">Filter</button>
                @if(request()->anyFilled(['search', 'type', 'category_id', 'status']))
                    <a href="{{ route('admin.articles.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
                @endif
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light small">
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Gambar</th>
                    <th>Judul & Ringkasan</th>
                    <th>Jenis & Kategori</th>
                    <th>Status</th>
                    <th>Penulis & Tanggal</th>
                    <th class="text-end" style="width: 140px;">Aksi</th>
                </tr>
            </thead>
            <tbody class="small">
                @forelse($articles as $index => $item)
                    <tr>
                        <td>{{ $articles->firstItem() + $index }}</td>
                        <td>
                            <div style="width: 60px; height: 50px; background-color: #f1f5f9; border-radius: 6px; overflow: hidden;">
                                @if($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" class="w-100 h-100 object-fit-cover" alt="{{ $item->title }}">
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                                        <i class="bi bi-image"></i>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="fw-bold text-dark mb-1">{{ $item->title }}</div>
                            <div class="text-secondary small text-truncate" style="max-width: 320px;">
                                {{ Str::limit(strip_tags($item->summary ?? $item->content), 80) }}
                            </div>
                        </td>
                        <td>
                            <span class="badge {{ $item->type === 'pengumuman' ? 'bg-warning text-dark' : 'bg-success' }} mb-1 d-inline-block">
                                {{ ucfirst($item->type) }}
                            </span>
                            <div class="text-muted small">{{ $item->category?->name ?? '-' }}</div>
                        </td>
                        <td>
                            <span class="badge {{ $item->status === 'published' ? 'bg-success bg-opacity-10 text-success' : 'bg-secondary' }}">
                                {{ $item->status === 'published' ? 'Terbit' : 'Draft' }}
                            </span>
                            <div class="text-muted small mt-1"><i class="bi bi-eye"></i> {{ $item->views_count }} tayang</div>
                        </td>
                        <td>
                            <div class="text-dark fw-semibold">{{ $item->user?->name ?? 'Admin' }}</div>
                            <small class="text-muted">{{ $item->created_at->format('d/m/Y H:i') }}</small>
                        </td>
                        <td class="text-end">
                            <div class="d-inline-flex gap-1">
                                <a href="{{ route('public.articles.detail', $item->slug) }}" target="_blank" class="btn btn-sm btn-outline-secondary" title="Lihat di Web">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.articles.edit', $item->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.articles.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus konten ini?');" class="d-inline m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-2 d-block mb-2"></i> Belum ada artikel atau pengumuman yang sesuai kriteria.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($articles->hasPages())
        <div class="card-footer bg-white py-3">
            {{ $articles->links() }}
        </div>
    @endif
</div>
@endsection
