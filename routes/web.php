<?php

use Illuminate\Support\Facades\Route;

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

require __DIR__.'/auth.php';
