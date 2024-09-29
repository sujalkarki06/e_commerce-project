@extends('layouts.adminlayout')

@section('content')
    <div class="categories-container">
        <h1>Categories</h1>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary add-category-btn">Add Category</a>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <table class="categories-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td class="actions">
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-action">Edit</a>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-action">Delete</button>
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

    /* Categories Container */
    .categories-container {
        padding: 20px;
        position: relative;
    }

    .categories-container h1 {
        margin-bottom: 20px;
        font-size: 24px;
        color: #FFFFFF;
    }

    .categories-container .btn {
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

    .btn-action {
        background-color: #31363F; /* Slate gray */
    }

    .btn-action:hover {
        opacity: 0.8;
    }

    .add-category-btn {
        position: absolute;
        right: 20px;
        top: 0;
    }

    /* Alert */
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
        color: #FFFFFF;
        background-color: #28a745; /* Green */
    }

    /* Categories Table */
    .categories-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
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

    .categories-table td.actions {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .btn-action {
        background-color: #8B7E72; /* Earthy brown */
    }

    .delete-form {
        margin: 0; /* Remove margin to avoid extra space */
    }

    .delete-form button {
        border: none;
        background: none;
        color: #FF6B6B; /* Red for delete button */
        cursor: pointer;
        font-size: 16px;
        padding: 10px 15px;
        text-align: center;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        border-radius: 5px;
    }

    .delete-form button:hover {
        opacity: 0.8;
    }
</style>
