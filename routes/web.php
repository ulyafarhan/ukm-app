<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicPageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MemberPageController;
use App\Http\Controllers\Member\FinanceController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DocumentController;

/*
|--------------------------------------------------------------------------
| Public Routes (semua pengunjung)
|--------------------------------------------------------------------------
*/
Route::get('/', [PublicPageController::class, 'home'])
    ->name('home');

Route::get('/news', [PublicPageController::class, 'news'])
    ->name('news.index');

Route::get('/news/{event}', [PublicPageController::class, 'newsDetail'])
    ->name('news.detail');

Route::get('/blog', [PostController::class, 'index'])
    ->name('blog.index');

Route::get('/blog/{post:slug}', [PostController::class, 'show'])
    ->name('blog.show');

Route::get('/pendaftaran-anggota', [RegistrationController::class, 'create'])
    ->name('register.member.create');

Route::post('/pendaftaran-anggota', [RegistrationController::class, 'store'])
    ->name('register.member.store');

/*
|--------------------------------------------------------------------------
| Authentication Routes (Laravel Breeze / Fortify)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| Dashboard Redirect
|--------------------------------------------------------------------------
| Setelah login & verifikasi, langsung ke /member/dashboard
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return redirect()->route('member.dashboard');
})->middleware(['auth', 'verified'])
  ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profile Management (hanya login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Member Area (hanya login & verified)
|--------------------------------------------------------------------------
| Semua URL diprefiks dengan /member
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])
     ->prefix('member')
     ->name('member.')
     ->group(function () {

    // Dashboard utama member
    Route::get('/dashboard', [MemberPageController::class, 'dashboard'])
        ->name('dashboard');

    // Daftar anggota
    Route::get('/anggota', [MemberPageController::class, 'index'])
        ->name('anggota.index');

    // Modul keuangan
    Route::get('/keuangan', [FinanceController::class, 'index'])
        ->name('keuangan.index');

    // Modul kalender kegiatan
    Route::get('/kegiatan', [EventController::class, 'index'])
        ->name('kegiatan.index');

    // Modul repositori dokumen
    Route::get('/dokumen', [DocumentController::class, 'index'])
        ->name('dokumen.index');
});