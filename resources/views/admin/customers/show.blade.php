@extends('layouts.adminlayout')

@section('content')
    <div class="container">
        <div class="header">
            <h1>Customer Details</h1>
            <a href="{{ route('admin.customers.index') }}" class="btn btn-primary">Back to List</a>
        </div>
        <div class="card">
            <div class="card-body">
                <h3>{{ $user->name }}</h3>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Role:</strong> {{ $user->role === 2 ? 'Customer' : 'Not a Customer' }}</p>
                <!-- Add more customer details if needed -->
            </div>
        </div>
    </div>
@endsection

<style>
    .card {
        background-color: #1E1E1E; /* Slightly lighter dark color */
        border-radius: 5px;
        padding: 20px;
        margin-top: 20px;
    }

    .card-body {
        color: #FFFFFF;
    }

    .btn-primary {
        background-color: #8B7E72; /* Earthy brown */
    }
</style>
