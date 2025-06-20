<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api;

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('/reset-password', [ForgotPasswordController::class, 'reset']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'me']);
        Route::put('user', [AuthController::class, 'updateProfile']);
    });
});

Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::prefix('products')->group(function () {
        Route::get('/', [Api\ProductController::class, 'index']);
        Route::get('{id}', [Api\ProductController::class, 'show']);
    });

    Route::get('/categories', [Api\CategoryController::class, 'index']);
    Route::get('/categories/{id}/attributes', [Api\CategoryController::class, 'attributes']);
});