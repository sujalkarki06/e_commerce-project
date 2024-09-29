@extends('layouts.adminlayout')

@section('content')
    <div class="container">
        <div class="header">
            <h1>Edit Order #{{ $order->id }}</h1>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- <div class="form-group">
                <label for="delivery_status">Order Status</label>
                <select id="delivery_status" name="delivery_status" class="form-control">
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div> --}}

            <div class="form-group">
                <label for="delivery_status">Delivery Status</label>
                <select id="delivery_status" name="delivery_status" class="form-control">
                    {{-- <option value="not_shipped" {{ $order->delivery_status == 'not_shipped' ? 'selected' : '' }}>Not Shipped</option>
                    <option value="shipped" {{ $order->delivery_status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="in_transit" {{ $order->delivery_status == 'in_transit' ? 'selected' : '' }}>In Transit</option>
                    <option value="delivered" {{ $order->delivery_status == 'delivered' ? 'selected' : '' }}>Delivered</option> --}}
                        <option value="pending" {{ $order->delivery_status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ $order->delivery_status == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="completed" {{ $order->delivery_status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $order->delivery_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <div class="form-group">
                <label for="tracking_number">Tracking Number</label>
                <input type="text" id="tracking_number" name="tracking_number" class="form-control"
                       value="{{ old('tracking_number', $order->tracking_number ?? generateRandomTrackingNumber()) }}">
            </div>

            <div class="form-group">
                <label for="shipping_provider">Shipping Provider</label>
                <select id="shipping_provider" name="shipping_provider" class="form-control">
                    <option value="DHL" {{ $order->shipping_provider == 'DHL' ? 'selected' : '' }}>DHL</option>
                    <option value="FedEx" {{ $order->shipping_provider == 'FedEx' ? 'selected' : '' }}>FedEx</option>
                    <option value="UPS" {{ $order->shipping_provider == 'UPS' ? 'selected' : '' }}>UPS</option>
                    <option value="USPS" {{ $order->shipping_provider == 'USPS' ? 'selected' : '' }}>USPS</option>
                </select>
            </div>

            <div class="form-group">
                <label for="estimated_delivery">Estimated Delivery Date</label>
                <input type="date" id="estimated_delivery" name="estimated_delivery" class="form-control"
                       value="{{ old('estimated_delivery', $order->estimated_delivery ? $order->estimated_delivery->format('Y-m-d') : '') }}">
            </div>

            <div class="form-group">
                <label for="transaction_id">Transaction Number</label>
                <input type="text" id="transaction_id" name="transaction_id" class="form-control" value="{{ old('transaction_id', $order->transaction_id ? $order->transaction_id : generateRandomTransactionId()) }}">
            </div>
            

            <div class="form-group">
                <button type="submit" class="btn btn-success">Update Order</button>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection

@php
    function generateRandomTrackingNumber() {
        return 'TRACK-' . strtoupper(bin2hex(random_bytes(6)));
    }

    function generateRandomTransactionId() {
        return 'TRANS-' . strtoupper(bin2hex(random_bytes(8)));
    }
@endphp

<style>
    /* adminlayout.css */

    /* Container styling */
    .container {
        padding: 20px;
        background-color: #2e2e2e; /* Dark gray background */
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Darker shadow for contrast */
        color: #e0e0e0; /* Light gray text for readability */
    }

    /* Header styling */
    .header {
        margin-bottom: 20px;
    }

    .header h1 {
        font-size: 24px;
        color: #e0e0e0; /* Light gray */
        border-bottom: 2px solid #007bff; /* Blue underline */
        padding-bottom: 10px;
    }

    /* Alert styling */
    .alert {
        margin-bottom: 20px;
        background-color: #f8d7da; /* Light red */
        border-color: #f5c6cb; /* Light red */
        color: #721c24; /* Dark red text */
    }

    /* Form group styling */
    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #e0e0e0; /* Light gray */
    }

    .form-control {
        width: 100%;
        padding: 8px;
        border: 1px solid #4f4f4f; /* Dark gray border */
        border-radius: 4px;
        background-color: #3a3a3a; /* Darker gray background */
        color: #e0e0e0; /* Light gray text */
    }

    .form-control:focus {
        border-color: #007bff; /* Blue border on focus */
        box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25); /* Blue shadow */
    }

    /* Textarea styling */
    textarea.form-control {
        height: 100px;
        resize: vertical;
    }

    /* Button styling */
    .btn {
        padding: 10px 15px;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
    }

    /* Success button styling */
    .btn-success {
        background-color: #28a745; /* Green */
        color: #fff; /* White text */
        border: 1px solid #28a745;
    }

    .btn-success:hover {
        background-color: #218838; /* Darker green */
        border-color: #1e7e34;
    }

    /* Secondary button styling */
    .btn-secondary {
        background-color: #6c757d; /* Gray */
        color: #fff; /* White text */
        border: 1px solid #6c757d;
    }

    .btn-secondary:hover {
        background-color: #5a6268; /* Darker gray */
        border-color: #545b62;
    }
</style>
