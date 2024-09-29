@extends('layouts.adminlayout')

@section('content')
    <div class="container">
        <div class="header">
            <h1>Pages</h1>
            <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">Add Page</a>
        </div>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        @if($pages->isEmpty())
            <div class="alert alert-info">No pages found.</div>
        @else
            <table class="pages-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pages as $page)
                        <tr>
                            <td>{{ $page->title }}</td>
                            <td class="actions">
                                <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-edit">Edit</a>
                                <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete">Delete</button>
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

    .btn-primary {
        background-color: #8B7E72; /* Earthy brown */
    }

    .btn-edit {
        background-color: #ffc107; /* Warning yellow */
    }

    .btn-delete {
        background-color: #dc3545; /* Danger red */
    }

    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
        color: #FFFFFF;
    }

    .alert-info {
        background-color: #17a2b8; /* Info Blue */
    }

    .alert-success {
        background-color: #28a745; /* Success Green */
    }

    /* Table */
    .pages-table {
        width: 100%;
        border-collapse: collapse;
        background-color: #1E1E1E; /* Slightly lighter dark color */
        border-radius: 5px;
        overflow: hidden;
    }

    .pages-table th,
    .pages-table td {
        padding: 15px;
        text-align: left;
        color: #FFFFFF;
    }

    .pages-table th {
        background-color: #2E236C; /* Royal Blue for headers */
    }

    .pages-table tr {
        border-bottom: 1px solid #31363F; /* Border color */
    }

    .pages-table tr:last-child {
        border-bottom: none;
    }

    .pages-table tbody tr:nth-child(even) {
        background-color: #2A2A2A; /* Darker gray for alternate rows */
    }

    .pages-table tbody tr:hover {
        background-color: #333333; /* Slightly lighter dark color on hover */
    }

    .actions {
        display: flex;
        gap: 10px;
        align-items: center;
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
