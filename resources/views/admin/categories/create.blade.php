@extends('layouts.adminlayout')

@section('title', 'Add Category')

@section('content')

<div class="breadcrumb">
    <a href="{{ route('admin.categories.index') }}">Categories</a> / 
    <a href="{{ route('admin.categories.create') }}">Create</a>
</div>

<div class="add-category-container">
    <h1>Add Category</h1>
    <form action="{{ route('admin.categories.store') }}" method="POST" class="add-category-form">
        @csrf
        <div class="form-group">
            <label for="name">Category Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="slug">Slug:</label>
            <input type="text" id="slug" name="slug" required>
        </div>
        <div class="button-group">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-cancel">Cancel</a>
        </div>
    </form>
</div>

@endsection

<style>
    /* Breadcrumb Styles */
    .breadcrumb {
        margin-bottom: 20px;
        font-size: 14px;
        color: #FFFFFF;
    }

    .breadcrumb a {
        color: #8B7E72; /* Earthy brown color */
        text-decoration: none;
    }

    .breadcrumb a:hover {
        text-decoration: underline;
    }

    /* Add Category Form Styles */
    .add-category-container {
        padding: 20px;
        background-color: #1E1E1E; /* Slightly lighter dark color */
        border-radius: 8px;
        max-width: 600px;
        margin: 0 auto; /* Center the form */
    }

    .add-category-container h1 {
        font-size: 24px;
        margin-bottom: 20px;
        color: #FFFFFF;
    }

    .add-category-form .form-group {
        margin-bottom: 20px;
    }

    .add-category-form label {
        display: block;
        font-size: 16px;
        margin-bottom: 5px;
        color: #FFFFFF;
    }

    .add-category-form input[type="text"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #31363F; /* Slate gray border */
        border-radius: 5px;
        background-color: #121212; /* Dark input background */
        color: #FFFFFF;
        font-size: 16px;
    }

    .add-category-form input[type="text"]::placeholder {
        color: #AAAAAA; /* Placeholder color */
    }

    .add-category-form input[type="text"]:focus {
        border-color: #8B7E72; /* Earthy brown border on focus */
        outline: none;
    }

    .button-group {
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
    }

    .btn {
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
        font-size: 16px;
        color: #FFFFFF;
    }

    .btn-primary {
        background-color: #8B7E72; /* Earthy brown */
    }

    .btn-cancel {
        background-color: #555555; /* Grey color for cancel */
    }

    .btn:hover {
        opacity: 0.8;
    }
</style>
