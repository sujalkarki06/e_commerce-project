@extends('layouts.applayout')

@section('content')
<div class="checkout-container">
    <div class="shipping-details">
        <h1>Shipping Details</h1>
        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" id="city" name="city" required>
            </div>
            <div class="form-group">
                <label for="postal_code">Postal Code:</label>
                <input type="text" id="postal_code" name="postal_code" required>
            </div>
            <div class="form-group">
                <label for="country">Country:</label>
                <input type="text" id="country" name="country" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="payment_method">Payment Method:</label>
                <select id="payment_method" name="payment_method" required>
                    <option value="credit_card">Credit Card</option>
                    <option value="debit_card">Debit Card</option>
                    <option value="paypal">PayPal</option>
                    <option value="e_sewa">E-Sewa</option>
                    {{-- <option value="bank_transfer">Bank Transfer</option> --}}
                </select>
            </div>
            {{-- <div class="form-group">
                <label for="delivery_cost">Delivery Cost:</label>
                <select id="delivery_cost" name="delivery_cost" required>
                    <option value="5">Standard Shipping ($5.00)</option>
                    <option value="10">Express Shipping ($10.00)</option>
                </select>
            </div> --}}
            <button type="submit" class="checkout-btn">Continue to Payment</button>
        </form>
    </div>

    <div class="order-summary">
        <h2>Order Summary</h2>
        @if(session('cart'))
            @php
                $cart = session('cart');
                $total = 0;
            @endphp
            <ul>
                @foreach($cart as $productId => $details)
                    @php
                        $total += $details['price'] * $details['quantity'];
                    @endphp
                    <li>
                        <img src="{{ asset('storage/' . $details['image']) }}" alt="{{ $details['name'] }}" class="product-image">
                        <div class="product-info">
                            <span class="product-name">{{ $details['name'] }}</span>
                            <span class="product-price">${{ number_format($details['price'], 2) }}</span>
                            <span class="product-quantity">x{{ $details['quantity'] }}</span>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="order-total">
                <h3>Subtotal: ${{ number_format($total, 2) }}</h3>
                <h3>Delivery Cost: $<span id="delivery-cost-display">5.00</span></h3>
                <h3>Total: $<span id="final-total">{{ number_format($total + 5, 2) }}</span></h3>
            </div>
        @else
            <p>Your cart is empty.</p>
        @endif
    </div>
</div>
@endsection

<style>
    /* CSS Reset */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    }

    body {
        background-color: #002b36; /* Dark Blue background for the page */
        color: #1f2338; /* Light Blue text color */
    }

    .checkout-container {
        display: flex;
        justify-content: space-between;
        max-width: 1200px;
        margin: 20px auto;
        padding: 20px;
    }

    .shipping-details, .order-summary {
        background-color: #112240; /* Dark Neon Blue background */
        border-radius: 8px;
        color: #e0f7fa; /* Light Blue text color */
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); /* Shadow effect for better visibility */
    }

    .shipping-details {
        flex: 2;
        margin-right: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #ffffff; /* Neon Blue text */
    }

    .form-group input, .form-group select {
        width: 100%;
        padding: 10px;
        border: 1px solid #013674; /* Neon Blue border */
        border-radius: 4px;
        background-color: #c2d4d9; /* Dark Blue for inputs */
        color: #080808; /* Neon Blue text */
    }

    .checkout-btn {
        margin-top: 20px;
        padding: 12px 20px;
        background-color: #283a5a; /* Neon Blue */
        color: #e3e8ed; /* Dark Blue text */
        border: none;
        border-radius: 5px;
        font-size: 18px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .checkout-btn:hover {
        background-color: #1e65ad; /* Lighter Blue for hover */
    }

    .order-summary {
        flex: 1;
    }

    .order-summary ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .order-summary li {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        border-bottom: 1px solid #00f2ff; /* Neon Blue border for each item */
        padding-bottom: 10px;
    }

    .order-summary .product-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        margin-right: 15px;
        border-radius: 4px;
    }

    .order-summary .product-info {
        display: flex;
        flex-direction: column;
    }

    .order-summary .product-name {
        font-weight: bold;
        color: #00f2ff; /* Neon Blue */
    }

    .order-summary .product-price {
        color: #0099cc; /* Lighter Blue */
    }

    .order-summary .product-quantity {
        color: #007acc; /* Medium Blue */
    }

    .order-summary .order-total {
        margin-top: 20px;
        font-size: 18px;
        font-weight: bold;
        color: #00f2ff; /* Neon Blue */
    }
</style>

<script>
    const total = {{ json_encode($total) }}; // Safely encode PHP variable into JavaScript

    document.getElementById('delivery_cost').addEventListener('change', function() {
        const deliveryCost = parseFloat(this.value);
        const finalTotal = total + deliveryCost; // Use the encoded variable
        
        document.getElementById('delivery-cost-display').textContent = deliveryCost.toFixed(2);
        document.getElementById('final-total').textContent = finalTotal.toFixed(2);
    });
</script>
