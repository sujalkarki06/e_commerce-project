@extends('layouts.adminlayout')

@section('content')
    <div class="container">
        <div class="header">
            <h1>Customers</h1>
        </div>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table customers-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td class="actions">
                            <a href="{{ route('admin.customers.show', $customer->id) }}" class="btn btn-view">View Details</a>
                        </td>
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

    .btn-view {
        background-color: #007BFF; /* Blue */
    }

    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
        color: #FFFFFF;
        background-color: #28a745; /* Green */
    }

    /* Table */
    .customers-table {
        width: 100%;
        border-collapse: collapse;
        background-color: #1E1E1E; /* Slightly lighter dark color */
        border-radius: 5px;
        overflow: hidden;
    }

    .customers-table th,
    .customers-table td {
        padding: 15px;
        text-align: left;
        color: #FFFFFF;
    }

    .customers-table th {
        background-color: #2E236C; /* Royal Blue for headers */
    }

    .customers-table tr {
        border-bottom: 1px solid #31363F; /* Border color */
    }

    .customers-table tr:last-child {
        border-bottom: none;
    }

    .customers-table tbody tr:nth-child(even) {
        background-color: #2A2A2A; /* Darker gray for alternate rows */
    }

    .customers-table tbody tr:hover {
        background-color: #333333; /* Slightly lighter dark color on hover */
    }

    .actions {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .btn-view {
        border: none;
        background: none;
        cursor: pointer;
        font-size: 16px;
        padding: 10px 15px;
        text-align: center;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        border-radius: 5px;
        background-color: #007BFF; /* Blue */
        color: #fff;
    }

    .btn-view:hover {
        opacity: 0.8;
    }
</style>
