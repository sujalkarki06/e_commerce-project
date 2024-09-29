<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mountain Artisan Collective Footer</title>
    <style type="text/css">
        /* styles.css */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        footer {
            border-top: 3px solid #64FDDA; /* Teal border */
            background-color: #0F1217; /* Deep Black background */
            color: #FFFFFF; /* Pure White text */
            padding: 20px;
        }

        .footer-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .footer-content div {
            flex: 1;
            margin: 10px;
        }

        h2 {
            border-bottom: 2px solid #64FDDA; /* Teal border */
            padding-bottom: 10px;
            margin-bottom: 15px;
            color: #FFFFFF; /* Pure White text */
        }

        .contact-info p, .quick-links ul, .social-media a, .payment-methods img {
            margin: 5px 0;
            color: #CBD5F5; /* Light Blue text */
        }

        .quick-links ul {
            list-style: none;
            padding: 0;
        }

        .quick-links li {
            margin-bottom: 10px;
        }

        .quick-links a {
            color: #CBD5F5; /* Light Blue text */
            text-decoration: none;
        }

        .quick-links a:hover {
            text-decoration: underline;
            color: #64FDDA; /* Teal on hover */
        }

        .social-media img {
            width: 75px;
            height: 75px;
            margin: 0 5px;
        }

        .newsletter-signup form {
            display: flex;
        }

        .newsletter-signup input {
            padding: 5px;
            margin-right: 5px;
            border: none;
            border-radius: 3px;
            background-color: #CBD5F5; /* Light Blue background */
            color: #0F1217; /* Deep Black text */
        }

        .newsletter-signup button {
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            background-color: #64FDDA; /* Teal button */
            color: #0F1217; /* Deep Black text */
            cursor: pointer;
        }

        .newsletter-signup button:hover {
            background-color: #3F4246; /* Gray for hover effect */
        }

        .payment-methods img {
            width: 75px;
            height: auto;
            margin: 0 10px;
        }

        .footer-bottom {
            text-align: center;
            margin-top: 20px;
            color: #CBD5F5; /* Light Blue text */
        }
    </style>
</head>
<body>
    <footer>
        <div class="footer-content">
            <div class="contact-info">
                <h2>Contact Us</h2>
                <p>Phone: +977 (1) 123-4567</p>
                <p>Email: info@mountainartisan.com</p>
                <p>Address: Thamel, Kathmandu, Nepal</p>
                <a href="#" class="live-chat">Live Chat</a>
            </div>

            <div class="quick-links">
                <h2>Quick Links</h2>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('shop.index') }}">Shop</a></li>
                    <li><a href="{{ route('about.us') }}">About Us</a></li>
                    {{-- <li><a href="{{ route('faqs') }}">FAQ</a></li> --}}
                    <li><a href="{{ route('shipping_returns') }}">Shipping & Returns</a></li>
                    <li><a href="{{ route('privacy_policy') }}">Privacy Policy</a></li>
                    <li><a href="{{ route('terms_condition') }}">Terms & Conditions</a></li>
                    {{-- <li><a href="#">Gift Cards</a></li> --}}
                </ul>
            </div>

            <div class="social-media">
                <h2>Follow Us</h2>
                <a href="#"><img src="/images/facebook.png" alt="Facebook"></a>
                <a href="#"><img src="/images/instagram.png" alt="Instagram"></a>
                <a href="#"><img src="/images/twitter.png" alt="Twitter"></a>
                <a href="#"><img src="/images/linkedin.png" alt="LinkedIn"></a>
            </div>

            <div class="payment-methods">
                <h2>We Accept</h2>
                <img src="/images/visa.png" alt="Visa">
                <img src="/images/esewa.jpg" alt="e-Sewa">
                <img src="/images/paypal.png" alt="PayPal">
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2024 Mountain Artisan Collective. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>
