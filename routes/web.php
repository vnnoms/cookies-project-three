<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\StatelessCartController;

Route::redirect('/', '/login');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])
        ->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::get('/products', [ItemController::class, 'index'])
        ->name('products.index');

    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart.index');

    Route::post('/cart/{item}', [CartController::class, 'add'])
        ->name('cart.add');

    Route::patch('/cart/{item}', [CartController::class, 'update'])
        ->name('cart.update');

    Route::delete('/cart/{item}', [CartController::class, 'remove'])
        ->name('cart.remove');
});

Route::get('/stateless-cart', [StatelessCartController::class, 'index'])
    ->name('stateless-cart.index');

Route::post('/stateless-cart/add', [StatelessCartController::class, 'add'])
    ->name('stateless-cart.add');

Route::post('/stateless-cart/update', [StatelessCartController::class, 'update'])
    ->name('stateless-cart.update');