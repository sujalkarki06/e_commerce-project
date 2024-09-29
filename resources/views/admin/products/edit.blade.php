@extends('layouts.adminlayout')

@section('content')
    <div class="container">
        <div class="header">
            <h1>Edit Product</h1>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Back to Products</a>
        </div>
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="product-form">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name) }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control">{{ old('description', $product->description) }}</textarea>
            </div>
            <div class="form-group">
                <label for="price">Price ($)</label>
                <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ old('price', $product->price) }}" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity', $product->quantity) }}" required>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control">
                @if($product->image)
                    <img src="{{ asset('uploads/' . $product->image) }}" alt="Product Image" class="img-thumbnail mt-2" style="width: 150px;">
                @endif
            </div>
            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-buttons">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
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

    .btn-secondary {
        background-color: #6c757d; /* Bootstrap secondary color */
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        color: #FFFFFF;
    }

    .form-control {
        width: calc(100% - 20px); /* Slightly smaller width */
        padding: 10px;
        border: 1px solid #333333;
        border-radius: 5px;
        background-color: #1E1E1E;
        color: #FFFFFF;
    }

    .form-control:focus {
        border-color: #8B7E72; /* Earthy brown */
        outline: none;
    }

    #description {
        height: 150px; /* Increased height for description */
    }

    .form-buttons {
        display: flex;
        gap: 10px;
        margin-top: 20px;
    }

    .form-buttons .btn {
        text-align: center;
    }

    .img-thumbnail {
        border: 1px solid #333;
        border-radius: 5px;
    }
</style>
