{{-- resources/views/emails/shipping_status_updated.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Status Updated</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f6f6f6;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 20px;
        }
        .content h2 {
            color: #333;
            font-size: 20px;
        }
        .content p {
            color: #555;
            line-height: 1.6;
        }
        .order-details, .shipping-info {
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f9f9f9;
        }
        .order-details h3, .shipping-info h3 {
            margin: 0 0 10px;
            color: #007bff;
        }
        .footer {
            margin-top: 20px;
            padding: 10px;
            background-color: #f1f1f1;
            text-align: center;
            font-size: 12px;
            color: #aaa;
        }
        .footer a {
            color: #007bff;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
        .btn {
            display: inline-block;
            padding: 10px 15px;
            margin-top: 20px;
            background-color: #b4d6fb;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn:hover {
            background-color: #0056b3;
            color: #ffffff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        table th {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Your Order Update</h1>
        </div>
        <div class="content">
            <h2>Shipping Status Updated</h2>
            <p>Dear {{ $order->user->name }},</p>
            <p>We wanted to let you know that the shipping status of your order has been updated. Here are the details:</p>

            <div class="order-details">
                <h3>Order Details</h3>
                <p><strong>Current Shipping Status:</strong> <span style="color: #28a745;">{{ $order->delivery_status }}</span></p>
                <h4>Items in Your Order:</h4>
                <table>
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
                            <tr>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>${{ number_format($item->product->price, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <p><strong>Total Amount:</strong> ${{ number_format($order->total, 2) }}</p>
            </div>

            <div class="shipping-info">
                <h3>Shipping Information</h3>
                <p><strong>Delivery Status:</strong> {{ $order->delivery_status }}</p>
                <p><strong>Tracking Number:</strong> {{ $order->tracking_number }}</p>
                <p><strong>Shipping Provider:</strong> {{ $order->shipping_provider }}</p>
                <p><strong>Estimated Delivery Date:</strong> {{ \Carbon\Carbon::parse($order->estimated_delivery)->format('F j, Y') }}</p>
            </div>

            <p>Thank you for shopping with us! If you have any questions or need further assistance, please don't hesitate to reach out to our support team.</p>

            <a href="{{ url('/orders/'.$order->id) }}" class="btn">View Your Order</a>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Mountain Artisan. All rights reserved.</p>
            <p><a href="{{ url('/privacy-policy') }}">Privacy Policy</a> | <a href="{{ url('/terms-and-conditions') }}">Terms and Conditions</a></p>
        </div>
    </div>
</body>
</html>
