@extends('layouts.app')

@section('content')
    <h1>All Products</h1>
    <ul>
        @foreach($products as $product)
            <li>
                <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a> - ${{ $product->price }}
            </li>
        @endforeach
    </ul>
@endsection
