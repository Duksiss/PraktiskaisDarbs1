@extends('layouts.app')

@section('content')
    <h1>Reviews</h1>

    @foreach($reviews as $review)
        <div class="review">
            <h4>Review by: {{ $review->user->name }}</h4>
            <p>{{ $review->comment }}</p>
            <p>Rating: {{ $review->rating }}/5</p>
        </div>
    @endforeach
@endsection