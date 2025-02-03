<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [\App\Http\Controllers\HomeController::class, 'home'])->name('home');
Route::get('/product/{id}', [\App\Http\Controllers\HomeController::class, 'product'])->name(name: 'product');
Route::get('/products', [\App\Http\Controllers\HomeController::class, 'products'])->name('products');
Route::get('/productsData', [\App\Http\Controllers\HomeController::class, 'productsData'])->name('productsData');


Route::middleware('auth')->group(function () {
    Route::post('/orders', [\App\Http\Controllers\HomeController::class, 'orders']);
    Route::get('/orders', [\App\Http\Controllers\HomeController::class, 'listOrders'])->name('orders');

    Route::get('/acccount', [\App\Http\Controllers\HomeController::class, 'acccount'])->name('acccount');

    Route::get('/cart', [\App\Http\Controllers\HomeController::class, 'cart'])->name('cart');
    Route::get('/customer', [\App\Http\Controllers\HomeController::class, 'customer'])->name('customer');
    Route::post('/customer', [\App\Http\Controllers\HomeController::class, 'saveCustomer']);

    Route::get('success/{id}', [\App\Http\Controllers\HomeController::class, 'success'])->name('success');


    Route::get('/customer-data', [\App\Http\Controllers\HomeController::class, 'customerData'])->name('customer.data');
});

require __DIR__ . '/auth.php';
