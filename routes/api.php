<?php

use Illuminate\Support\Facades\Route;
use App\Interfaces\Http\Controllers\Auth\AuthController;
use App\Interfaces\Http\Controllers\Public\PublicContentController;
use App\Interfaces\Http\Controllers\Admin\ContentController;

// ============================================
// AUTH
// ============================================
Route::prefix('auth')->group(function () {
    Route::post('/login',  [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me',      [AuthController::class, 'me']);
    });
});

// ============================================
// PÚBLICAS
// ============================================
Route::prefix('public')->group(function () {
    Route::get('/contents/{section}', [PublicContentController::class, 'bySection']);
});

// ============================================
// ADMIN — requiere token + rol admin
// ============================================
Route::prefix('admin')
    ->middleware(['auth:sanctum', 'role:admin'])
    ->group(function () {
        Route::apiResource('contents', ContentController::class);
    });