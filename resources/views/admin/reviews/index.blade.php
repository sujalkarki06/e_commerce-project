@extends('layouts.adminlayout')

@section('content')
    <h1>Reviews</h1>

    <table class="reviews-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Total Reviews</th>
                <th>Average Rating</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->reviews_count }}</td>
                    <td>{{ $product->reviews_avg_rating }}</td>
                    <td class="actions">
                        <a href="{{ route('admin.reviews.details', ['product' => $product->id]) }}" class="btn btn-details">View  Details</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
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
    }

    .header {
        margin-bottom: 20px;
    }

    h1 {
        font-size: 24px;
        color: #FFFFFF;
    }

    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
        color: #FFFFFF;
        background-color: #28a745; /* Green */
    }

    /* Table */
    .reviews-table {
        width: 100%;
        border-collapse: collapse;
        background-color: #1E1E1E; /* Slightly lighter dark color */
        border-radius: 5px;
        overflow: hidden;
    }

    .reviews-table th,
    .reviews-table td {
        padding: 15px;
        text-align: left;
        color: #FFFFFF;
    }

    .reviews-table th {
        background-color: #2E236C; /* Royal Blue for headers */
    }

    .reviews-table tr {
        border-bottom: 1px solid #31363F; /* Border color */
    }

    .reviews-table tr:last-child {
        border-bottom: none;
    }

    .reviews-table tbody tr:nth-child(even) {
        background-color: #2A2A2A; /* Darker gray for alternate rows */
    }

    .reviews-table tbody tr:hover {
        background-color: #333333; /* Slightly lighter dark color on hover */
    }

    .actions {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .btn {
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
        color: #FFFFFF;
        display: inline-block;
        font-size: 16px;
        text-align: center;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    .btn-details {
        background-color: #007bff; /* Blue for details button */
    }

    .btn-details:hover {
        opacity: 0.8;
    }
</style>
