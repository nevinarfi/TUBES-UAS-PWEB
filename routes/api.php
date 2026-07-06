<?php

use App\Http\Controllers\Api\DokterApiController;
use App\Http\Controllers\Api\PasienApiController;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (\Illuminate\Http\Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// REST API - Pasien
Route::apiResource('pasien', PasienApiController::class);

// REST API - Dokter
Route::apiResource('dokter', DokterApiController::class);
