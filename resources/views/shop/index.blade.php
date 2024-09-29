@extends('layouts.applayout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/shop.css') }}">

<div class="shop-container">
    <!-- Fixed Filters -->
    <div class="filters-container">
        <h2>Filters</h2>
        <form method="GET" action="{{ route('shop.index') }}" class="filter-form">
            <!-- Category Filter -->
            <div class="filter-group">
                <label for="category">Category:</label>
                <select name="category" id="category" onchange="this.form.submit()">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

           <!-- Price Filter -->
           <div class="filter-group">
            <label for="price">Price:</label>
            <input type="range" id="price" name="price" min="0" max="1000" value="{{ request('price', 1000) }}" onchange="updatePriceValue(this.value); this.form.submit();">
            <span id="price-value">${{ request('price', 1000) }}</span>
            <input type="hidden" name="hidden-price" id="hidden-price" value="{{ request('price', 1000) }}">
        </div>
            <!-- Sort By -->
            <div class="filter-group">
                <label for="sort">Sort By:</label>
                <select name="sort" id="sort" onchange="this.form.submit()">
                    <option value="">Sort By</option>
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                </select>
            </div>
        </form>
    </div>

    <!-- Scrollable Products Area -->
    <div class="products-container">
        <h1>Our Products</h1>

        <!-- Notification for No Products Found -->
        @if($products->isEmpty())
        <div class="no-products">
            <p>No products available at this price.</p>
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

                <!-- Add to Cart and Wishlist icons -->
                <div class="product-actions">
                    @auth
                    <button type="button" onclick="addToCart({{ $product->id }})" class="add-to-cart-btn">Add to Cart</button>
                    @else
                    <button type="button" onclick="showLoginAlert()" class="add-to-cart-btn">Add to Cart</button>
                    @endauth

                    <!-- Wishlist Icon -->
                    <span id="wishlist-icon-{{ $product->id }}" class="wishlist-icon" onclick="toggleWishlist({{ $product->id }})">
                        @if(in_array($product->id, $wishlist))
                            <i class="fas fa-heart"></i> <!-- Filled heart icon -->
                        @else
                            <i class="far fa-heart"></i> <!-- Unfilled heart icon -->
                        @endif
                    </span>
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

<script>
    function showLoginAlert() {
        alert("Please log in to add items to your cart or wishlist.");
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

    function toggleWishlist(productId) {
        var icon = document.getElementById('wishlist-icon-' + productId);
        fetch(`/wishlist/toggle/${productId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.added) {
                icon.innerHTML = '<i class="fas fa-heart"></i>'; // Filled heart icon
            } else {
                icon.innerHTML = '<i class="far fa-heart"></i>'; // Unfilled heart icon
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("Something went wrong. Please try again.");
        });
    }

    function updatePriceValue(value) {
        document.getElementById('price-value').textContent = '$' + value;
        document.getElementById('hidden-price').value = value;
    }
</script>
@endsection

<style>
    /* Updated styling for the shop page with neon blue and teal theme */
.shop-container {
    display: flex;
    padding: 20px;
    gap: 20px;
}

.filters-container {
    width: 25%;
    background-color: #172A45; /* Darker blue for the filter sidebar */
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.filters-container h2 {
    margin-top: 0;
    font-size: 1.5rem;
    color: #64FDDA; /* Neon teal for filter titles */
}

.filter-form {
    display: flex;
    flex-direction: column;
}

.filter-group {
    margin-bottom: 15px;
}

.filter-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #CBD5F5; /* Light blue for filter labels */
}

.filter-group select, .filter-group input[type="range"] {
    width: 100%;
    padding: 8px;
    background-color: #112240; /* Dark background for input fields */
    color: #64FDDA; /* Neon teal text color */
    border: 1px solid #64FDDA; /* Neon teal borders */
    border-radius: 4px;
}

.filter-group input[type="range"] {
    margin-top: 5px;
}

.products-container {
    width: 85%;
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
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    overflow: hidden;
    position: relative;
    transition: transform 0.3s;
}

.product-card:hover {
    transform: translateY(-5px);
}

.product-image {
    width: 100%;
    height: 250px; /* Fixed height */
    object-fit: cover; /* Cover the area while preserving aspect ratio */
}


.product-info {
    padding: 15px;
    color: #CBD5F5; /* Light blue for text */
}

.product-info h2 {
    margin-top: 0;
}

.price-stock {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
}

.product-price {
    font-size: 1.2rem;
    color: #64FDDA; /* Neon teal for product prices */
}

.product-stock {
    font-size: 1rem;
    font-weight: bold;
}

.product-stock.in-stock {
    color: #28a745; /* Green for in-stock */
}

.product-stock.out-of-stock {
    color: #dc3545; /* Red for out-of-stock */
}

.product-reviews {
    margin-bottom: 10px;
}

.star-rating {
    color: #414985; /* Gold color for stars */
}

.star-rating .filled {
    color: #00D1B2; /* Red for filled stars */
}

.action-container {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.add-to-cart-btn {
    background-color: #64FDDA; /* Neon teal for button background */
    color: #0A192F; /* Dark blue for button text */
    border: none;
    padding: 15px;
    border-radius: 8px;
    font-size: 1.2rem;
    cursor: pointer;
    width: 100%; /* Full width button */
    transition: background-color 0.3s;
}

.add-to-cart-btn:hover {
    background-color: #00D1B2; /* Lighter teal on hover */
}

.wishlist-icon {
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
    font-size: 1.5rem;
    /* border:  #00D1B2; */
    /* color: #b8e1db; Gold for wishlist icon */
}

.wishlist-icon i {
    transition: color 0.3s ease;
}

.wishlist-icon i.filled {
    color: #0c0c0c; /* Red for filled heart */
}

</style>