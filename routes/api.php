<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonasiAlumniController;

// Mendaftarkan resource API murni untuk Modul Donasi Alumni (Mencakup GET, POST, DELETE)
Route::apiResource('donasi-alumni', DonasiAlumniController::class);
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
