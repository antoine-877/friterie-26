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

Route::get('/categories/{id}', [CategoryController::class, 'show'])
    ->whereNumber('id')
    ->name('categories.show');

Route::view('/composants', 'styleguide')->name('styleguide');
