<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ReviewController;

Route::redirect('/', '/dashboard');

Route::get('/dashboard', [ProductController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::get('/products/{product}', [ProductController::class, 'show'])
    ->middleware(['auth'])
    ->name('products.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/products/{product}/pdf', [ProductController::class, 'exportPdf'])->name('product.pdf');


Route::post('/wishlist/toggle/{product}', [WishlistController::class, 'toggle'])
    ->middleware('auth')
    ->name('wishlist.toggle');

Route::get('/wishlist', [WishlistController::class, 'index'])
    ->middleware('auth')
    ->name('wishlist.index');

Route::post('/products/{product}/review', [ReviewController::class, 'store'])
    ->middleware('auth')
    ->name('review.store');

require __DIR__.'/auth.php';
