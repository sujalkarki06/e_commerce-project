@extends('layouts.applayout')

@section('content')
<div class="order-show-container">
    <h1>Order Details</h1>

    {{-- Order Summary --}}
    <div class="section order-summary">
        <h2>Order Summary</h2>
        <p>Date: {{ $order->created_at->format('Y-m-d H:i') }}</p>
        <p>Total: ${{ number_format($order->total, 2) }}</p>
        <p>Status: {{ ucfirst($order->status) }}</p>
    </div>

    {{-- Shipping Address --}}
    <div class="section shipping-address">
        <h2>Shipping Address</h2>
        <address>
            {{ $order->name }}<br>
            {{ $order->address }}<br>
            {{ $order->city }}, {{ $order->postal_code }}<br>
            {{ $order->country }}<br>
            Phone: {{ $order->phone }}
        </address>
    </div>

    {{-- Shipment Details --}}
    <div class="section shipment-details">
        <h2>Shipment Details</h2>
        <p>Delivery Status: {{ ucfirst($order->delivery_status) }}</p>
        <p>Tracking Number: {{ $order->tracking_number ?? 'N/A' }}</p>
        {{-- <p>Estimated Delivery Date: {{ $order->estimated_delivery ? $order->estimated_delivery->format('Y-m-d') : 'N/A' }}</p> --}}
        <p>Shipping Provider: {{ $order->shipping_provider ?? 'N/A' }}</p>
    </div>

    {{-- Payment Information --}}
    <div class="section payment-information">
        <h2>Payment Information</h2>
        <p>Payment Method: {{ ucfirst($order->payment_method) }}</p>
        <p>Payment Status: {{ ucfirst($order->payment_status) }}</p>
        <p>Transaction ID: {{ $order->transaction_id ?? 'N/A' }}</p>
    </div>

    {{-- Order Items --}}
    {{-- <table class="order-items-table">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
                <th>Details</th>
            </tr>
        </thead> --}}
        {{-- <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->price, 2) }}</td>
                    <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                    <td>
                        <button class="details-btn" data-target="#details-{{ $item->id }}">View Details</button>
                        <div id="details-{{ $item->id }}" class="details-content">
                            <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="product-image">
                            <p><strong>Description:</strong> {{ $item->product->description }}</p>
                            <p><strong>Additional Info:</strong> {{ $item->product->additional_info }}</p>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table> --}}

    <a href="{{ route('orders.index') }}" class="back-to-orders-btn">Back to Orders</a>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.details-btn').forEach(button => {
            button.addEventListener('click', function () {
                const targetId = this.getAttribute('data-target');
                const content = document.querySelector(targetId);
                content.classList.toggle('show');
                this.textContent = content.classList.contains('show') ? 'Hide Details' : 'View Details';
            });
        });
    });
</script>
@endsection

<style>
    /* order-details.css */

.order-show-container {
    padding: 20px;
    background-color: #0A192F; /* Dark Cyan-Blue */
    color: #CBD5F5; /* Light Blue */
}

.order-show-container h1 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #64FDDA; /* Teal */
}

.section {
    background-color: #1B2A49; /* Slightly Lighter Dark Cyan-Blue */
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.section h2 {
    font-size: 20px;
    margin-bottom: 10px;
    color: #64FDDA; /* Teal */
}

.order-items-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.order-items-table th, .order-items-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #CBD5F5; /* Light Blue */
}

.order-items-table th {
    background-color: #1B2A49; /* Slightly Lighter Dark Cyan-Blue */
    color: #64FDDA; /* Teal */
}

.order-items-table td {
    background-color: #0A192F; /* Dark Cyan-Blue */
    color: #CBD5F5; /* Light Blue */
}

.order-items-table tr:hover {
    background-color: #1B2A49; /* Slightly Lighter Dark Cyan-Blue */
}

.product-image {
    width: 50px;
    height: 50px;
    object-fit: cover;
}

.details-btn {
    background-color: #64FDDA; /* Teal */
    color: #0A192F; /* Dark Cyan-Blue */
    border: none;
    padding: 5px 10px;
    border-radius: 4px;
    cursor: pointer;
}

.details-btn:hover {
    background-color: #CBD5F5; /* Light Blue */
    color: #0A192F; /* Dark Cyan-Blue */
}

.details-content {
    display: none;
    background-color: #1B2A49; /* Slightly Lighter Dark Cyan-Blue */
    border-radius: 4px;
    padding: 10px;
    margin-top: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.details-content.show {
    display: block;
}

.back-to-orders-btn {
    display: inline-block;
    padding: 10px 15px;
    background-color: #64FDDA; /* Teal */
    color: #0A192F; /* Dark Cyan-Blue */
    text-decoration: none;
    border-radius: 4px;
    font-size: 16px;
    margin-top: 20px;
}

.back-to-orders-btn:hover {
    background-color: #CBD5F5; /* Light Blue */
    color: #0A192F; /* Dark Cyan-Blue */
}

</style>