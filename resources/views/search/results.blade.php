@extends('layouts.applayout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/shop.css') }}">

<div class="shop-container">
    <!-- Products Area -->
    <div class="products-container">
        <h1>Search Results</h1>

        <!-- Notification for No Products Found -->
        @if($products->isEmpty())
        <div class="no-products">
            <p>No products available.</p>
        </div>
        @endif

        <!-- Product Grid -->
        <div class="product-grid">
            @foreach($products as $product)
            <div class="product-card">
                <a href="{{ route('shop.show', $product->id) }}" class="product-link">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
                    <div class="product-info">
                        <h2 class="product-name">{{ $product->name }}</h2>
                    </div>
                </a>
                <div class="price-stock">
                    <span class="product-price">${{ number_format($product->price, 2) }}</span>
                    <span class="product-stock {{ $product->quantity > 0 ? 'in-stock' : 'out-of-stock' }}">
                        {{ $product->quantity > 0 ? 'In Stock' : 'Out of Stock' }}
                    </span>
                </div>

                <!-- Average Rating Display -->
                <div class="product-reviews">
                    <div class="star-rating">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= $product->averageRating ? 'filled' : '' }}"></i>
                        @endfor
                    </div>
                    <p>{{ $product->reviews->count() }} reviews</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@if(session('error'))
<script>
    alert("{{ session('error') }}");
</script>
@endif

<script src="https://kit.fontawesome.com/a076d05399.js"></script> <!-- Font Awesome -->

<style>
    /* Simplified styling for the search results page */
.shop-container {
    padding: 20px;
}

.products-container {
    width: 100%;
}

.no-products {
    text-align: center;
    padding: 20px;
    background-color: #112240; /* Darker background for no-products message */
    color: #64FDDA; /* Neon teal text */
    border: 1px solid #64FDDA; /* Neon teal border */
    border-radius: 8px;
    margin-bottom: 20px;
}

.no-products p {
    margin: 0;
}

.product-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.product-card {
    width: calc(33.333% - 20px);
    background-color: #0A192F; /* Dark cyan-blue for product cards */
    border: 1px solid #64FDDA; /* Neon teal border */
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s;
}

.product-card:hover {
    transform: translateY(-10px);
}

.product-link {
    display: block;
    color: inherit;
    text-decoration: none;
}

.product-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.product-info {
    padding: 15px;
    color: #CBD5F5; /* Light blue text color */
}

.product-name {
    font-size: 1.2rem;
    margin: 0;
}

.price-stock {
    display: flex;
    justify-content: space-between;
    padding: 0 15px;
    color: #64FDDA; /* Neon teal for price and stock */
}

.product-reviews {
    display: flex;
    align-items: center;
    padding: 10px 15px;
    color: #CBD5F5; /* Light blue for reviews */
}

.star-rating i {
    color: #FFD700; /* Gold color for stars */
}

.product-card .out-of-stock {
    color: #BF6F4A; /* Warm medium brown for out of stock */
}
</style>
@endsection
