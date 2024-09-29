<!-- resources/views/about.blade.php -->

@extends('layouts.applayout') <!-- or your preferred layout -->

@section('content')
<div class="container">
    <div class="shipping_returns-content">
        @if(isset($page))
            <h1>{{ $page->title }}</h1>
            <p>{{ $page->content }}</p>
        @else
            <h1>Page Not Found</h1>
            <p>The Shipping & Returns page is not available.</p>
            <a href="{{ url('/') }}">Return to Home</a>
        @endif
    </div>
</div>
@endsection

@section('styles')
<style>
    .about-content {
        background-color: #1E1E1E; /* Dark background */
        padding: 20px;
        border-radius: 5px;
        color: #FFFFFF; /* White text */
    }

    .about-content h1 {
        font-size: 24px;
        margin-bottom: 15px;
    }

    .about-content p {
        font-size: 16px;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .about-content a {
        color: #8B7E72; /* Earthy brown */
        text-decoration: none;
    }

    .about-content a:hover {
        text-decoration: underline;
    }
</style>
@endsection
