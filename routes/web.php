<?php

use App\Http\Controllers\Admin\LowonganController as AdminLowonganController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\PublicAlumniController;
use App\Http\Controllers\AngkatanController;
use App\Http\Controllers\DonasiAlumniController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LowonganKerjaController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TracerController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [NewsController::class, 'index'])->name('news.index');

Route::prefix('news')->name('news.')->group(function () {
    Route::middleware(['auth', EnsureAdmin::class])->group(function () {
        Route::get('/create', [NewsController::class, 'create'])->name('create');
        Route::post('/', [NewsController::class, 'store'])->name('store');
        Route::get('/{news}/edit', [NewsController::class, 'edit'])->name('edit');
        Route::put('/{news}', [NewsController::class, 'update'])->name('update');
        Route::delete('/{news}', [NewsController::class, 'destroy'])->name('destroy');
    });

    Route::get('/', [NewsController::class, 'index'])->name('index');
    Route::get('/{news}', [NewsController::class, 'show'])->name('show');
});

Route::resource('angkatan', AngkatanController::class)->only(['index']);

Route::resource('angkatan', AngkatanController::class)
    ->only(['create', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', EnsureAdmin::class]);

Route::get('/donasi', [DonasiAlumniController::class, 'index'])->name('donasi.index');

Route::prefix('lowongan-kerja')->name('lowongan.')->group(function () {
    Route::get('/', [LowonganKerjaController::class, 'index'])->name('index');
    Route::get('/{lowongan}', [LowonganKerjaController::class, 'show'])->name('show');
});

Route::resource('alumni', PublicAlumniController::class)->only(['index', 'show']);

Route::resource('alumni', PublicAlumniController::class)
    ->only(['create', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', EnsureAdmin::class]);

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', EnsureAdmin::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        Route::prefix('news')->name('news.')->group(function () {
            Route::get('/', [AdminController::class, 'news'])->name('index');
            Route::get('/create', [AdminController::class, 'createNews'])->name('create');
            Route::post('/', [AdminController::class, 'storeNews'])->name('store');
            Route::get('/{news}/edit', [AdminController::class, 'editNews'])->name('edit');
            Route::put('/{news}', [AdminController::class, 'updateNews'])->name('update');
            Route::delete('/{news}', [AdminController::class, 'destroyNews'])->name('destroy');
            Route::patch('/{news}/publish', [AdminController::class, 'publishNews'])->name('publish');
            Route::patch('/{news}/unpublish', [AdminController::class, 'unpublishNews'])->name('unpublish');
        });

        Route::resource('alumni', AlumniController::class);

        Route::resource('lowongan', AdminLowonganController::class);
        Route::patch('lowongan/{lowongan}/status', [AdminLowonganController::class, 'toggleStatus'])
            ->name('lowongan.toggle-status');

        Route::prefix('tracer')->name('tracer.')->group(function () {
            Route::get('/', [TracerController::class, 'index'])->name('index');
            Route::get('/export', [TracerController::class, 'export'])->name('export');
            Route::get('/{tracer}', [TracerController::class, 'show'])->name('show');
            Route::delete('/{tracer}', [TracerController::class, 'destroy'])->name('destroy');
        });

        Route::resource('galeri', GaleriController::class);
        Route::resource('pengumuman', PengumumanController::class);
        Route::resource('users', UserController::class);
        Route::resource('donasi', \App\Http\Controllers\AdminDonasiController::class);

        Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
        Route::put('/settings/profile', [SettingsController::class, 'updateProfile'])->name('settings.profile');
        Route::put('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.password');
        Route::put('/settings/website', [SettingsController::class, 'updateWebsite'])->name('settings.website');
    });

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
