@extends('layouts.mainlayout')

@section('content')

<!-- Hero Section -->
<div class="hero-section">
    <div class="hero-content">
        <h1>Discover Unique Handmade Crafts</h1>
        <p>Explore our exclusive collection of traditional and modern handmade products crafted by skilled artisans from Kathmandu.</p>
        <a href="/shop" class="hero-button">Shop Now</a>
    </div>
</div>

<!-- Categories Section -->
<div class="categories-section container">
    <h2>Shop by Category</h2>
    <div class="categories">
        @foreach($categories as $category)
            <div class="category">
                {{-- <a href="{{ route('category.show', ['id' => $category->id]) }}"> --}}
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" />
                    <h3>{{ $category->name }}</h3>
                </a>
            </div>
        @endforeach
    </div>
</div>

<!-- Featured Products Section -->
<div class="products-section container">
    <h2>Featured Products</h2>
    <div class="products">
        @foreach($products as $product)
            <div class="product">
                <a href="{{ route('product.show', ['id' => $product->id]) }}">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" />
                    <h3>{{ $product->name }}</h3>
                    <p>${{ number_format($product->price, 2) }}</p>
                    {{-- <span class="view-details-btn">View Details</span> --}}
                </a>
            </div>
        @endforeach
    </div>
</div>

<!-- About Section -->
<div class="about-section">
    <div class="about-content container">
        <h2>About Us</h2>
        <p>We bring you the finest handmade products, directly from the heart of Kathmandu. Our artisans take pride in preserving traditional craftsmanship while creating modern, stylish products that fit seamlessly into your lifestyle.</p>
        <a href="/about" class="about-link">Learn More</a>
    </div>
</div>

@endsection

<style>
    /* General Styles */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #0A192F; /* Dark Cyan-Blue */
        color: #FFFFFF; /* White text color */
    }

    /* Hero Section Styles */
    .hero-section {
        position: relative;
        background-color: #0A192F; /* Dark Cyan-Blue */
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        padding: 2rem;
        box-sizing: border-box;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1;
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-section h1 {
        font-size: 4rem;
        margin: 0;
        text-align: left;
        color: #64FDDA; /* Neon Teal */
    }

    .hero-section p {
        font-size: 1.5rem;
        margin: 1rem 0;
        text-align: left;
    }

    .hero-button {
        background-color: #64FDDA; /* Neon Teal */
        color: #0A192F; /* Dark Cyan-Blue */
        padding: 1rem 2rem;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        font-size: 1.2rem;
        margin-top: 1rem;
        display: inline-block;
        transition: background-color 0.3s, transform 0.3s;
    }

    .hero-button:hover {
        background-color: #4DD1D9; /* Darker Teal */
        transform: scale(1.05);
    }

    /* Categories Section */
    .categories-section {
        padding: 50px 0;
        text-align: center;
    }

    .categories-section h2 {
        margin-bottom: 30px;
        font-size: 2rem;
        color: #64FDDA; /* Neon Teal */
    }

    .categories {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .category {
        margin: 15px;
        background: #222831; /* Dark Gray */
        width: 200px;
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s;
    }

    .category:hover {
        transform: scale(1.05);
    }

    .category img {
        width: 100%;
        height: auto;
    }

    .category h3 {
        margin-top: 10px;
        font-size: 1.2rem;
        color: #64FDDA; /* Neon Teal */
        padding: 0 10px;
    }

    /* Products Section */
    .products-section {
        padding: 50px 0;
        text-align: center;
    }

    .products-section h2 {
        margin-bottom: 30px;
        font-size: 2rem;
        color: #64FDDA; /* Neon Teal */
    }

    .products {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .product {
        background: #222831; /* Dark Gray */
        margin: 15px;
        width: 250px; /* Adjust as needed */
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s;
    }

    .product:hover {
        transform: scale(1.05);
    }

    .product img {
        width: 100%;
        height: auto;
    }

    .product h3 {
        margin: 10px 0;
        font-size: 1.2rem;
        color: #FFFFFF; /* White */
        padding: 0 10px;
    }

    .product p {
        font-size: 1.1rem;
        color: #64FDDA; /* Neon Teal */
    }

    .view-details-btn {
        background-color: #4DD1D9; /* Darker Teal */
        color: #FFFFFF; /* White */
        padding: 8px 15px;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s, transform 0.3s;
    }

    .view-details-btn:hover {
        background-color: #64FDDA; /* Neon Teal */
        transform: scale(1.1);
    }

    /* About Section */
    .about-section {
        padding: 50px 0;
        background-color: #0A192F; /* Dark Cyan-Blue */
        text-align: center;
    }

    .about-content h2 {
        font-size: 2rem;
        margin-bottom: 20px;
        color: #64FDDA; /* Neon Teal */
    }

    .about-content p {
        font-size: 1.2rem;
        margin-bottom: 30px;
    }

    .about-link {
        background-color: #2d3644; /* Neon Teal */
        color: #FFFFFF; /* White */
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s, transform 0.3s;
    }

    .about-link:hover {
        background-color: #4DD1D9; /* Darker Teal */
        color: #0A192F;
        transform: scale(1.05);
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        .hero-content h1 {
            font-size: 2.5rem;
        }

        .categories-section h2,
        .products-section h2,
        .about-content h2 {
            font-size: 1.5rem;
        }

        .category,
        .product {
            width: 90%;
        }
    }
</style>
