<?php

use App\Http\Controllers\DonasiAlumniController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('donasi-alumni', DonasiAlumniController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
