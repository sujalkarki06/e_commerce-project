<!-- resources/views/contact.blade.php -->

@extends('layouts.applayout')

@section('content')
<div class="container">
    <h1>Contact Us</h1>

    <!-- Display success message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('contact.submit') }}">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="message">Message</label>
            <textarea id="message" name="message" class="form-control" rows="5" required>{{ old('message') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Send Message</button>
    </form>
</div>
@endsection

<style>
    .alert-success {
        background-color: #d4edda; /* Light green background */
        color: #155724; /* Dark green text */
        border: 1px solid #c3e6cb; /* Light green border */
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .alert-success strong {
        font-weight: bold;
    }

    .container {
        max-width: 600px;
        margin: 0 auto;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-control {
        border-radius: 4px;
        border: 1px solid #ced4da;
        padding: 0.5rem;
        font-size: 1rem;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        color: #fff;
        padding: 0.5rem 1rem;
        border-radius: 4px;
        font-size: 1rem;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }
</style>
