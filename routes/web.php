<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShoppingController;

// Home page - display products
Route::get('/', [ShoppingController::class, 'index'])->name('home');

// Cart operations (all POST routes as required)
Route::post('/cart/add', [ShoppingController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [ShoppingController::class, 'viewCart'])->name('cart.view');
Route::post('/cart/update', [ShoppingController::class, 'updateQuantity'])->name('cart.update');
Route::post('/cart/remove', [ShoppingController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/clear', [ShoppingController::class, 'clearCart'])->name('cart.clear');
Route::post('/checkout', [ShoppingController::class, 'checkout'])->name('checkout');
