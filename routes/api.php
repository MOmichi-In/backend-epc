<?php

use Illuminate\Support\Facades\Route;
use App\Interfaces\Http\Controllers\Auth\AuthController;
use App\Interfaces\Http\Controllers\Public\PublicContentController;
use App\Interfaces\Http\Controllers\Public\PublicLeadController;
use App\Interfaces\Http\Controllers\Admin\ContentController;
use App\Interfaces\Http\Controllers\Admin\GalleryController;
use App\Interfaces\Http\Controllers\Admin\LeadController;

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
    Route::get('/contents/{section}',  [PublicContentController::class, 'bySection']);
    Route::post('/leads',              [PublicLeadController::class, 'store']);
});

// ============================================
// ADMIN
// ============================================
Route::prefix('admin')
    ->middleware(['auth:sanctum', 'role:admin'])
    ->group(function () {
        Route::apiResource('contents', ContentController::class);
        Route::apiResource('gallery',  GalleryController::class);
        Route::get('leads',            [LeadController::class, 'index']);
        Route::patch('leads/{id}/read',[LeadController::class, 'markAsRead']);
        Route::delete('leads/{id}',    [LeadController::class, 'destroy']);
    });