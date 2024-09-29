<!-- resources/views/reviews/show.blade.php -->

@extends('layouts.applayout')

@section('content')
<div class="container">
    <h1>{{ $product->name }}</h1>
    <div class="product-reviews">
        <h2>Reviews</h2>
        @foreach ($reviews as $review)
            <div class="review">
                <h3>{{ $review->user->name }} - {{ $review->rating }}/5</h3>
                <p>{{ $review->comment }}</p>
                <small>{{ $review->created_at->diffForHumans() }}</small>
            </div>
        @endforeach
        
        @auth
        <h3>Write a Review</h3>
        <form action="{{ route('reviews.store', $product->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="rating">Rating:</label>
                <select name="rating" id="rating" class="form-control" required>
                    <option value="" disabled selected>Select Rating</option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="form-group">
                <label for="comment">Comment:</label>
                <textarea name="comment" id="comment" class="form-control" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Review</button>
        </form>
        @endauth
    </div>
</div>
@endsection

<style>
    /* public/css/reviews.css */

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.product-reviews {
    margin-top: 20px;
}

.product-reviews h2 {
    font-size: 24px;
    color: #333;
    margin-bottom: 15px;
    border-bottom: 2px solid #e0e0e0;
    padding-bottom: 5px;
}

.review {
    border-bottom: 1px solid #ddd;
    padding: 15px 0;
    margin-bottom: 15px;
    transition: background-color 0.2s ease;
}

.review:hover {
    background-color: #f9f9f9;
}

.review h3 {
    margin: 0;
    font-size: 18px;
    color: #555;
    font-weight: 600;
}

.review p {
    margin: 10px 0;
    font-size: 16px;
    color: #333;
    line-height: 1.5;
}

.review small {
    color: #999;
    font-size: 12px;
}

.review-form {
    margin-top: 30px;
    padding-top: 20px;
    border-top: 2px solid #e0e0e0;
}

.review-form h3 {
    font-size: 20px;
    color: #333;
    margin-bottom: 15px;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    font-size: 14px;
    color: #333;
    display: block;
    margin-bottom: 5px;
    font-weight: 500;
}

.form-control {
    width: 100%;
    padding: 10px;
    font-size: 14px;
    border: 1px solid #ddd;
    border-radius: 4px;
    margin-bottom: 10px;
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
    transition: border-color 0.2s ease;
}

.form-control:focus {
    border-color: #333;
    outline: none;
}

.btn-primary {
    background-color: #333;
    color: #fff;
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.btn-primary:hover {
    background-color: #555;
    transform: translateY(-2px);
}

</style>