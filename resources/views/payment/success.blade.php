@extends('layouts.applayout')

@section('content')
<div class="success-container">
    <h1>Payment Successful</h1>
    <p>Your payment was successful, and your order has been placed. You will be redirected shortly.</p>
</div>

@section('scripts')
<script>
    // Display success message in a popup
    @if(session('success'))
        alert('{{ session('success') }}');
    @endif

    // Redirect to "My Orders" page after a delay
    setTimeout(function() {
        window.location.href = "{{ route('orders.index') }}";
    }, 3000); // 3 seconds delay
</script>
@endsection
