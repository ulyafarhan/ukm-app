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
| Public Routes
|--------------------------------------------------------------------------
*/

// Halaman utama (landing page)
Route::get('/', [PublicPageController::class, 'home'])
    ->name('home');

// Rute berita & detailnya
Route::get('/news', [PublicPageController::class, 'news'])
    ->name('news.index');
Route::get('/news/{event}', [PublicPageController::class, 'newsDetail'])
    ->name('news.detail');
Route::get('/blog', [PostController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [PostController::class, 'show'])->name('blog.show');
Route::get('/pendaftaran-anggota', [RegistrationController::class, 'create'])->name('register.member.create');
Route::post('/pendaftaran-anggota', [RegistrationController::class, 'store'])->name('register.member.store');
/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| Authenticated & Verified User Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard utama aplikasi
    Route::get('/app', [UserDashboardController::class, 'index'])
        ->name('dashboard');

    // Manajemen profil
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // Modul untuk member
    Route::get('/members', [MemberPageController::class, 'index'])
        ->name('members.index');
    Route::get('/finance', [FinanceController::class, 'index'])
        ->name('finance.index');
    Route::get('/events', [EventController::class, 'index'])
        ->name('events.index');
    Route::get('/documents', [DocumentController::class, 'index'])
        ->name('documents.index');
});