@extends('layouts.app')

@section('content')
    <h1>Add Review for {{ $product->name }}</h1>

    <form action="{{ route('reviews.store', $product->id) }}" method="POST">
        @csrf

        <div>
            <label for="rating">Rating (1-5):</label>
            <input type="number" name="rating" id="rating" min="1" max="5" required>
        </div>

        <div>
            <label for="comment">Comment:</label>
            <textarea name="comment" id="comment" required></textarea>
        </div>

        <button type="submit">Submit Review</button>
    </form>
@endsection
