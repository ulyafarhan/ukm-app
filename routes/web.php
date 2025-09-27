<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicPageController; 
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\Member\MemberPageController;
use App\Http\Controllers\Member\FinanceController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DocumentController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Landing page
Route::get('/', [LandingPageController::class, 'index'])
    ->name('landing');

// Optional public dashboard view
Route::get('/dashboard', [LandingPageController::class, 'index'])
    ->name('dashboard.public');

// News listing & detail
Route::get('/berita', [PublicPageController::class, 'news'])
    ->name('news.index');
Route::get('/berita/{event:id}', [PublicPageController::class, 'newsDetail'])
    ->name('news.detail');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
|
| Provides routes for login, registration, password reset, email
| verification, etc.
|
*/
require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| Authenticated & Verified User Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    // Main app dashboard
    Route::get('/app', [UserDashboardController::class, 'index'])
        ->name('dashboard');

    // Profile management
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // Member modules
    Route::get('/members', [MemberPageController::class, 'index'])
        ->name('members.index');
    Route::get('/finance', [FinanceController::class, 'index'])
        ->name('finance.index');
    Route::get('/events', [EventController::class, 'index'])
        ->name('events.index');
    Route::get('/documents', [DocumentController::class, 'index'])
        ->name('documents.index');
});

