<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\CustomerController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('jwt.auth')->group(function () {
    Route::post('/merchant/product', [MerchantController::class, 'createProduct']);
    Route::post('/merchant/updateProduct', [MerchantController::class, 'updateProduct']);
    Route::post('/merchant/deleteProduct/{id}', [MerchantController::class, 'deleteProduct']);
    Route::get('/merchant/viewOrders', [MerchantController::class, 'viewOrders']);

    Route::get('/customer/products', [CustomerController::class, 'listProducts']);
    Route::post('/customer/cart', [CustomerController::class, 'addToCart']);
    Route::post('/customer/checkout', [CustomerController::class, 'checkout']);
    Route::get('/logout', [AuthController::class, 'logout']);
});
