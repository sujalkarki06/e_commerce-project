@extends('layouts.adminlayout')

@section('content')
    <h1>FAQ</h1>
    <!-- Add your FAQ management content here -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Question</th>
                <th>Answer</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($faqs as $faq)
                <tr>
                    <td>{{ $faq->id }}</td>
                    <td>{{ $faq->question }}</td>
                    <td>{{ $faq->answer }}</td>
                    <td>
                        <!-- Add actions like edit and delete -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
