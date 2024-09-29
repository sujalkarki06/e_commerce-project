@extends('layouts.adminlayout')

@section('content')
    <div class="container">
        <!-- Go Back Link -->
        <a href="{{ route('admin.reviews.index') }}" class="go-back-link">Go Back to Reviews List</a>

        <h1>Reviews for {{ $product->name }}</h1>

        <table class="reviews-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Rating</th>
                    <th>Comment</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reviews as $review)
                    <tr>
                        <td>{{ $review->id }}</td>
                        <td>{{ $review->user->name }}</td>
                        <td>{{ $review->rating }}</td>
                        <td>{{ $review->comment }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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

    .container {
        padding: 20px;
    }

    .go-back-link {
        display: inline-block;
        margin-bottom: 20px;
        padding: 10px 15px;
        color: #007bff; /* Blue color for the link */
        text-decoration: none;
        border: 1px solid #007bff; /* Blue border */
        border-radius: 5px;
        background-color: transparent;
    }

    .go-back-link:hover {
        background-color: #007bff; /* Blue background on hover */
        color: #FFFFFF; /* White text on hover */
    }

    h1 {
        font-size: 24px;
        color: #FFFFFF;
        margin-bottom: 20px;
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
</style>
