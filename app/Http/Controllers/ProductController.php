<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('welcome', compact('products'));
    }

    public function show(Product $product)
{
    $reviews = Review::where('product_id', $product->id)->get();
    return view('products.show', compact('product', 'reviews'));
}

    public function storeReview(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:255',
        ]);

        $review = new Review();
        $review->product_id = $request->product_id;
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->user_id = auth()->id();
        $review->save();

        return redirect()->route('product.show', ['product' => $request->product_id])->with('success', 'Review added successfully!');
    }
}
