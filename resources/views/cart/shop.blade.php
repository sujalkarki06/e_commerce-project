<!-- resources/views/shop/show.blade.php -->
@extends('layouts.applayout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/product.css') }}">
<div class="product-detail-container">
    <div class="product-image-container">
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image-detail">
    </div>
    <div class="product-info-container">
        <h1>{{ $product->name }}</h1>
        <p class="product-price">${{ number_format($product->price, 2) }}</p>
        <p class="product-description">{{ $product->description }}</p>
        <form action="{{ route('cart.store') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" id="quantity" value="1" min="1" class="quantity-input">
            <button type="submit" class="add-to-cart-btn">Add to Cart</button>
        </form>
    </div>
</div>
@endsection
