@extends('layouts.adminlayout')

@section('title', 'Edit Category')

@section('content')
    <div class="breadcrumb">
        <a href="{{ route('admin.categories.index') }}">Categories</a> / 
        <a href="{{ route('admin.categories.edit', $category->id) }}">Edit</a>
    </div>
    
    <h1>Edit Category</h1>

    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="form-container">
        @csrf
        @method('PATCH')
        
        <div class="form-group">
            <label for="name">Category Name:</label>
            <input type="text" id="name" name="name" value="{{ $category->name }}" required>
        </div>

        <div class="form-group">
            <label for="slug">Slug:</label>
            <input type="text" id="slug" name="slug" value="{{ $category->slug }}" required>
        </div>
        
        <div class="button-group">
            <button type="submit" class="button update">Update</button>
            <a href="{{ route('admin.categories.index') }}" class="button cancel">Cancel</a>
        </div>
    </form>
@endsection

<style>
    .breadcrumb {
        margin-bottom: 20px;
        font-size: 14px;
        color: #999;
    }

    .breadcrumb a {
        color: inherit; /* Inherit the same color */
        text-decoration: none; /* Remove underline */
    }

    .breadcrumb a:hover {
        color: #FFFFFF; /* Change color on hover */
    }

    .form-container {
        max-width: 400px;
        margin: 0 auto;
        background-color: #1E1E1E;
        padding: 20px;
        border-radius: 8px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        color: #FFFFFF;
    }

    input[type="text"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #555;
        border-radius: 4px;
        background-color: #2C2C2C;
        color: #FFFFFF;
    }

    .button-group {
        display: flex;
        justify-content: space-between;
    }

    .button {
        padding: 10px 20px;
        text-align: center;
        border-radius: 4px;
        text-decoration: none;
        color: #FFFFFF;
        background-color: #8B7E72; /* Earthy brown color */
    }

    .button.cancel {
        background-color: #555555; /* Grey color for cancel */
    }

    .button.update {
        background-color: #8B7E72; /* Earthy brown color */
    }

    .button:hover {
        background-color: #6C675E; /* Darker earthy brown on hover */
    }

    .button.cancel:hover {
        background-color: #444444; /* Darker grey on hover for cancel */
    }
</style>
