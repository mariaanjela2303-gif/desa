@extends('layouts.admin')

@section('title', 'Riwayat Aktivitas Admin - Desa Tautpah')
@section('page_title', 'Riwayat Aktivitas & Log Sistem')

@section('content')
<div class="card border-0 shadow-sm rounded-3 bg-white">
    <div class="card-header bg-white border-bottom py-3 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <h6 class="fw-bold mb-0">Catatan Aktivitas Pengelolaan Konten</h6>
            <small class="text-muted">Mencatat penambahan, pengeditan, penghapusan data, dan autentikasi admin</small>
        </div>
    </div>

    <!-- Filter Form -->
    <div class="card-body border-bottom bg-light py-2">
        <form action="{{ route('admin.activity_logs.index') }}" method="GET" class="row g-2 align-items-center">
            <div class="col-md-5">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Cari keterangan aktivitas atau nama user...">
            </div>
            <div class="col-md-3">
                <select name="action" class="form-select form-select-sm">
                    <option value="">Semua Aksi</option>
                    <option value="TAMBAH" {{ request('action') == 'TAMBAH' ? 'selected' : '' }}>TAMBAH</option>
                    <option value="EDIT" {{ request('action') == 'EDIT' ? 'selected' : '' }}>EDIT</option>
                    <option value="HAPUS" {{ request('action') == 'HAPUS' ? 'selected' : '' }}>HAPUS</option>
                    <option value="LOGIN" {{ request('action') == 'LOGIN' ? 'selected' : '' }}>LOGIN</option>
                    <option value="LOGOUT" {{ request('action') == 'LOGOUT' ? 'selected' : '' }}>LOGOUT</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-sm btn-dark w-100">Cari Log</button>
            </div>
            <div class="col-md-2">
                @if(request()->anyFilled(['search', 'action']))
                    <a href="{{ route('admin.activity_logs.index') }}" class="btn btn-sm btn-outline-secondary w-100">Reset</a>
                @endif
            </div>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light small">
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Aksi</th>
                    <th>Modul</th>
                    <th>Keterangan Aktivitas</th>
                    <th>Pengguna</th>
                    <th>IP Address</th>
                    <th>Waktu Kejadian</th>
                </tr>
            </thead>
            <tbody class="small">
                @forelse($logs as $index => $log)
                    <tr>
                        <td>{{ $logs->firstItem() + $index }}</td>
                        <td>
                            @php
                                $badgeClass = match($log->action) {
                                    'TAMBAH' => 'bg-success',
                                    'EDIT' => 'bg-primary',
                                    'HAPUS' => 'bg-danger',
                                    'LOGIN' => 'bg-info text-dark',
                                    'LOGOUT' => 'bg-secondary',
                                    default => 'bg-dark'
                                };
                            @endphp
                            <span class="badge {{ $badgeClass }}">{{ $log->action }}</span>
                        </td>
                        <td><span class="fw-semibold text-dark">{{ $log->module }}</span></td>
                        <td>{{ $log->description }}</td>
                        <td>
                            <div class="fw-bold text-dark">{{ $log->user_name }}</div>
                            <small class="text-muted">{{ $log->user?->email ?? '-' }}</small>
                        </td>
                        <td><code>{{ $log->ip_address ?? '127.0.0.1' }}</code></td>
                        <td>
                            <div class="text-dark">{{ $log->created_at->format('d/m/Y H:i:s') }}</div>
                            <small class="text-muted">{{ $log->created_at->diffForHumans() }}</small>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-clock-history fs-2 d-block mb-2"></i> Belum ada rekaman riwayat aktivitas.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($logs->hasPages())
        <div class="card-footer bg-white py-3">
            {{ $logs->links() }}
        </div>
    @endif
</div>
@endsection
