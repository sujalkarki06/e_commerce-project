@extends('layouts.adminlayout')

@section('content')
    <div class="container">
        <div class="header">
            <h1>Products</h1>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add Product</a>
        </div>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table categories-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>${{ $product->price }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->category->name ?? 'No Category' }}</td>
                        <td class="actions">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-edit">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="delete-form" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete">Delete</button>
                            </form>
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

    .btn-primary {
        background-color: #8B7E72; /* Earthy brown */
    }

    .btn-edit {
        background-color: #ffc107; /* Warning yellow */
        color: #fff;
    }

    .btn-delete {
        background-color: #dc3545; /* Danger red */
        color: #fff;
    }

    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
        color: #FFFFFF;
        background-color: #28a745; /* Green */
    }

    /* Table */
    .categories-table {
        width: 100%;
        border-collapse: collapse;
        background-color: #1E1E1E; /* Slightly lighter dark color */
        border-radius: 5px;
        overflow: hidden;
    }

    .categories-table th,
    .categories-table td {
        padding: 15px;
        text-align: left;
        color: #FFFFFF;
    }

    .categories-table th {
        background-color: #2E236C; /* Royal Blue for headers */
    }

    .categories-table tr {
        border-bottom: 1px solid #31363F; /* Border color */
    }

    .categories-table tr:last-child {
        border-bottom: none;
    }

    .categories-table tbody tr:nth-child(even) {
        background-color: #2A2A2A; /* Darker gray for alternate rows */
    }

    .categories-table tbody tr:hover {
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

    .btn-edit, .btn-delete {
        border: none;
        background: none;
        cursor: pointer;
        font-size: 16px;
        padding: 10px 15px;
        text-align: center;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        border-radius: 5px;
    }

    .btn-edit:hover, .btn-delete:hover {
        opacity: 0.8;
    }

    .btn-delete {
        color: #FF6B6B; /* Red for delete button */
    }
</style>
