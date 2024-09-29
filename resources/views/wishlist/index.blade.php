@extends('layouts.applayout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/wishlist.css') }}">

<div class="wishlist-container">
    <h1>My Wishlist</h1>
    @if($wishlists->isEmpty())
        <div class="empty-wishlist-message">
            <i class="fa fa-heart big-heart" aria-hidden="true"></i> <!-- Bigger icon for empty wishlist -->
            <p>Your wishlist is empty. <a href="{{ route('shop.index') }}" class="browse-link">Browse products</a> to add items to your wishlist.</p>
        </div>
    @else
        <table class="wishlist-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($wishlists as $wishlist)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/' . $wishlist->product->image) }}" alt="{{ $wishlist->product->name }}" class="wishlist-item-image">
                        </td>
                        <td>{{ $wishlist->product->name }}</td>
                        <td>${{ number_format($wishlist->product->price, 2) }}</td>
                        <td class="actions-column">
                            <div class="action-buttons">
                                @if(!$wishlist->product->in_cart)
                                    <form action="{{ route('cart.store') }}" method="POST" class="add-to-cart-form">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $wishlist->product->id }}">
                                        <button type="submit" class="add-to-cart-btn">
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to Cart
                                        </button>
                                    </form>
                                @endif
                                <form action="{{ route('wishlist.destroy', $wishlist->product->id) }}" method="POST" class="remove-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="remove-from-wishlist-btn">
                                        <i class="fa fa-trash" aria-hidden="true"></i> Remove
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- Popup Modal -->
    <div id="popup" class="popup">
        <div class="popup-content">
            <span class="popup-close">&times;</span>
            <p id="popup-message"></p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const popup = document.getElementById('popup');
            const popupMessage = document.getElementById('popup-message');
            const closeBtn = document.querySelector('.popup-close');

            document.querySelectorAll('.add-to-cart-form').forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    const button = this.querySelector('.add-to-cart-btn');
                    
                    fetch(this.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        body: new FormData(this)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            popupMessage.textContent = 'Product successfully added to cart.';
                            popup.style.display = 'block';
                            this.closest('tr').querySelector('.add-to-cart-btn').textContent = 'Added';
                        } else {
                            popupMessage.textContent = 'Something went wrong. Please try again.';
                            popup.style.display = 'block';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        popupMessage.textContent = 'Something went wrong. Please try again.';
                        popup.style.display = 'block';
                    });
                });
            });

            document.querySelectorAll('.remove-form').forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    fetch(this.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ _method: 'DELETE' })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            popupMessage.textContent = 'Product removed from wishlist.';
                            popup.style.display = 'block';
                            this.closest('tr').remove(); // Remove the row from the table
                        } else {
                            popupMessage.textContent = 'Something went wrong. Please try again.';
                            popup.style.display = 'block';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        popupMessage.textContent = 'Something went wrong. Please try again.';
                        popup.style.display = 'block';
                    });
                });
            });

            closeBtn.addEventListener('click', function () {
                popup.style.display = 'none';
            });

            window.addEventListener('click', function (event) {
                if (event.target === popup) {
                    popup.style.display = 'none';
                }
            });
        });
    </script>
</div>

<style>
    body {
        background-color: #0A192F; /* Dark background */
        color: #FFFFFF; /* White text */
    }

    .wishlist-container {
        padding: 20px;
    }

    h1 {
        color: #64FDDA; /* Teal for headers */
        text-align: center;
    }

    .empty-wishlist-message {
        text-align: center;
        font-size: 18px;
        margin-top: 20px;
        background-color: rgba(100, 253, 218, 0.1); /* Light background for empty message */
        padding: 20px;
        border-radius: 5px;
    }

    .big-heart {
        font-size: 50px; /* Bigger heart icon */
        color: #64FDDA; /* Heart color */
    }

    .browse-link {
        color: #64FDDA; /* Teal link color */
        text-decoration: underline; /* Underline for links */
    }

    .wishlist-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .wishlist-table th,
    .wishlist-table td {
        padding: 15px;
        text-align: left;
    }

    .wishlist-table th {
        background-color: #141414; /* Darker header */
        color: #64FDDA; /* Teal header text */
    }

    .wishlist-table tr {
        border-bottom: 1px solid #141414; /* Table row separator */
    }

    .wishlist-item-image {
        width: 120px; /* Increased width for product images */
        height: auto;
        border-radius: 5px;
    }

    .actions-column {
        display: flex;
        align-items: center; /* Center items vertically */
    }

    .action-buttons {
        display: flex; /* Align action buttons in a row */
        gap: 10px; /* Spacing between buttons */
    }

    .add-to-cart-btn,
    .remove-from-wishlist-btn {
        background-color: #64FDDA; /* Teal button */
        border: none;
        padding: 10px 15px; /* Increased padding for larger buttons */
        border-radius: 5px;
        color: #0A192F; /* Dark text on buttons */
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .add-to-cart-btn:hover,
    .remove-from-wishlist-btn:hover {
        background-color: #00BFFF; /* Slightly brighter teal on hover */
    }

    .popup {
        display: none;
        position: fixed;
        z-index: 999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.7);
    }

    .popup-content {
        background-color: #222831; /* Dark background for popup */
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #64FDDA; /* Border in teal */
        width: 80%;
        max-width: 300px;
        color: #FFFFFF;
    }

    .popup-close {
        color: #FFFFFF;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }
</style>
@endsection
