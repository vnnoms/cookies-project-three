<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CartController;

Route::redirect('/', '/login');

// Login page 
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login']);
});

// Dashboard, need to login first to access this page
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])
        ->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});

Route::get('/products', [ItemController::class, 'index'])
    ->name('products.index');

// Shopping Cart
Route::get('/cart', [CartController::class, 'index'])
    ->name('cart.index');

Route::post('/cart/{item}', [CartController::class, 'add'])
    ->name('cart.add');

Route::patch('/cart/{item}', [CartController::class, 'update'])
    ->name('cart.update');

Route::delete('/cart/{item}', [CartController::class, 'remove'])
    ->name('cart.remove');