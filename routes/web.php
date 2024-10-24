<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Home page route
Route::get('/', [ProductController::class, 'index'])->name('home');

// Product show page route (includes reviews)
Route::get('/products/{product}', [ProductController::class, 'show'])->name('product.show');

// Authentication routes
Auth::routes();

// Group routes requiring authentication
Route::middleware(['auth'])->group(function () {
    // Store a new review
    Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])->name('reviews.store');

    // Edit a review (Only accessible to the review owner)
    Route::get('/products/{product}/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');

    // Update a review (Only accessible to the review owner)
    Route::put('/products/{product}/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');

    // Delete a review (Only accessible to the review owner)
    Route::delete('/products/{product}/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

// Route for logging out
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');