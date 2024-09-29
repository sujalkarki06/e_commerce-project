@extends('layouts.adminlayout')

@section('content')
    <div class="container">
        <div class="card">
            <h1>Reply to Contact Message</h1>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('admin.contacts.sendReply', ['id' => $contact->id]) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="reply">Reply:</label>
                    <textarea id="reply" name="reply" rows="5" class="form-control" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send Reply</button>
                <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">Back to List</a>
            </form>
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

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        font-size: 16px;
        color: #E0E0E0;
        display: block;
        margin-bottom: 8px;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ddd;
        background-color: #333;
        color: #E0E0E0;
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

    .btn-primary {
        background-color: #007bff; /* Primary Blue */
    }

    .btn-secondary {
        background-color: #6c757d; /* Secondary Gray */
    }

    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
        color: #FFFFFF;
    }

    .alert-success {
        background-color: #28a745; /* Success Green */
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .container {
            padding: 15px;
        }

        .card h1 {
            font-size: 20px;
        }

        .form-group label {
            font-size: 14px;
        }

        .form-control {
            font-size: 14px;
        }

        .btn {
            font-size: 14px;
        }
    }
</style>
