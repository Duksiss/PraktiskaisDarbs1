@extends('layouts.app')

@section('title', 'Leave a Review for ' . $product->name)

@section('content')
    <h1>Leave a Review for {{ $product->name }}</h1>

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
@endsection