@extends('layouts.applayout')

@section('content')
<div class="payment-container">
    <h1>Payment Details</h1>

    @if($paymentMethod === 'credit_card' || $paymentMethod === 'debit_card')
        <form action="{{ route('payment.store') }}" method="POST">
            @csrf
            <input type="hidden" name="payment_method" value="{{ $paymentMethod }}">
            <div class="form-group">
                <label for="card_number">Card Number:</label>
                <input type="text" id="card_number" name="card_number" class="form-control" placeholder="1234 5678 9012 3456" required>
            </div>
            <div class="form-group">
                <label for="card_expiry">Expiry Date:</label>
                <div class="expiry-container">
                    <input type="text" id="card_expiry" name="card_expiry" class="form-control" placeholder="MM/YY" required>
                    <input type="text" id="card_cvv" name="card_cvv" class="form-control" placeholder="CVV" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Pay Now</button>
        </form>
    @elseif($paymentMethod === 'paypal')
        <form action="{{ route('payment.store') }}" method="POST">
            @csrf
            <input type="hidden" name="payment_method" value="{{ $paymentMethod }}">
            <div class="form-group">
                <label for="paypal_email">PayPal Email:</label>
                <input type="email" id="paypal_email" name="paypal_email" class="form-control" placeholder="you@example.com" required>
            </div>
            <button type="submit" class="btn btn-primary">Pay Now</button>
        </form>
    @elseif($paymentMethod === 'e_sewa')
        <form action="{{ route('payment.store') }}" method="POST">
            @csrf
            <input type="hidden" name="payment_method" value="{{ $paymentMethod }}">
            <div class="form-group">
                <label for="esewa_number">e-Sewa Number:</label>
                <input type="text" id="esewa_number" name="esewa_number" class="form-control" placeholder="your-esewa-number" required>
            </div>
            <button type="submit" class="btn btn-primary">Pay Now</button>
        </form>
    @else
        <p class="alert alert-warning">Please select a valid payment method.</p>
    @endif
</div>
@endsection


<style>
    /* CSS Reset */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Arial', sans-serif;
    }

    body {
        background-color: #0b0c10; /* Dark background for the page */
        color: #c5c6c7; /* Light gray text color */
    }

    .payment-container {
        max-width: 600px;
        margin: 50px auto;
        padding: 30px;
        background-color: #1f2833; /* Darker card background */
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Subtle shadow for elevation */
    }

    .payment-container h1 {
        font-size: 26px;
        margin-bottom: 30px;
        text-align: center; /* Centered heading */
        color: #66fcf1; /* Neon teal */
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #66fcf1; /* Neon teal */
    }

    .form-group input {
        width: 100%;
        padding: 12px;
        border: 1px solid #45a29e; /* Teal border */
        border-radius: 6px;
        background-color: #1f2833; /* Dark input background */
        color: #c5c6c7; /* Light text color for input */
        transition: border-color 0.3s ease;
    }

    .form-group input:focus {
        border-color: #66fcf1; /* Neon teal border on focus */
        outline: none; /* Remove default outline */
    }

    .expiry-container {
        display: flex; /* Flexbox for expiry and CVV */
        justify-content: space-between; /* Space between fields */
    }

    .expiry-container input {
        flex: 1; /* Equal width for both fields */
        margin-right: 10px; /* Space between fields */
    }

    .expiry-container input:last-child {
        margin-right: 0; /* Remove margin for last input */
    }

    .btn-primary {
        width: 100%; /* Full width for button */
        padding: 12px;
        background-color: #45a29e; /* Teal button color */
        color: #ffffff; /* White text */
        border: none;
        border-radius: 6px;
        font-size: 18px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #66fcf1; /* Neon teal on hover */
    }

    .alert-warning {
        padding: 15px;
        background-color: #ffcc00; /* Warning background color */
        color: #111; /* Dark text for contrast */
        border: 1px solid #ffeeba; /* Warning border */
        border-radius: 5px;
        margin-top: 20px;
        text-align: center; /* Center text */
    }
</style>
