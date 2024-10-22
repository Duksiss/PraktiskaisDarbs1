<!-- resources/views/products/show.blade.php -->
@extends('layouts.app')

@section('title', 'Product Details')

@section('content')
    <h1>{{ $product->name }}</h1>
    <p>Price: ${{ $product->price }}</p>
    <p>Description: {{ $product->description }}</p>

    <h3>Reviews</h3>
    @if($reviews->isEmpty())
        <p>No reviews yet. Be the first to review!</p>
    @else
        @foreach($reviews as $review)
            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">Rating: {{ $review->rating }}/5</h5>
                    <p class="card-text">{{ $review->comment }}</p>
                    <p class="text-muted">Reviewed on: {{ $review->created_at->format('d M Y') }}</p>
                </div>
            </div>
        @endforeach
    @endif

    @auth
        <h3>Add a Review</h3>
        <form action="{{ url('/reviews') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">

            <div class="form-group">
                <label for="rating">Rating (1-5)</label>
                <input type="number" name="rating" class="form-control" min="1" max="5" required>
            </div>

            <div class="form-group">
                <label for="comment">Comment</label>
                <textarea name="comment" class="form-control" required></textarea>
            </div>

            <button type="submit" class="btn btn-success">Submit Review</button>
        </form>
    @else
        <p>Please <a href="{{ route('login') }}">login</a> or <a href="{{ route('register') }}">register</a> to leave a review.</p>
    @endauth
@endsection