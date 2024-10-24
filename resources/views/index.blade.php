@extends('layouts.app')

@section('content')
    <h1>All Products</h1>
    <ul>
        @foreach($products as $product)
            <li>
                <a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a> - ${{ $product->price }}
            </li>
        @endforeach
    </ul>
@endsection