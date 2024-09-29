<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Add this import
use App\Models\PlaceOrder;
use App\Models\Order;
use App\Models\OrderItem;


class CheckoutController extends Controller
{
    public function index()
    {
        $total = $this->calculateTotal(); // Ensure this method exists and returns the correct total
        return view('checkout.index', compact('total')); // Pass $total to the view
    }
    

    public function store(Request $request)
    {
        // Validate shipping details
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'payment_method' => 'required|string'
        ]);

        // Save shipping details and payment method in session
        session()->put('shipping_details', [
            'name' => $validated['name'],
            'address' => $validated['address'],
            'city' => $validated['city'],
            'postal_code' => $validated['postal_code'],
            'country' => $validated['country'],
            'phone' => $validated['phone'],
        ]);

        session()->put('payment_method', $validated['payment_method']);

        // Redirect to the payment page
        return redirect()->route('payment.index');
    }

    private function calculateTotal()
    {
        // Assuming you have a cart stored in the session
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            // Assuming each item has a 'price' and 'quantity'
            $total += $item['price'] * $item['quantity'];
        }

        return $total;
    }
}
