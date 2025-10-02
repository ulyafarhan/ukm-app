<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicPageController;
use App\Http\Controllers\MemberPageController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Member\FinanceController;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Rute Publik (Untuk semua pengunjung)
|--------------------------------------------------------------------------
*/
Route::controller(PublicPageController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/berita', 'newsIndex')->name('news.index');
    Route::get('/berita/{post:slug}', 'newsDetail')->name('news.detail');
});

Route::controller(PostController::class)->group(function () {
    Route::get('/blog', 'index')->name('blog.index');
    Route::get('/blog/{post:slug}', 'show')->name('blog.show');
});

Route::controller(RegistrationController::class)->group(function () {
    Route::get('/pendaftaran', 'create')->name('register.member');
    Route::post('/pendaftaran', 'store')->name('register.member.store');
});

/*
|--------------------------------------------------------------------------
| Rute Autentikasi
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| Rute Pengguna Terautentikasi
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', fn() => redirect('/admin'))->name('dashboard');
    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::patch('/', 'update')->name('update');
        Route::delete('/', 'destroy')->name('destroy');
    });

    Route::prefix('member')->name('member.')->group(function () {
        Route::get('/dashboard', [MemberPageController::class, 'dashboard'])->name('dashboard');
        Route::get('/anggota', [MemberPageController::class, 'memberIndex'])->name('anggota.index');
        Route::get('/keuangan', [FinanceController::class, 'index'])->name('keuangan.index');
        Route::get('/kegiatan', [EventController::class, 'index'])->name('kegiatan.index');
        Route::get('/dokumen', [DocumentController::class, 'index'])->name('dokumen.index');
    });
});