<?php

use App\Http\Controllers\Admin\LowonganController as AdminLowonganController;
use App\Http\Controllers\LowonganKerjaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\NewsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\TracerController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\SettingsController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [NewsController::class, 'index'])->name('news.index');

Route::prefix('news')->name('news.')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | AUTH ONLY
    |--------------------------------------------------------------------------
    */

    Route::middleware('auth')->group(function () {

        Route::get('/create', [NewsController::class, 'create'])->name('create');

        Route::post('/', [NewsController::class, 'store'])->name('store');

        Route::get('/{news}/edit', [NewsController::class, 'edit'])->name('edit');

        Route::put('/{news}', [NewsController::class, 'update'])->name('update');

        Route::delete('/{news}', [NewsController::class, 'destroy'])->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | PUBLIC ACCESS
    |--------------------------------------------------------------------------
    */

    Route::get('/', [NewsController::class, 'index'])->name('index');

    // HARUS PALING BAWAH
    Route::get('/{news}', [NewsController::class, 'show'])->name('show');
use App\Http\Controllers\AngkatanController;

Route::resource('angkatan', AngkatanController::class);
Route::get('/', function () {
    return view('welcome');
})->name('home');

/*
|--------------------------------------------------------------------------
| Lowongan Kerja — Sisi Alumni (Publik)
|--------------------------------------------------------------------------
*/
Route::prefix('lowongan-kerja')->name('lowongan.')->group(function () {
    Route::get('/', [LowonganKerjaController::class, 'index'])->name('index');
    Route::get('/{lowongan}', [LowonganKerjaController::class, 'show'])->name('show');
});

/*
|--------------------------------------------------------------------------
| Lowongan Kerja — Sisi Admin / Perusahaan
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn () => redirect()->route('admin.lowongan.index'))->name('dashboard');

    Route::resource('lowongan', AdminLowonganController::class);
    Route::patch('lowongan/{lowongan}/status', [AdminLowonganController::class, 'toggleStatus'])
        ->name('lowongan.toggle-status');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [AdminController::class, 'dashboard'])
            ->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | BERITA
        |--------------------------------------------------------------------------
        */

        Route::prefix('news')->name('news.')->group(function () {

            Route::get('/', [AdminController::class, 'news'])
                ->name('index');

            Route::get('/create', [AdminController::class, 'createNews'])
                ->name('create');

            Route::post('/', [AdminController::class, 'storeNews'])
                ->name('store');

            Route::get('/{news}/edit', [AdminController::class, 'editNews'])
                ->name('edit');

            Route::put('/{news}', [AdminController::class, 'updateNews'])
                ->name('update');

            Route::delete('/{news}', [AdminController::class, 'destroyNews'])
                ->name('destroy');

            Route::patch('/{news}/publish', [AdminController::class, 'publishNews'])
                ->name('publish');

            Route::patch('/{news}/unpublish', [AdminController::class, 'unpublishNews'])
                ->name('unpublish');
        });

        /*
        |--------------------------------------------------------------------------
        | ALUMNI
        |--------------------------------------------------------------------------
        */

        Route::resource('alumni', AlumniController::class);

        /*
        |--------------------------------------------------------------------------
        | LOWONGAN
        |--------------------------------------------------------------------------
        */

        Route::resource('lowongan', LowonganController::class);

        /*
        |--------------------------------------------------------------------------
        | TRACER STUDY
        |--------------------------------------------------------------------------
        */

        Route::prefix('tracer')->name('tracer.')->group(function () {

            Route::get('/', [TracerController::class, 'index'])
                ->name('index');

            Route::get('/export', [TracerController::class, 'export'])
                ->name('export');

            Route::get('/{tracer}', [TracerController::class, 'show'])
                ->name('show');

            Route::delete('/{tracer}', [TracerController::class, 'destroy'])
                ->name('destroy');
        });

        /*
        |--------------------------------------------------------------------------
        | GALERI
        |--------------------------------------------------------------------------
        */

        Route::resource('galeri', GaleriController::class);

        /*
        |--------------------------------------------------------------------------
        | PENGUMUMAN
        |--------------------------------------------------------------------------
        */

        Route::resource('pengumuman', PengumumanController::class);

        /*
        |--------------------------------------------------------------------------
        | USERS
        |--------------------------------------------------------------------------
        */

        Route::resource('users', UserController::class);

        /*
        |--------------------------------------------------------------------------
        | SETTINGS
        |--------------------------------------------------------------------------
        */

        Route::get('/settings', [SettingsController::class, 'index'])
            ->name('settings');

        Route::put('/settings/profile', [SettingsController::class, 'updateProfile'])
            ->name('settings.profile');

        Route::put('/settings/password', [SettingsController::class, 'updatePassword'])
            ->name('settings.password');

        Route::put('/settings/website', [SettingsController::class, 'updateWebsite'])
            ->name('settings.website');
    });

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Auth::routes();

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');