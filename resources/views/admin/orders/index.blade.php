@extends('layouts.adminlayout')

@section('content')
    <div class="container">
        <div class="header">
            <h1>Orders</h1>
        </div>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($orders->isEmpty())
            <div class="no-orders-message">
                <p>No orders found.</p>
            </div>
        @else
            <table class="table orders-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Phone Number</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Delivery Status</th> <!-- New Column for Delivery Status -->
                        <th>Purchase Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->name ?? 'Guest' }}</td>
                            <td>{{ $order->phone ?? 'N/A' }}</td>
                            <td>${{ number_format($order->total, 2) }}</td>
                            <td>{{ ucfirst($order->status) }}</td>
                            <td>{{ ucfirst($order->delivery_status) }}</td> <!-- Display Delivery Status -->
                            <td>{{ $order->created_at->format('Y-m-d') }}</td>
                            <td class="actions">
                                {{-- <a href="{{ route('orders.show', $order->id) }}" class="btn btn-view">View Details</a> --}}
                                <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-edit">Edit</a>
                                {{-- <a href="{{ route('admin.orders.deliver', $order->id) }}" class="btn btn-deliver">Delivered</a> <!-- New Delivery Button --> --}}
                                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="delete-form" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this order?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
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
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    h1 {
        font-size: 24px;
        color: #FFFFFF;
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
    .btn-deliver {
        background-color: #4CAF50; /* Green for delivery */
    }

    .btn-deliver:hover {
        opacity: 0.8;
    }

    .btn-view {
        background-color: #008CBA; /* Blue */
    }

    .btn-edit {
        background-color: #ffc107; /* Yellow */
    }

    .btn-delete {
        background-color: #dc3545; /* Danger red */
    }

    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
        color: #FFFFFF;
        background-color: #28a745; /* Green */
    }

    /* Table */
    .orders-table {
        width: 100%;
        border-collapse: collapse;
        background-color: #1E1E1E; /* Slightly lighter dark color */
        border-radius: 5px;
        overflow: hidden;
    }

    .orders-table th,
    .orders-table td {
        padding: 15px;
        text-align: left;
        color: #FFFFFF;
    }

    .orders-table th {
        background-color: #2E236C; /* Royal Blue for headers */
    }

    .orders-table tr {
        border-bottom: 1px solid #31363F; /* Border color */
    }

    .orders-table tr:last-child {
        border-bottom: none;
    }

    .orders-table tbody tr:nth-child(even) {
        background-color: #2A2A2A; /* Darker gray for alternate rows */
    }

    .orders-table tbody tr:hover {
        background-color: #333333; /* Slightly lighter dark color on hover */
    }

    .actions {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .delete-form {
        margin: 0; /* Remove margin to avoid extra space */
    }

    .btn-view, .btn-edit, .btn-delete {
        border: none;
        background: none;
        cursor: pointer;
        font-size: 16px;
        padding: 10px 15px;
        text-align: center;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        border-radius: 5px;
    }

    .btn-view:hover, .btn-edit:hover, .btn-delete:hover {
        opacity: 0.8;
    }

    /* No Orders Message */
    .no-orders-message {
        text-align: center;
        padding: 20px;
        background-color: #1E1E1E;
        border-radius: 5px;
    }

    .no-orders-message p {
        color: #FFFFFF;
        font-size: 18px;
    }
</style>
