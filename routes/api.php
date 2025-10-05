<?php

use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Product routes
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);

// Cart routes
Route::get('/cart', [CartController::class, 'getCart']);
Route::post('/cart', [CartController::class, 'addToCart']);
Route::put('/cart/{id}', [CartController::class, 'updateCartItem']);
Route::delete('/cart/{id}', [CartController::class, 'removeFromCart']);
