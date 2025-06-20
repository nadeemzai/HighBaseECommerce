<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest:admin')->group(function () {
        Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('login', [AuthController::class, 'login']);
    });

    Route::middleware('admin')->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
        Route::resource('attributes', \App\Http\Controllers\Admin\AttributeController::class);
        Route::get('categories/{category}/attributes', [\App\Http\Controllers\Admin\CategoryAttributeController::class, 'edit'])->name('categories.attributes.edit');
        Route::post('categories/{category}/attributes', [\App\Http\Controllers\Admin\CategoryAttributeController::class, 'update'])->name('categories.attributes.update');
    });
});

