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

                    @if(auth()->check() && auth()->id() == $review->user_id)
                        <div class="mt-2">
                            <!-- Edit Button -->
                            <a href="{{ route('reviews.edit', ['product' => $product->id, 'review' => $review->id]) }}" class="btn btn-sm btn-warning">Edit</a>

                            <!-- Delete Form -->
                            <form action="{{ route('reviews.destroy', ['product' => $product->id, 'review' => $review->id]) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
        
        @auth
            <h4>Add a Review</h4>
            <form action="{{ route('reviews.store', $product) }}" method="POST">
                @csrf
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