@extends('layouts.kepala_desa')

@section('title', 'Pemantauan Berita & Pengumuman - Kepala Desa Tautpah')
@section('page_title', 'Pemantauan Konten Publikasi')

@section('content')
<div class="card border-0 shadow-sm rounded-3 bg-white">
    <div class="card-header bg-white border-bottom py-3 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <h6 class="fw-bold mb-0">Daftar Konten Terpublikasi (Read-Only)</h6>
            <small class="text-muted">Kepala Desa memantau seluruh berita dan pengumuman yang dapat diakses publik</small>
        </div>
        <span class="badge bg-light text-secondary border p-2">
            <i class="bi bi-info-circle me-1"></i> Mode Pemantauan Saja
        </span>
    </div>

    <!-- Filter Form -->
    <div class="card-body border-bottom bg-light py-2">
        <form action="{{ route('kepaladesa.articles') }}" method="GET" class="row g-2 align-items-center">
            <div class="col-md-5">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Cari judul konten...">
            </div>
            <div class="col-md-3">
                <select name="type" class="form-select form-select-sm">
                    <option value="">Semua Jenis</option>
                    <option value="berita" {{ request('type') == 'berita' ? 'selected' : '' }}>Berita</option>
                    <option value="pengumuman" {{ request('type') == 'pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-sm btn-dark w-100">Cari</button>
            </div>
            <div class="col-md-2">
                @if(request()->anyFilled(['search', 'type']))
                    <a href="{{ route('kepaladesa.articles') }}" class="btn btn-sm btn-outline-secondary w-100">Reset</a>
                @endif
            </div>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light small">
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Gambar</th>
                    <th>Judul Informasi</th>
                    <th>Jenis & Kategori</th>
                    <th>Total Tayang</th>
                    <th>Tanggal Terbit</th>
                    <th class="text-end" style="width: 100px;">Aksi</th>
                </tr>
            </thead>
            <tbody class="small">
                @forelse($articles as $index => $item)
                    <tr>
                        <td>{{ $articles->firstItem() + $index }}</td>
                        <td>
                            <div style="width: 55px; height: 45px; background-color: #f1f5f9; border-radius: 6px; overflow: hidden;">
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
                            <div class="fw-bold text-dark">{{ $item->title }}</div>
                            <small class="text-secondary text-truncate d-block" style="max-width: 320px;">
                                {{ Str::limit(strip_tags($item->summary ?? $item->content), 80) }}
                            </small>
                        </td>
                        <td>
                            <span class="badge {{ $item->type === 'pengumuman' ? 'bg-warning text-dark' : 'bg-success' }}">
                                {{ ucfirst($item->type) }}
                            </span>
                            <div class="text-muted small mt-1">{{ $item->category?->name ?? '-' }}</div>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border">
                                <i class="bi bi-eye me-1"></i> {{ $item->views_count }} tayang
                            </span>
                        </td>
                        <td>
                            <div>{{ $item->published_at ? $item->published_at->format('d/m/Y') : $item->created_at->format('d/m/Y') }}</div>
                            <small class="text-muted">Oleh: {{ $item->user?->name ?? 'Admin' }}</small>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('kepaladesa.articles.show', $item->id) }}" class="btn btn-sm btn-outline-primary" title="Tinjau Detail Konten">
                                <i class="bi bi-eye me-1"></i> Tinjau
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-2 d-block mb-2"></i> Belum ada konten terpublikasi.
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
