<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    // Product Management
    Route::resource('products', ProductController::class);

    // Shopping Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update/{productId}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');

    //Order entity
    Route::get('/checkout', [OrderController::class, 'showCheckoutForm'])->name('checkout.form');
    Route::post('/checkout', [OrderController::class, 'placeOrder'])->name('checkout.submit');
});
