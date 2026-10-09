<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/carte');

Route::get('/carte', [ProductController::class, 'index'])->name('products.index');

Route::get('/produits/nouveau', [ProductController::class, 'create'])->name('products.create');
Route::post('/produits', [ProductController::class, 'store'])->name('products.store');

Route::get('/produits/{product}', [ProductController::class, 'show'])
    ->name('products.show');

Route::get('/produits/{product}/modifier', [ProductController::class, 'edit'])
    ->name('products.edit');

Route::put('/produits/{product}', [ProductController::class, 'update'])
    ->name('products.update');

Route::patch('/produits/{product}/rupture', [ProductController::class, 'soldOut'])
    ->name('products.sold-out');

Route::delete('/produits/{product}', [ProductController::class, 'destroy'])
    ->name('products.destroy');

Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

Route::post('/categories/{category}/produits', [CategoryController::class, 'storeProduct'])->name('categories.products.store');

Route::view('/composants', 'styleguide')->name('styleguide');

