<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

// Login API
Route::post('/v1/login', [AuthController::class, 'login']);

// Public routes
Route::get('/v1/products', [ProductController::class, 'index']);
Route::get('/v1/products/{product}', [ProductController::class, 'show']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Cart
    Route::get('/v1/cart', [CartController::class, 'show']);
    Route::post('/v1/cart/items', [CartController::class, 'addItem']);
    Route::patch('/v1/cart/items/{item}', [CartController::class, 'updateItem']);
    Route::delete('/v1/cart/items/{item}', [CartController::class, 'removeItem']);
    Route::delete('/v1/cart', [CartController::class, 'clear']);
});
