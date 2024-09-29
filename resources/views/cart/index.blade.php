@extends('layouts.applayout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">
<div class="cart-container">
    <h1>Your Shopping Cart</h1>
    
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(session('cart') && count(session('cart')) > 0)
        <div class="continue-shopping">
            <a href="{{ route('shop.index') }}" class="continue-shopping-link">&#8592; Continue Shopping</a>
        </div>
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $id => $item)
                <tr data-id="{{ $id }}">
                    <td><img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="cart-image"></td>
                    <td>{{ $item['name'] }}</td>
                    <td>${{ number_format($item['price'], 2) }}</td>
                    <td>
                        <div class="quantity-controls">
                            <button type="button" class="quantity-btn decrease">-</button>
                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="quantity-input" readonly>
                            <button type="button" class="quantity-btn increase">+</button>
                        </div>
                    </td>
                    <td class="item-total">${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                    <td>
                        <form action="{{ route('cart.destroy', $id) }}" method="POST" class="remove-item-form" onsubmit="return confirmRemoval(this)">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="remove-item-btn">Remove</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="cart-summary">
            <h2>Cart Summary</h2>
            <p>Total: $<span id="cart-total">{{ number_format(array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)), 2) }}</span></p>
            <p>Delivery Cost: 
                <select id="delivery-cost" class="delivery-cost-select">
                    <option value="5">Standard Shipping ($5.00)</option>
                    <option value="10">Express Shipping ($10.00)</option>
                </select>
            </p>
            <p>Grand Total: $<span id="grand-total">{{ number_format(array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)), 2) }}</span></p>
            <a href="{{ route('checkout.index') }}" class="checkout-btn">Proceed to Checkout</a>
        </div>
    @else
        <div class="empty-cart-message">
            <i class="fas fa-shopping-cart empty-cart-icon"></i>
            <p>Your cart is currently empty!</p>
            <p>Start shopping to add items to your cart and enjoy great deals!</p>
            <a href="{{ route('shop.index') }}" class="continue-shopping-btn">Shop Now</a>
        </div>
    @endif
</div>

<script>
      document.querySelectorAll('.quantity-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const row = this.closest('tr');
            const input = row.querySelector('.quantity-input');
            const price = parseFloat(row.cells[2].textContent.replace('$', '').replace(',', ''));
            let quantity = parseInt(input.value);

            if (this.classList.contains('increase')) {
                quantity++;
            } else if (this.classList.contains('decrease') && quantity > 1) {
                quantity--;
            }
            input.value = quantity;

            // Update item total price
            const itemTotal = price * quantity;
            row.querySelector('.item-total').textContent = `$${itemTotal.toFixed(2)}`;

            // Update grand total calculation
            updateGrandTotal();

            // Send AJAX request to update quantity in the session
            fetch(`{{ route('cart.updateQuantity', ':id') }}`.replace(':id', row.dataset.id), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ quantity: quantity })
            }).then(response => response.json())
              .then(data => {
                  if (!data.success) {
                      console.error('Failed to update quantity');
                  }
              });
        });
    });

    document.getElementById('delivery-cost').addEventListener('change', updateGrandTotal);

    function updateGrandTotal() {
        const cartTotal = Array.from(document.querySelectorAll('.item-total'))
            .reduce((total, item) => total + parseFloat(item.textContent.replace('$', '').replace(',', '')), 0);
        const deliveryCost = parseFloat(document.getElementById('delivery-cost').value);
        const grandTotal = cartTotal + deliveryCost;
        document.getElementById('grand-total').textContent = grandTotal.toFixed(2);
        document.getElementById('cart-total').textContent = cartTotal.toFixed(2);
    }
    function confirmRemoval(form) {
        return confirm("Are you sure you want to remove this item from your cart?");
    }

</script>

<!-- Include Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #0a192f; /* Dark background for contrast */
    color: #ffffff; /* White text color */
}

.cart-container {
    max-width: 900px;
    margin: 20px auto;
    padding: 20px;
    background: #1e1e1e; /* Dark gray for the cart */
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
}

h1 {
    text-align: center;
    color: #ffffff; /* Neon blue for heading */
}

.alert {
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 5px;
}

.alert-success {
    background-color: #4caf50; /* Green for success */
}

.alert-danger {
    background-color: #f44336; /* Red for danger */
}

.continue-shopping {
    text-align: right;
    margin-bottom: 15px;
}

.continue-shopping-link {
    text-decoration: none;
    color: #00bcd4; /* Neon blue for continue shopping link */
}

.cart-table {
    width: 100%;
    border-collapse: collapse;
}

.cart-table th, .cart-table td {
    padding: 10px;
    border: 1px solid #555; /* Light gray border */
    text-align: left;
}

.cart-table th {
    background-color: #333; /* Darker gray for header */
    color: #ffffff; /* Neon blue for header text */
}

.cart-image {
    width: 60px;
    height: auto;
}

.quantity-controls {
    display: flex;
    align-items: center;
}

.quantity-btn {
    background-color: #1e1e1e; /* Neon blue */
    color: white;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    border-radius: 5px;
}

.quantity-input {
    width: 50px;
    text-align: center;
    border: 1px solid #1e1e1e; /* Neon blue border */
    border-radius: 5px;
    background-color: #444; /* Dark input background */
    color: white; /* White text */
}

.item-total {
    font-weight: bold;
}

.remove-item-btn {
    background-color: #f44336; /* Red for remove button */
    color: white;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    border-radius: 5px;
}

.remove-item-btn:hover {
    background-color: #c62828; /* Darker red on hover */
}

.cart-summary {
    margin-top: 20px;
    padding: 15px;
    background: #222; /* Dark background for summary */
    border-radius: 8px;
    box-shadow: 0 1px 5px rgba(0, 0, 0, 0.3);
}

.checkout-btn {
    display: inline-block;
    margin-top: 10px;
    padding: 10px 15px;
    background-color: #64FDDA; /* Neon blue for checkout button */
    color: #0A192F;
    text-decoration: none;
    border-radius: 5px;
}

.checkout-btn:hover {
    background-color: #0097a7; /* Darker blue on hover */
}

.empty-cart-message {
    text-align: center;
    margin-top: 50px;
}

.empty-cart-icon {
    font-size: 100px; /* Size of the empty cart icon */
    color: #00bcd4; /* Neon blue for icon */
}

.empty-cart-message p {
    font-size: 18px;
}

.continue-shopping-btn {
    display: inline-block;
    margin-top: 10px;
    padding: 10px 15px;
    background-color: #00bcd4; /* Neon blue for shopping button */
    color: white;
    text-decoration: none;
    border-radius: 5px;
}

.continue-shopping-btn:hover {
    background-color: #0097a7; /* Darker blue on hover */
}

</style>