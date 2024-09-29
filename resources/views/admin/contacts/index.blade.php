@extends('layouts.adminlayout')

@section('content')
    <h1>Contact Messages</h1>
    <p>Manage your contact details and queries here.</p>

    @if($contacts->isEmpty())
        <div class="alert alert-info">No contact messages available.</div>
    @else
        <table class="contact-messages-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Received On</th>
                    <th>Replied</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ Str::limit($contact->message, 50) }}</td>
                        <td>{{ $contact->created_at->format('d M Y, H:i') }}</td>
                        <td>
                            @if ($contact->replied)
                                <span class="badge badge-success">Replied</span>
                            @else
                                <span class="badge badge-danger">Pending</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.contacts.show', ['id' => $contact->id]) }}" class="btn btn-info">View</a>
                            @if (!$contact->replied)
                                <a href="{{ route('admin.contacts.reply', ['id' => $contact->id]) }}" class="btn btn-primary">Reply</a>
                            @else
                                <span class="btn btn-primary disabled">Replied</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
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

    p {
        font-size: 16px;
        color: #E0E0E0;
    }

    /* Alert Messages */
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
        color: #FFFFFF;
    }

    .alert-info {
        background-color: #17a2b8; /* Info Blue */
    }

    .alert-success {
        background-color: #28a745; /* Success Green */
    }

    /* Table Styles */
    .contact-messages-table {
        width: 100%;
        border-collapse: collapse;
        background-color: #1E1E1E; /* Slightly lighter dark color */
        border-radius: 5px;
        overflow: hidden;
    }

    .contact-messages-table th,
    .contact-messages-table td {
        padding: 15px;
        text-align: left;
        color: #FFFFFF;
    }

    .contact-messages-table th {
        background-color: #2E236C; /* Royal Blue for headers */
    }

    .contact-messages-table tr {
        border-bottom: 1px solid #31363F; /* Border color */
    }

    .contact-messages-table tr:last-child {
        border-bottom: none;
    }

    .contact-messages-table tbody tr:nth-child(even) {
        background-color: #2A2A2A; /* Darker gray for alternate rows */
    }

    .contact-messages-table tbody tr:hover {
        background-color: #333333; /* Slightly lighter dark color on hover */
    }

    /* Buttons */
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

    .btn-info {
        background-color: #17a2b8; /* Info Blue */
    }

    .btn-primary {
        background-color: #8B7E72; /* Earthy brown */
    }

    .btn-primary.disabled {
        background-color: #6c757d; /* Disabled state color */
        cursor: not-allowed;
    }

    /* Badges */
    .badge {
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 14px;
    }

    .badge-success {
        background-color: #28a745; /* Success Green */
    }

    .badge-danger {
        background-color: #dc3545; /* Danger Red */
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .contact-messages-table {
            font-size: 14px;
        }

        .contact-messages-table th, 
        .contact-messages-table td {
            padding: 8px;
        }
    }
</style>
