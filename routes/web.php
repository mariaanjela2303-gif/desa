<?php

use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\OfficialController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KepalaDesa\MonitoringController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| 1. RUTE PUBLIK (Masyarakat / Pengunjung - Tanpa Login)
|--------------------------------------------------------------------------
*/
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/profil', [PublicController::class, 'profile'])->name('public.profile');
Route::get('/pemerintahan', [PublicController::class, 'officials'])->name('public.officials');
Route::get('/berita', [PublicController::class, 'articles'])->name('public.articles');
Route::get('/berita/{slug}', [PublicController::class, 'articleDetail'])->name('public.articles.detail');
Route::get('/galeri', [PublicController::class, 'galleries'])->name('public.galleries');
Route::get('/kontak', [PublicController::class, 'contact'])->name('public.contact');

/*
|--------------------------------------------------------------------------
| 2. RUTE AUTENTIKASI (Login & Logout)
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| 3. RUTE DASHBOARD ADMIN (Role: admin)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // CRUD Berita & Pengumuman
        Route::resource('articles', ArticleController::class)->except(['show']);

        // CRUD Kategori Berita
        Route::resource('categories', CategoryController::class)->except(['create', 'show', 'edit']);

        // CRUD Galeri
        Route::resource('galleries', GalleryController::class)->except(['create', 'show', 'edit']);

        // Pengelolaan Profil Desa, Sejarah, Visi Misi
        Route::get('/profil', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profil', [ProfileController::class, 'update'])->name('profile.update');

        // CRUD Struktur Pemerintahan & Perangkat Desa
        Route::resource('officials', OfficialController::class)->except(['create', 'show', 'edit']);

        // Pengelolaan Kontak, Jam Pelayanan, Google Maps
        Route::get('/kontak', [ContactController::class, 'edit'])->name('contact.edit');
        Route::put('/kontak', [ContactController::class, 'update'])->name('contact.update');

        // Riwayat Aktivitas Admin
        Route::get('/aktivitas', [ActivityLogController::class, 'index'])->name('activity_logs.index');
    });

/*
|--------------------------------------------------------------------------
| 4. RUTE MONITORING KEPALA DESA (Role: kepala_desa)
|--------------------------------------------------------------------------
| Khusus read-only monitoring: statistik, konten publikasi, galeri, log, kunjungan.
*/
Route::prefix('kepala-desa')
    ->name('kepaladesa.')
    ->middleware(['auth', 'role:kepala_desa'])
    ->group(function () {
        Route::get('/dashboard', [MonitoringController::class, 'dashboard'])->name('dashboard');
        Route::get('/berita', [MonitoringController::class, 'articles'])->name('articles');
        Route::get('/berita/{article}', [MonitoringController::class, 'showArticle'])->name('articles.show');
        Route::get('/galeri', [MonitoringController::class, 'galleries'])->name('galleries');
        Route::get('/aktivitas', [MonitoringController::class, 'activities'])->name('activities');
        Route::get('/kunjungan', [MonitoringController::class, 'pageViews'])->name('page_views');
    });
