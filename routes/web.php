<?php

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// Home page route (keep this route and remove the conflicting one below)
Route::get('/', [ProductController::class, 'index'])->name('home');

// Product page route
Route::get('/products/{product}', [ProductController::class, 'show'])->name('product.show');

// Group routes requiring authentication
Route::middleware(['auth'])->group(function () {
    Route::post('/reviews', [ProductController::class, 'storeReview'])->name('reviews.store');
});

// Authentication routes
Auth::routes();

// Show individual product and its reviews (accessible to everyone)
Route::get('/products/{product}', function ($productId) {
    $product = Product::findOrFail($productId);
    $reviews = Review::with('user')->where('product_id', $productId)->get(); // Eager load user with review
    return view('products.show', compact('product', 'reviews'));
})->name('product.show');

// Review submission route (requires authentication)
Route::middleware(['auth'])->post('/reviews', function (Request $request) {
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'required|string|max:255',
    ]);

    $review = new Review();
    $review->product_id = $request->product_id;
    $review->rating = $request->rating;
    $review->comment = $request->comment;
    $review->user_id = Auth::id();
    $review->save();

    return redirect()->route('product.show', ['product' => $request->product_id])
        ->with('success', 'Review added successfully!');
});

// Add a route for logging out
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
