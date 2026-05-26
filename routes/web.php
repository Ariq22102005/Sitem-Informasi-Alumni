<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AngkatanController;

Route::resource('angkatan', AngkatanController::class);
Route::get('/', function () {
    return view('welcome');
});
