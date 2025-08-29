<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

Route::view('/', 'home')->name('home');

Route::get('/categories/{category}', function (string $category) {
    return view('category', ['category' => $category]);
})->name('categories.show');

Route::get('/categories/{category}/products/{product}', function (string $category, string $product) {
    return view('product', ['category' => $category, 'product' => $product]);
})->name('products.show');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('checkout', 'checkout')
    ->middleware(['auth'])
    ->name('checkout');

Route::view('cart', 'cart')->name('cart');

Route::view('orders', 'orders')
    ->middleware(['auth'])
    ->name('orders.index');

Route::get('orders/{order}/return', function (string $order) {
    return view('returns', ['order' => $order]);
})->middleware(['auth'])->name('orders.return');

Route::post('/exit-intent', function (Request $request) {
    Log::info('Exit intent response', [
        'action' => $request->input('action'),
        'user_id' => auth()->id(),
        'session_id' => $request->session()->getId(),
    ]);
    return response()->json(['status' => 'ok']);
})->name('exit-intent');

require __DIR__.'/auth.php';
