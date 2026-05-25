<?php

use App\Http\Controllers\Admin\LowonganController as AdminLowonganController;
use App\Http\Controllers\LowonganKerjaController;
use Illuminate\Support\Facades\Route;

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
