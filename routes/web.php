<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Member\MemberPageController;
use App\Http\Controllers\Member\FinanceController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\UserDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 🔹 Landing Page (Publik)
Route::get('/', [LandingPageController::class, 'index'])->name('landing');

// 🔹 Dashboard Publik (opsional, jika ingin tampilkan versi umum)
Route::get('/dashboard', [LandingPageController::class, 'index'])->name('dashboard.public');

// 🔹 Rute untuk User yang sudah login & terverifikasi
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard khusus user login → diarahkan ke controller baru
    Route::get('/app', [UserDashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Modul lain
    Route::get('/members', [MemberPageController::class, 'index'])->name('members.index');
    Route::get('/finance', [FinanceController::class, 'index'])->name('finance.index');
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
});

// 🔹 Rute bawaan untuk otentikasi
require __DIR__ . '/auth.php';