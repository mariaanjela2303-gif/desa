@extends('layouts.public')

@section('title', 'Login Pengelola Desa - Desa Tautpah')

@section('content')
<div class="container py-5 my-md-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-5">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="p-4 p-md-5 text-center text-white" style="background: radial-gradient(circle at 10% 20%, rgba(16, 185, 129, 0.25) 0%, transparent 45%), linear-gradient(135deg, #05231a 0%, #064e3b 60%, #083c2e 100%);">
                    <div class="d-inline-flex p-3 rounded-4 mb-3 shadow-sm" style="background: rgba(255, 255, 255, 0.12); backdrop-filter: blur(8px); border: 1px solid rgba(255, 255, 255, 0.2);">
                        <i class="bi bi-shield-lock-fill fs-2" style="color: #6ee7b7;"></i>
                    </div>
                    <h4 class="fw-bold mb-1 text-white">Masuk Panel Pengelola</h4>
                    <p class="small mb-0" style="color: #cbd5e1;">Pemerintah Desa Tautpah, Kec. Biboki Selatan</p>
                </div>

                <div class="card-body p-4 p-md-5 bg-white">
                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="login" class="form-label fw-semibold small text-muted">Email atau Username</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-person"></i></span>
                                <input type="text" name="login" id="login" value="{{ old('login') }}" class="form-control bg-light border-start-0 @error('login') is-invalid @enderror" placeholder="admin atau kades" required autofocus>
                            </div>
                            @error('login')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold small text-muted">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-key"></i></span>
                                <input type="password" name="password" id="password" class="form-control bg-light border-start-0 border-end-0 @error('password') is-invalid @enderror" placeholder="Masukkan password" required>
                                <button class="btn btn-light border border-start-0 text-muted" type="button" id="togglePasswordBtn">
                                    <i class="bi bi-eye" id="toggleIcon"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label small text-muted" for="remember">
                                    Ingat saya
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-desa-primary w-100 py-2 fs-6 fw-bold shadow-sm">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Masuk Sekarang
                        </button>
                    </form>

                    <!-- Info Akun Pengujian Sistem -->
                    <div class="mt-4 p-3 rounded-3 bg-light border border-secondary border-opacity-10">
                        <div class="d-flex align-items-center gap-2 mb-2 text-dark fw-bold small">
                            <i class="bi bi-key-fill text-warning"></i> Akun Pengujian Awal:
                        </div>
                        <div class="small text-muted d-flex flex-column gap-1">
                            <div><strong>Admin:</strong> <code>admin</code> / <code>admin123</code> (Kelola konten lengkap)</div>
                            <div><strong>Kepala Desa:</strong> <code>kades</code> / <code>kades123</code> (Monitoring / Read-Only)</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('home') }}" class="text-muted text-decoration-none small">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Beranda Publik
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const toggleBtn = document.getElementById('togglePasswordBtn');
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');

    toggleBtn.addEventListener('click', function() {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('bi-eye');
            toggleIcon.classList.add('bi-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('bi-eye-slash');
            toggleIcon.classList.add('bi-eye');
        }
    });
</script>
@endpush
