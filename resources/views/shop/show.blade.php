@extends('layouts.applayout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/product.css') }}">
<div class="product-detail-container">
    <div class="product-image-container">
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image-detail" onclick="openLightbox()">
    </div>
    <div class="product-info-container">
        <h1>{{ $product->name }}</h1>
        <p class="product-price">${{ number_format($product->price, 2) }}</p>
        <p class="product-description">{{ $product->description }}</p>
        
        <!-- Add to Cart Button -->
        @auth
        <button type="button" onclick="addToCart({{ $product->id }})" class="add-to-cart-btn">Add to Cart</button>
        @else
        <button type="button" onclick="showLoginAlert()" class="add-to-cart-btn">Add to Cart</button>
        @endauth
        
        <div class="product-additional-info">
            <p><strong>Category:</strong> {{ $product->category->name }}</p>
            <p><strong>Stock:</strong> {{ $product->stock }} items available</p>
        </div>
    </div>
</div>

<!-- Rating and Reviews Section -->
<div class="rating-reviews-container">
    <div class="rating-form">
        @auth
        <h2>Rate this Product</h2>
        <form action="{{ route('reviews.store', $product->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="rating">Rating:</label>
                <select name="rating" id="rating" class="form-control" required>
                    <option value="" disabled selected>Select Rating</option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="form-group">
                <label for="comment">Comment:</label>
                <textarea name="comment" id="comment" class="form-control" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Review</button>
        </form>
        @else
        <p>Please <a href="{{ route('login') }}">login</a> to leave a review.</p>
        @endauth
    </div>

    <div class="product-reviews-section">
        <h2>Reviews</h2>
        @foreach ($product->reviews as $review)
            <div class="review">
                <h3>{{ $review->user->name }}</h3>
                <div class="star-rating">
                    @for ($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star {{ $i <= $review->rating ? 'filled' : '' }}"></i>
                    @endfor
                </div>
                <p>{{ $review->comment }}</p>
                <small>{{ $review->created_at->diffForHumans() }}</small>
            </div>
        @endforeach
    </div>
</div>

<!-- Lightbox Modal -->
<div id="lightbox" class="lightbox" onclick="closeLightbox()">
    <span class="close">&times;</span>
    <img class="lightbox-content" id="lightbox-image">
</div>

<script src="https://kit.fontawesome.com/a076d05399.js"></script> <!-- Font Awesome -->

<script>
    function showLoginAlert() {
        alert("Please log in to add items to your cart.");
        window.location.href = "{{ route('login') }}"; // Redirect to login page
    }

    function addToCart(productId) {
        fetch('{{ route('cart.store') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ product_id: productId, quantity: 1 })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message); // Show the success message
            } else {
                alert("Something went wrong. Please try again.");
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("Something went wrong. Please try again.");
        });
    }

    function openLightbox() {
        var lightbox = document.getElementById('lightbox');
        var lightboxImage = document.getElementById('lightbox-image');
        lightboxImage.src = document.querySelector('.product-image-detail').src;
        lightbox.style.display = 'block';
    }

    function closeLightbox() {
        document.getElementById('lightbox').style.display = 'none';
    }
</script>

<style>
    /* Product Detail Container */
    .product-detail-container {
        display: flex;
        max-width: 1200px;
        margin: 40px auto;
        padding: 30px;
        background-color: #0A192F; /* Dark Cyan-Blue */
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        gap: 30px;
    }

    /* Image Container */
    .product-image-container {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .product-image-detail {
        max-width: 100%;
        height: auto;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        transition: transform 0.3s ease;
    }

    .product-image-detail:hover {
        transform: scale(1.05);
    }

    /* Product Information Container */
    .product-info-container {
        flex: 2;
        padding: 0 20px;
    }

    .product-info-container h1 {
        font-size: 38px;
        color: #64FDDA; /* Teal */
        margin-bottom: 15px;
        font-weight: 700;
    }

    .product-price {
        font-size: 30px;
        color: #64FDDA; /* Teal */
        margin-bottom: 20px;
        font-weight: 600;
    }

    .product-description {
        font-size: 18px;
        color: #F2F2F2; /* Very Light Gray */
        margin-bottom: 30px;
        line-height: 1.6;
    }

    /* Add to Cart Button */
    .add-to-cart-btn {
        display: inline-block;
        padding: 14px 28px;
        background-color: #64FDDA; /* Teal */
        color: #0A192F; /* Dark Cyan-Blue */
        border: none;
        border-radius: 8px;
        font-size: 18px;
        font-weight: 600;
        transition: background-color 0.3s ease, transform 0.3s ease;
        text-align: center;
        cursor: pointer;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .add-to-cart-btn:hover {
        background-color: #54C0C6; /* Slightly darker teal */
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    /* Additional Product Info */
    .product-additional-info {
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #333; /* Dark gray */
    }

    .product-additional-info p {
        font-size: 16px;
        color: #F2F2F2; /* Very Light Gray */
        margin: 5px 0;
        line-height: 1.4;
    }

    /* Rating and Reviews Container */
    .rating-reviews-container {
        margin-top: 40px;
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        background-color: #0A192F; /* Dark Cyan-Blue */
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    }

    /* Rating Form */
    .rating-form {
        margin-bottom: 30px;
        padding: 20px;
        background-color: #1A2A3B; /* Darker Cyan-Blue */
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    }

    .rating-form h2 {
        margin-bottom: 15px;
        color: #64FDDA; /* Teal */
    }

    .rating-form .form-group {
        margin-bottom: 15px;
    }

    .rating-form label {
        font-size: 16px;
        color: #F2F2F2; /* Very Light Gray */
    }

    .rating-form .form-control {
        border: 1px solid #333; /* Dark Gray */
        border-radius: 4px;
        padding: 10px;
        font-size: 16px;
        color: #333; /* Dark Gray */
    }

    .rating-form .btn-primary {
        background-color: #64FDDA; /* Teal */
        color: #0A192F; /* Dark Cyan-Blue */
        border: none;
        border-radius: 4px;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .rating-form .btn-primary:hover {
        background-color: #54C0C6; /* Slightly darker teal */
    }

    /* Reviews Section */
    .product-reviews-section {
        margin-top: 30px;
    }

    .product-reviews-section h2 {
        margin-bottom: 20px;
        color: #64FDDA; /* Teal */
    }

    .review {
        padding: 15px;
        border-bottom: 1px solid #333; /* Dark Gray */
    }

    .review h3 {
        margin: 0;
        font-size: 18px;
        color: #64FDDA; /* Teal */
    }

    .star-rating {
        margin: 10px 0;
    }

    .star-rating .fa-star {
        color: #bfe0d8; /* Gold */
        font-size: 18px;
    }

    .star-rating .fa-star.filled {
        color: #64FDDA; /* Teal */
    }

    .review p {
        margin: 10px 0;
        color: #F2F2F2; /* Very Light Gray */
    }

    .review small {
        color: #888; /* Dark Gray */
    }

    /* Lightbox */
    .lightbox {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.8);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .lightbox-content {
        max-width: 90%;
        max-height: 90%;
        margin: auto;
        border-radius: 8px;
    }

    .lightbox .close {
        position: absolute;
        top: 20px;
        right: 40px;
        color: #FFFFFF;
        font-size: 40px;
        cursor: pointer;
    }
</style>
@endsection
