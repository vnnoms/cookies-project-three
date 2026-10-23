<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\StatelessCartController;
use App\Http\Controllers\RoleController;
use App\Models\User;

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
    });

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    // Customer catalog
    Route::get('/products', [ItemController::class, 'index'])
        ->middleware('can:use-cart')
        ->name('products.index');

    // Inventory admin and staff
    Route::get('/inventory', [InventoryController::class, 'index'])
        ->middleware('can:adjust-stock')
        ->name('inventory.index');

    // Only admin can add new products
    Route::post('/inventory', [InventoryController::class, 'store'])
        ->middleware('can:manage-products')
        ->name('inventory.store');

    // Admin and staff change stock
    Route::patch('/inventory/{item}/stock', [
        InventoryController::class,
        'updateStock',
    ])->middleware('can:adjust-stock')
      ->name('inventory.stock.update');

    // Customer Cart
    Route::get('/cart', [CartController::class, 'index'])
        ->middleware('can:use-cart')
        ->name('cart.index');

    Route::post('/cart/{item}', [CartController::class, 'add'])
        ->middleware('can:use-cart')
        ->name('cart.add');

    Route::patch('/cart/{item}', [CartController::class, 'update'])
        ->middleware('can:use-cart')
        ->name('cart.update');

    Route::delete('/cart/{item}', [CartController::class, 'remove'])
        ->middleware('can:use-cart')
        ->name('cart.remove');

    // Role Management: admin saja
    Route::get('/admin/users', function () {
        return view('users.index', [
            'users' => User::select(
                'id',
                'full_name',
                'username',
                'role'
            )->orderBy('id')->get(),
        ]);
    })->middleware('can:manage-roles')
      ->name('admin.users.index');

    Route::patch('/admin/users/{user}/role', [
        RoleController::class,
        'update',
    ])->middleware('can:manage-roles')
      ->name('admin.users.role.update');

// Stateless Cart 
Route::get('/stateless-cart', [
    StatelessCartController::class,
    'index',
])->name('stateless-cart.index');

Route::post('/stateless-cart/add', [
    StatelessCartController::class,
    'add',
])->name('stateless-cart.add');

Route::post('/stateless-cart/update', [
    StatelessCartController::class,
    'update',
])->name('stateless-cart.update');
