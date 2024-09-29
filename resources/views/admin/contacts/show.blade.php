@extends('layouts.adminlayout')

@section('content')
    <div class="container">
        <div class="card">
            <h1>Contact Message Details</h1>
            <div class="card-content">
                <p><strong>Name:</strong> {{ $contact->name }}</p>
                <p><strong>Email:</strong> {{ $contact->email }}</p>
                <p><strong>Message:</strong></p>
                <p>{{ $contact->message }}</p>
                <p><strong>Received On:</strong> {{ $contact->created_at->format('d M Y, H:i') }}</p>
            </div>
            <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
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

    .container {
        padding: 20px;
    }

    .card {
        background-color: #1E1E1E; /* Slightly lighter dark color */
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        padding: 20px;
        margin-bottom: 20px;
    }

    .card h1 {
        font-size: 24px;
        color: #FFFFFF;
        margin-bottom: 20px;
    }

    .card-content p {
        font-size: 16px;
        color: #E0E0E0;
        margin: 10px 0;
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
        margin-top: 20px;
    }

    .btn-secondary {
        background-color: #6c757d; /* Secondary Gray */
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .container {
            padding: 15px;
        }

        .card h1 {
            font-size: 20px;
        }

        .card-content p {
            font-size: 14px;
        }
    }
</style>
