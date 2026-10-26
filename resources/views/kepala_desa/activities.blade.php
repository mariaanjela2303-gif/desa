@extends('layouts.kepala_desa')

@section('title', 'Riwayat Aktivitas Admin - Kepala Desa Tautpah')
@section('page_title', 'Riwayat Aktivitas Pengelola Website')

@section('content')
<div class="card border-0 shadow-sm rounded-3 bg-white">
    <div class="card-header bg-white border-bottom py-3 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <h6 class="fw-bold mb-0">Catatan Aktivitas Admin Desa</h6>
            <small class="text-muted">Riwayat audit seluruh aksi penambahan, pengeditan, dan penghapusan data website</small>
        </div>
        <span class="badge bg-light text-muted border p-2">
            <i class="bi bi-shield-check me-1"></i> Audit Trail
        </span>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light small">
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Aksi</th>
                    <th>Modul</th>
                    <th>Keterangan Aktivitas</th>
                    <th>Nama Admin</th>
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
                        <td class="fw-semibold text-dark">{{ $log->module }}</td>
                        <td>{{ $log->description }}</td>
                        <td>
                            <div class="fw-bold text-dark">{{ $log->user_name }}</div>
                            <small class="text-muted">{{ $log->user?->email ?? '-' }}</small>
                        </td>
                        <td>
                            <div>{{ $log->created_at->format('d/m/Y H:i:s') }} WITA</div>
                            <small class="text-muted">{{ $log->created_at->diffForHumans() }}</small>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-clock-history fs-2 d-block mb-2"></i> Belum ada riwayat aktivitas yang tercatat.
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
