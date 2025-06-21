<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
    
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    Route::resource('attributes', \App\Http\Controllers\Admin\AttributeController::class);

        // Category Attribute Assignment
    Route::get('categories/{category}/attributes', [\App\Http\Controllers\Admin\CategoryAttributeController::class, 'edit'])->name('categories.attributes.edit');
    Route::post('categories/{category}/attributes', [\App\Http\Controllers\Admin\CategoryAttributeController::class, 'update'])->name('categories.attributes.update');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
