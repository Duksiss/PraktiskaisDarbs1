<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // Store a new review
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500',
        ]);

        $review = new Review([
            'rating' => $request->rating,
            'comment' => $request->comment,
            'user_id' => auth()->id(),
        ]);

        $product->reviews()->save($review);

        // Updated route name to 'product.show'
        return redirect()->route('product.show', $product->id)->with('success', 'Review added successfully!');
    }

    // Show form for editing a review
    public function edit(Product $product, Review $review)
    {
        // Only allow the owner of the review to edit
        if (Auth::id() !== $review->user_id) {
            // Updated route name to 'product.show'
            return redirect()->route('product.show', $product->id)->with('error', 'Unauthorized action');
        }

        return view('reviews.edit', compact('review', 'product'));
    }

    // Update an existing review
    public function update(Request $request, Product $product, Review $review)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500',
        ]);

        // Only allow the owner of the review to update
        if (Auth::id() !== $review->user_id) {
            // Updated route name to 'product.show'
            return redirect()->route('product.show', $product->id)->with('error', 'Unauthorized action');
        }

        $review->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        // Updated route name to 'product.show'
        return redirect()->route('product.show', $product->id)->with('success', 'Review updated successfully');
    }

    // Delete a review
    public function destroy(Product $product, Review $review)
    {
        // Only allow the owner of the review to delete
        if (Auth::id() !== $review->user_id) {
            // Updated route name to 'product.show'
            return redirect()->route('product.show', $product->id)->with('error', 'Unauthorized action');
        }

        $review->delete();

        // Updated route name to 'product.show'
        return redirect()->route('product.show', $product->id)->with('success', 'Review deleted successfully');
    }
}