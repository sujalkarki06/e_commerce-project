@extends('layouts.applayout')

@section('content')

<div class="orders-container">
    <h1>My Orders</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    @if($orders->isEmpty())
        <div class="no-orders">
            <div class="no-orders-icon">
                <i class="fas fa-shopping-cart"></i> <!-- Font Awesome shopping cart icon -->
            </div>
            <p class="no-orders-message">You have no orders yet.</p>
            <p class="suggestion-message">Start shopping to create your first order!</p>
            <a href="{{ route('shop.index') }}" class="shop-now-btn">Shop Now</a>
        </div>
    @else
        <table class="orders-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders->sortByDesc('created_at') as $order)
                    @foreach($order->items as $item)
                        <tr>
                            <td>
                                @if($item->product && $item->product->image)
                                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="product-image">
                                @else
                                    <img src="{{ asset('path/to/default/image.png') }}" alt="Default Image" class="product-image">
                                @endif
                            </td>
                            <td>{{ $item->product ? $item->product->name : 'Unknown Product' }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ number_format($item->price, 2) }}</td>
                            <td>${{ number_format($order->total, 2) }}</td>
                            <td>{{ ucfirst($order->status) }}</td>
                            <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                <a href="{{ route('orders.show', $order->id) }}" class="view-details-btn">View Details</a>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

<style>

.alert-success {
        padding: 15px;
        background-color: #d4edda; /* Light green background */
        color: #155724; /* Dark green text */
        border: 1px solid #c3e6cb; /* Light green border */
        border-radius: 5px;
        margin-bottom: 20px;
        text-align: center; /* Center text */
    }
    /* orders.css */

    .orders-container {
        padding: 20px;
        background-color: #131f41; /* Very Light Gray */
        color: #e9edf1; /* Almost Black */
    }

    .orders-container h1 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .no-orders {
        text-align: center;
        margin-top: 50px;
    }

    .no-orders-icon {
        font-size: 60px; /* Adjust size as needed */
        color: #64FDDA; /* Warm Medium Brown */
        margin-bottom: 20px;
    }

    .no-orders-message {
        font-size: 18px;
        color: #8094ed; /* Warm Medium Brown */
        margin-bottom: 10px;
    }

    .suggestion-message {
        font-size: 16px;
        color: #e9edf1; /* Light color for contrast */
        margin-bottom: 20px;
    }

    .shop-now-btn {
        display: inline-block;
        padding: 10px 15px;
        background-color: #64FDDA; /* Warm Medium Brown */
        color: #0e0e0f; /* White */
        text-decoration: none;
        border-radius: 4px;
        font-size: 16px;
    }

    .shop-now-btn:hover {
        background-color: #CBD5F5; /* Darker shade of Warm Medium Brown */
    }

    .orders-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .orders-table th, .orders-table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .orders-table th {
        background-color: #1b2239; /* Almost Black */
        color: #F2F2F2; /* Very Light Gray */
    }

    .orders-table td {
        background-color: #03082e; /* Slightly lighter shade */
    }

    .orders-table img.product-image {
        width: 50px;
        height: 50px;
        object-fit: cover;
    }

    .orders-table tr:hover {
        background-color: #F5F5F5; /* Light Gray */
    }

    .view-details-btn {
        display: inline-block;
        padding: 8px 12px;
        background-color: #BF6F4A; /* Warm Medium Brown */
        color: #FFFFFF; /* White */
        text-decoration: none;
        border-radius: 4px;
        font-size: 14px;
    }

    .view-details-btn:hover {
        background-color: #64FDDA; /* Darker shade of Warm Medium Brown */
    }
</style>
