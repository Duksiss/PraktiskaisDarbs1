@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Review</h1>

    <form action="{{ route('reviews.update', ['product' => $product->id, 'review' => $review->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="rating">Rating:</label>
            <select name="rating" id="rating" class="form-control">
                <option value="5" {{ $review->rating == 5 ? 'selected' : '' }}>5 - Excellent</option>
                <option value="4" {{ $review->rating == 4 ? 'selected' : '' }}>4 - Good</option>
                <option value="3" {{ $review->rating == 3 ? 'selected' : '' }}>3 - Average</option>
                <option value="2" {{ $review->rating == 2 ? 'selected' : '' }}>2 - Poor</option>
                <option value="1" {{ $review->rating == 1 ? 'selected' : '' }}>1 - Terrible</option>
            </select>
        </div>

        <div class="form-group">
            <label for="comment">Comment:</label>
            <textarea name="comment" id="comment" rows="3" class="form-control">{{ $review->comment }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Review</button>
    </form>

    <a href="{{ route('product.show', $product->id) }}" class="btn btn-secondary mt-3">Cancel</a>
</div>
@endsection