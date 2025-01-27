<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [\App\Http\Controllers\HomeController::class,'home'])->name('home');
    Route::get('/product/{id}', [\App\Http\Controllers\HomeController::class,'product'])->name('product');
    Route::get('/products', [\App\Http\Controllers\HomeController::class,'products'])->name('products');

});

require __DIR__.'/auth.php';
