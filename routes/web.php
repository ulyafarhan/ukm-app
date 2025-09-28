<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicPageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\MemberPageController; 
use App\Http\Controllers\PostController; 
use App\Http\Controllers\Member\FinanceController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DocumentController;

/*
|--------------------------------------------------------------------------
| Public Routes (Dapat diakses oleh semua pengunjung)
|--------------------------------------------------------------------------
|
| Rute ini adalah wajah publik dari aplikasi Anda.
|
*/

// Halaman utama (landing page)
Route::get('/', [PublicPageController::class, 'home'])->name('home');

// Halaman blog/artikel
Route::get('/blog', [PublicPageController::class, 'blogIndex'])->name('blog.index');
Route::get('/blog/{post:slug}', [PublicPageController::class, 'blogDetail'])->name('blog.detail');

// Halaman pendaftaran anggota baru (Oprec)
Route::get('/pendaftaran-anggota', [PublicPageController::class, 'registerMember'])->name('register.member');
Route::post('/pendaftaran-anggota', [PublicPageController::class, 'storeRegisterMember'])->name('register.member.store');


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
|
| Rute untuk login, register, lupa password, dll. Disediakan oleh Laravel Breeze.
|
*/
require __DIR__ . '/auth.php';


/*
|--------------------------------------------------------------------------
| Authenticated Routes (Hanya untuk pengguna yang sudah login)
|--------------------------------------------------------------------------
|
| Area ini dilindungi dan memerlukan autentikasi.
|
*/

// Rute ini adalah rute default setelah login dari Breeze, kita biarkan saja.
Route::get('/dashboard', function () {
    // Arahkan langsung ke member dashboard untuk pengalaman yang lebih mulus.
    return redirect()->route('member.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grup untuk manajemen profil pengguna
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| Member Area Routes (Ekosistem Internal UKM)
|--------------------------------------------------------------------------
|
| Seluruh rute untuk fitur internal anggota dan pengurus dikelompokkan di sini.
| Diberi prefix '/member' agar URL lebih rapi (contoh: /member/keuangan).
|
*/
Route::middleware(['auth', 'verified'])->prefix('member')->name('member.')->group(function () {

    // Dashboard utama untuk anggota
    Route::get('/dashboard', [MemberPageController::class, 'dashboard'])->name('dashboard');

    // Halaman untuk melihat daftar anggota lain
    Route::get('/anggota', [MemberPageController::class, 'index'])->name('anggota.index');

    // Modul Keuangan
    Route::get('/keuangan', [FinanceController::class, 'index'])->name('keuangan.index');

    // Modul Kalender Kegiatan
    Route::get('/kegiatan', [EventController::class, 'index'])->name('kegiatan.index');

    // Modul Repositori Dokumen
    Route::get('/dokumen', [DocumentController::class, 'index'])->name('dokumen.index');

});