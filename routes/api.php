<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/products', [ProductController::class, 'listProducts']);
Route::get('/product/{id}', [ProductController::class, 'productDetail']);

Route::middleware('jwt.auth')->group(function () {
    Route::post('/merchant/product', [ProductController::class, 'createProduct']);
    Route::post('/merchant/updateProduct', [ProductController::class, 'updateProduct']);
    Route::post('/merchant/deleteProduct/{id}', [ProductController::class, 'deleteProduct']);
    Route::get('/merchant/viewOrders', [MerchantController::class, 'viewOrders']);

    Route::post('/customer/cart', [CustomerController::class, 'addToCart']);
    Route::get('/customer/cart/cartCount', [CustomerController::class, 'getCartCount']);
    Route::get('/customer/cart/cartItems', [CustomerController::class, 'getCartItems']); // listCart
    Route::post('/customer/cart/update/{id}', [CustomerController::class, 'updateCart']); 
    Route::post('/customer/cart/delete/{id}', [CustomerController::class, 'destroyCart']);

    Route::post('/customer/checkout', [CustomerController::class, 'checkout']);
    Route::get('/logout', [AuthController::class, 'logout']);
});
