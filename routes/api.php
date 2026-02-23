<?php

use Illuminate\Support\Facades\Route;
use App\Interfaces\Http\Controllers\Public\PublicContentController;
use App\Interfaces\Http\Controllers\Admin\ContentController;

// ============================================
// RUTAS PÚBLICAS (sin autenticación)
// ============================================
Route::prefix('public')->group(function () {
    Route::get('/contents/{section}', [PublicContentController::class, 'bySection']);
});

// ============================================
// RUTAS ADMIN (protegidas — auth próximo paso)
// ============================================
Route::prefix('admin')->middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('contents', ContentController::class);
});