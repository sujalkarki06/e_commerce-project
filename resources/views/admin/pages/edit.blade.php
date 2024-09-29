@extends('layouts.adminlayout')

@section('content')
    <div class="container">
        <h1>Edit Page</h1>

        <form action="{{ route('admin.pages.update', $page->id) }}" method="POST" class="page-form">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $page->title }}" required>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" id="content" class="form-control" rows="10" required>{{ $page->content }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Page</button>
        </form>
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
        max-width: 800px;
        margin: 0 auto;
    }

    h1 {
        font-size: 24px;
        color: #FFFFFF;
        margin-bottom: 20px;
    }

    /* Form Styles */
    .page-form {
        background-color: #1E1E1E;
        padding: 20px;
        border-radius: 5px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        font-size: 16px;
        color: #CCCCCC;
        margin-bottom: 5px;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #333333;
        border-radius: 5px;
        background-color: #2A2A2A;
        color: #FFFFFF;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        border-color: #4A4A4A;
        outline: none;
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
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        text-decoration: none;
        display: inline-block;
    }

    .btn-primary:hover {
        background-color: #7a6d5e; /* Slightly darker earthy brown on hover */
    }
</style>
