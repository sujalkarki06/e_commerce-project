<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            max-width: 150px;
            height: auto;
        }

        .thank-you {
            font-size: 26px;
            color: #333;
            margin: 15px 0;
            font-weight: bold;
        }

        .details {
            font-size: 16px;
            color: #555;
            margin: 10px 0;
        }

        .address-section {
            margin: 20px 0;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f2f2f2;
        }

        .address-section h2 {
            margin: 0 0 10px;
            font-size: 18px;
            color: #333;
        }

        .invoice {
            margin: 20px 0;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .invoice-table th,
        .invoice-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .total-row {
            font-weight: bold;
            background-color: #eaeaea;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        .social-icons a {
            margin: 0 5px;
            color: #333;
            text-decoration: none;
        }

        .social-icons a:hover {
            color: #4A90E2;
        }

        .invoice-icon {
            width: 24px;
            height: 24px;
            margin-right: 5px;
            vertical-align: middle;
        }

        .contact-link {
            color: #4A90E2;
            text-decoration: none;
        }

        .contact-link:hover {
            text-decoration: underline;
        }

        .shipping-details {
            margin-top: 20px;
            font-size: 16px;
            color: #555;
        }

        .support-section {
            margin-top: 30px;
            font-size: 16px;
            color: #333;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .support-section h3 {
            margin-bottom: 10px;
            color: #333;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            {{-- <img src="{{ asset('path/to/your/logo.png') }}" alt="Company Logo"> --}}
            <h1>Order Confirmation</h1>
        </div>

        <p class="thank-you">Thank you for your order, {{ $order->user->name }}!</p>
        <p class="details">
            We appreciate your business and are excited to fulfill your order! You will receive a notification once your order is shipped. Below are the details of your purchase.
        </p>


        <div class="address-section">
            <h2>Shipping Address</h2>
            <p>{{ $order->address }}</p>
            <p>{{ $order->city }}, {{ $order->country }}</p>
        </div>

        <div class="invoice">
            {{-- <h2><img src="{{ asset('path/to/invoice-icon.png') }}" alt="Invoice Icon" class="invoice-icon">Invoice</h2> --}}
            <table class="invoice-table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ number_format($item->price, 2) }}</td>
                        <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                    @endforeach
                    <tr class="total-row">
                        <td colspan="3" style="text-align: right;">Total:</td>
                        <td>${{ number_format($order->total, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="support-section">
            <h3>Need Assistance?</h3>
            <p>If you have any questions or need assistance with your order, please feel free to reach out to our dedicated customer support team. We are here to help you!</p>
            <p>Email: <a href="mailto:support@yourcompany.com" class="contact-link">support@yourcompany.com</a></p>
            <p>Phone: <strong>(123) 456-7890</strong></p>
        </div>

        <p class="details">If you have any questions about your order, please <a href="mailto:support@yourcompany.com" class="contact-link">contact us</a>.</p>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Mountain Artisan. All rights reserved.</p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-square"></i></a>
                <a href="#"><i class="fab fa-twitter-square"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
</body>

</html>
