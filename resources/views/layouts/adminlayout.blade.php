<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        /* General Styles */
        body {
            background-color: #121212; /* Dark background for the dashboard */
            color: #FFFFFF; /* Text color */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Header */
        header {
            background-color: #000000; /* Black background */
            color: #FFFFFF;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000; /* Ensure header is on top */
            box-shadow: 0 2px 4px rgba(0,0,0,0.5); /* Subtle shadow for separation */
        }

        header .logo {
            font-size: 1.5em;
            color: #FFFFFF;
        }

        header .profile-icon {
            color: #FFFFFF;
            cursor: pointer;
            padding: 5px 10px;
            border: 1px solid #555555;
            border-radius: 4px;
        }

        /* Sidebar */
        .sidebar {
            background-color: #000000; /* Black background */
            color: #FFFFFF;
            width: 250px;
            height: calc(100vh - 60px); /* Full height minus header height */
            position: fixed;
            top: 60px; /* Adjust for fixed header */
            left: 0;
            padding-top: 20px;
            overflow-y: auto; /* Scroll if content overflows */
            box-shadow: 2px 0 4px rgba(0,0,0,0.5); /* Subtle shadow for separation */
        }

        .sidebar a {
            margin-top: 20px;
            display: block;
            color: #FFFFFF;
            padding: 15px;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .sidebar a.active {
            background-color: #8B7E72; /* Earthy brown for active link */
        }

        .sidebar a:hover {
            background-color: #8B7E72; /* Earthy brown on hover */
        }

       /* Adjust main content to account for fixed header and sidebar */
.main-content {
    margin-left: 250px;
    margin-top: 60px; /* Adjust for fixed header */
    padding: 20px;
    color: #FFFFFF; /* Text color */
}

        .card {
            background-color: #1E1E1E; /* Slightly lighter dark color */
            padding: 20px;
            border-radius: 8px;
            flex: 1;
            color: #FFFFFF; /* Text color */
            min-width: 200px;
        }

        .card h3 {
            margin: 0;
            color: #FFFFFF; /* Heading color */
        }

        /* Footer */
        footer {
            background-color: #000000;
            color: #FFFFFF;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: calc(100% - 250px); /* Adjust width for fixed sidebar */
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            header {
                padding: 15px;
            }

            .sidebar {
                width: 200px;
                position: static;
                height: auto;
                display: flex;
                flex-direction: column;
                margin-bottom: 20px;
            }

            .main-content {
                margin-left: 0;
                padding: 20px;
            }

            footer {
                width: 100%;
                position: static;
                margin-top: 20px; /* Space for footer on top of content */
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo" aria-label="E-Commerce Logo">Mountain Artisan Collective</div>
        <div class="profile-icon" aria-label="User Profile">Profile</div>
    </header>

    <aside class="sidebar">
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
        <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.index') ? 'active' : '' }}">Categories</a>
        <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.index') ? 'active' : '' }}">Orders</a>
        <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.index') ? 'active' : '' }}">Products</a>
        <a href="{{ route('admin.customers.index') }}" class="{{ request()->routeIs('admin.customers.index') ? 'active' : '' }}">Customers</a>
        <a href="{{ route('admin.pages.index') }}" class="{{ request()->routeIs('admin.pages.index') ? 'active' : '' }}">Pages</a>
        <a href="{{ route('admin.reviews.index') }}">View Reviews</a>
        {{-- <a href="{{ route('admin.reviews.details', ['product' => $productId]) }}">View Review Details</a> --}}
        <a href="{{ route('admin.contacts.index') }}" class="{{ request()->routeIs('admin.contacts.index') ? 'active' : '' }}">Contact</a>

        <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

    </aside>

    <div class="main-content">
        @yield('content')
    </div>

    <footer>
        &copy; 2024 E-Commerce Dashboard. All rights reserved.
    </footer>
</body>
</html>
