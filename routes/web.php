<?php

use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\OutletController as AdminOutletController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\CheckoutController;
use App\Http\Controllers\Web\OrderController;
use App\Http\Controllers\Web\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Auth::routes(['verify' => true]);

// Home Route
Route::get('/', [ProductController::class, 'index'])->name('home');

// Product Routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove/{product}', [CartController::class, 'removeFromCart'])->name('cart.remove');

// Checkout Routes
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

// Order Routes
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // ...
    Route::post('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Outlet Routes
    Route::resource('outlets', AdminOutletController::class);

    // Order Routes
    Route::resource('orders', AdminOrderController::class);

    // Additional Order Actions
    Route::post('/orders/{order}/accept', [AdminOrderController::class, 'accept'])
        ->name('orders.accept');
    Route::post('/orders/{order}/cancel', [AdminOrderController::class, 'cancel'])
        ->name('orders.cancel');
    Route::post('/orders/{order}/transfer', [AdminOrderController::class, 'transfer'])
        ->name('orders.transfer');
});

// Super Admin Routes
Route::prefix('super-admin')->name('super-admin.')->middleware(['auth', 'super_admin'])->group(function () {
   
});
