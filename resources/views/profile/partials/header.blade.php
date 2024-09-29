<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Mountain Artisan Collective - Unique handmade handicrafts from Kathmandu, Nepal.">
    <meta name="keywords" content="Handicrafts, Nepal, Kathmandu, Thamel, Souvenirs, Wood Carvings, Metal Statues, Thangka">
    <meta name="author" content="Mountain Artisan Collective">
    <title>Mountain Artisan Collective | Handicrafts from Kathmandu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Styling */
        body {
            font-family: Arial, sans-serif;
            color: #CBD5F5;
            line-height: 1.6;
            background-color: #4C6078;
        }

        /* Header Styles */
        header {
            background-color: #0A192F;
            padding: 15px 20px;
            border-bottom: 3px solid #64FDDA;
            position: relative;
        }

        /* Logo */
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #CBD5F5;
            text-transform: uppercase;
            margin-right: auto;
        }
        .logo img {
            height: 75px;
            display: inline;
        }

        /* Navigation Bar */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        /* Navigation Menu */
        nav ul {
            list-style: none;
            display: flex;
            gap: 20px;
            margin-right: 20px;
        }

        nav ul li {
            position: relative;
        }

        nav ul li a {
            text-decoration: none;
            color: #CBD5F5;
            font-weight: bold;
            transition: color 0.3s, text-decoration 0.3s;
            position: relative;
        }

        nav ul li a:hover {
            color: #64FDDA;
        }

        /* Mobile Menu Button */
        .menu-btn {
            display: none;
            font-size: 24px;
            color: #CBD5F5;
            background: none;
            border: none;
            cursor: pointer;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            nav ul {
                display: none;
                flex-direction: column;
                width: 100%;
                margin-top: 10px;
                background-color: #0A192F;
                border-top: 3px solid #64FDDA;
            }

            nav ul.show {
                display: flex;
            }

            nav ul li {
                margin: 10px 0;
            }

            .menu-btn {
                display: block;
            }
        }

        /* Icons and Profile Icon */
        .icon, .profile-icon {
            font-size: 24px;
            margin-left: 15px;
            color: #CBD5F5;
            transition: color 0.3s, text-decoration 0.3s;
        }

        .icon:hover, .profile-icon:hover {
            color: #64FDDA;
        }

        /* Search Bar */
        .search-bar {
            display: flex;
            align-items: center;
            margin-right: 20px;
            border-radius: 4px;
            overflow: hidden;
        }

        .search-bar input[type="text"] {
            padding: 8px;
            border: none;
            border-radius: 0;
            width: 200px;
            font-size: 16px;
            background-color: #3F4246;
            color: #CBD5F5;
        }

        .search-bar button {
            padding: 8px 12px;
            border: none;
            background-color: #64FDDA;
            color: #0A192F;
            border-radius: 0;
            cursor: pointer;
            font-size: 16px;
        }

        .search-bar button:hover {
            background-color: #5F9E8E;
        }

        /* User Account Section */
        .user-account {
            display: flex;
            align-items: center;
            margin-left: 20px;
        }

        /* Dropdown Container */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        /* Dropdown Content (Hidden by Default) */
        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: #0A192F;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1000;
            border-radius: 4px;
            overflow: hidden;
        }

        /* Dropdown Links */
        .dropdown-content a {
            color: #CBD5F5;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            transition: background-color 0.3s;
        }

        /* Change color on hover */
        .dropdown-content a:hover {
            background-color: #3F4246;
        }

        /* Show the dropdown menu when the user clicks on the dropdown button */
        .dropdown-content.show {
            display: block;
        }

        /* Adjustments for Mobile */
        @media (max-width: 768px) {
            .dropdown-content {
                right: 20px;
            }
        }

    </style>
</head>
<body>

    <header>
        <nav>
            <!-- Logo -->
            <div class="logo">
                <a href="{{ route('home') }}"><img src="/images/logo.png" alt="Mountain Artisan Collective Logo"></a>
            </div>

            <!-- Mobile Menu Button -->
            <button class="menu-btn" id="menu-btn">&#9776;</button>

            <!-- Navigation Menu -->
            <ul id="nav-menu">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('shop.index') }}">Shop</a></li>
                <li><a href="{{ route('about.us') }}">About Us</a></li>
                <li><a href="{{ route('contact.submit') }}">Contact</a></li>
            </ul>

            <!-- Search Bar -->
            <form action="{{ route('search') }}" method="GET" class="search-bar">
                <input type="text" name="query" placeholder="Search Product..." required>
                <button type="submit">Search</button>
            </form>

            <!-- User Account Section -->
            <div class="user-account">
                @guest
                    <ul>
                        <li id="login" class="active"><a href="{{ route('login') }}" class="active">Login</a></li>
                        <li id="register" class="active"><a href="{{ route('register') }}" class="active">Register</a></li>
                    </ul>
                @else
                    <div class="dropdown">
                        <a href="#" class="profile-icon" id="profile-icon" title="Profile">
                            <i class="fas fa-user"></i>
                        </a>
                        <div class="dropdown-content" id="dropdown-content">
                            @if(Auth::user()->role == 1)
                                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                            @endif
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a href="{{ route('orders.index') }}">My Order</a>
                        </div>
                    </div>
                    <a href="{{ route('wishlist.index') }}" class="icon" title="Wishlist"><i class="fas fa-heart"></i></a>
                    <a href="{{ route('cart.index') }}" class="icon" title="Cart">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                @endguest
            </div>
        </nav>
    </header>

    <!-- Mobile Menu Script -->
    <script>
        document.getElementById('menu-btn').addEventListener('click', function() {
            var navMenu = document.getElementById('nav-menu');
            navMenu.classList.toggle('show');
        });

        document.getElementById('profile-icon').addEventListener('click', function() {
            var dropdownContent = document.getElementById('dropdown-content');
            dropdownContent.classList.toggle('show');
        });
    </script>
</body>
</html>
