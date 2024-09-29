@extends('layouts.adminlayout')

@section('content')
    <div class="container">
        <div class="header">
            <h1>Update Delivery Status</h1>
        </div>
        
        <form action="{{ route('admin.orders.updateDelivery', $order->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="delivery_status">Delivery Status</label>
                <select name="delivery_status" id="delivery_status" class="form-control">
                    <option value="Pending" {{ $order->delivery_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Shipped" {{ $order->delivery_status == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="Delivered" {{ $order->delivery_status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="Cancelled" {{ $order->delivery_status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Status</button>
        </form>
    </div>
@endsection

<style>
    /* Form Styles */
    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        color: #FFFFFF;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #CCC;
        background-color: #2A2A2A;
        color: #FFFFFF;
    }

    .btn-primary {
        background-color: #008CBA;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        color: #FFFFFF;
        cursor: pointer;
    }

    .btn-primary:hover {
        opacity: 0.8;
    }
</style>
