@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="https://via.placeholder.com/300" class="img-fluid" alt="{{ $product->name }}">
            </div>
            <div class="col-md-6">
                <h1>{{ $product->name }}</h1>
                <p>{{ $product->description }}</p>
                <p><strong>Price:</strong> ${{ $product->price }}</p>
            </div>
        </div>
        
        <hr>
        
        <h3>Reviews</h3>
        @foreach($reviews as $review)
            <div class="media mb-3">
                <div class="media-body">
                    <h5 class="mt-0">{{ $review->user->name }} (Rating: {{ $review->rating }}/5)</h5>
                    <p>{{ $review->comment }}</p>
                </div>
            </div>
        @endforeach
        
        @auth
            <form action="{{ route('reviews.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="form-group">
                    <label for="rating">Rating:</label>
                    <select name="rating" id="rating" class="form-control">
                        <option value="5">5 - Excellent</option>
                        <option value="4">4 - Good</option>
                        <option value="3">3 - Average</option>
                        <option value="2">2 - Poor</option>
                        <option value="1">1 - Terrible</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="comment">Comment:</label>
                    <textarea name="comment" id="comment" rows="3" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit Review</button>
            </form>
        @else
            <p><a href="{{ route('login') }}">Login</a> to submit a review.</p>
        @endauth
    </div>
@endsection
