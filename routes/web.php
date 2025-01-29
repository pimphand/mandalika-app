<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [\App\Http\Controllers\HomeController::class,'home'])->name('home');
    Route::get('/product/{id}', [\App\Http\Controllers\HomeController::class,'product'])->name('product');
    Route::get('/products', [\App\Http\Controllers\HomeController::class,'products'])->name('products');
    Route::post('/orders', [\App\Http\Controllers\HomeController::class,'orders'])->name('orders');
    Route::get('/cart', [\App\Http\Controllers\HomeController::class,'cart'])->name('cart');
    Route::get('/customer', [\App\Http\Controllers\HomeController::class,'customer'])->name('customer');
    Route::get('/customer-data', [\App\Http\Controllers\HomeController::class,'customerData'])->name('customer.data');

});

require __DIR__.'/auth.php';
