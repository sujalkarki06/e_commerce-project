@extends('layouts.adminlayout')

@section('content')
    <div class="container">
        <h1>Admin Dashboard</h1>

        <div class="dashboard-cards">
            <div class="card">
                <h3>Total Orders</h3>
                <p>{{ $totalOrders }}</p>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">View Orders</a>
            </div>
            <div class="card">
                <h3>Total Products</h3>
                <p>{{ $totalProducts }}</p>
                <a href="{{ route('admin.products.index') }}" class="btn btn-primary">View Products</a>
            </div>
            <div class="card">
                <h3>Total Customers</h3>
                <p>{{ $totalCustomers }}</p>
                <a href="{{ route('admin.pages.index') }}" class="btn btn-primary">View Customers</a>
            </div>
            <div class="card">
                <h3>Total Pages</h3>
                <p>{{ $totalPages }}</p>
                <a href="{{ route('admin.pages.index') }}" class="btn btn-primary">View Pages</a>
            </div>
        </div>
    </div>
@endsection

<style>
    /* General Styles */
    body {
        background-color: #121212;
        color: #FFFFFF;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    /* Container */
    .container {
        padding: 20px;
        max-width: 1200px;
        margin: 0 auto;
    }

    h1 {
        font-size: 24px;
        color: #FFFFFF;
        margin-bottom: 20px;
    }

    /* Dashboard Cards */
    .dashboard-cards {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
    }

    .card {
        background-color: #1E1E1E;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        text-align: center;
    }

    .card h3 {
        font-size: 18px;
        color: #FFFFFF;
        margin-bottom: 10px;
    }

    .card p {
        font-size: 24px;
        color: #8B7E72; /* Earthy brown */
        margin-bottom: 15px;
    }

    .btn-primary {
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        background-color: #8B7E72; /* Earthy brown */
        color: #FFFFFF;
        cursor: pointer;
        font-size: 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    .btn-primary:hover {
        background-color: #7a6d5e; /* Slightly darker earthy brown on hover */
    }
</style>
