<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicPageController;
use App\Http\Controllers\MemberPageController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Member\FinanceController;

/*
|--------------------------------------------------------------------------
| Rute Publik (Dapat diakses semua pengunjung)
|--------------------------------------------------------------------------
*/
Route::get('/', [PublicPageController::class, 'home'])->name('home');
Route::get('/berita', [PublicPageController::class, 'newsIndex'])->name('news.index');
Route::get('/berita/{event:slug}', [PublicPageController::class, 'newsDetail'])->name('news.detail');
Route::get('/pendaftaran', [PublicPageController::class, 'registerMember'])->name('register.member');
Route::post('/pendaftaran', [PublicPageController::class, 'storeRegisterMember'])->name('register.member.store');


/*
|--------------------------------------------------------------------------
| Rute Autentikasi Bawaan Laravel Breeze
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';


/*
|--------------------------------------------------------------------------
| Rute Pengguna Terautentikasi (Anggota & Pengurus)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // Pengalihan setelah login, langsung ke dasbor member
    Route::get('/dashboard', fn() => redirect()->route('member.dashboard'))->name('dashboard');

    // Pengaturan Profil Pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |----------------------------------------------------------------------
    | Ekosistem Internal UKM (Member Area)
    |----------------------------------------------------------------------
    | Dilindungi oleh middleware 'auth' dan memiliki prefix '/member'
    */
    Route::prefix('member')->name('member.')->group(function () {
        Route::get('/dashboard', [MemberPageController::class, 'dashboard'])->name('dashboard');
        Route::get('/anggota', [MemberPageController::class, 'memberIndex'])->name('anggota.index');
        Route::get('/keuangan', [FinanceController::class, 'index'])->name('keuangan.index');
        Route::get('/kegiatan', [EventController::class, 'index'])->name('kegiatan.index');
        Route::get('/dokumen', [DocumentController::class, 'index'])->name('dokumen.index');
    });
});