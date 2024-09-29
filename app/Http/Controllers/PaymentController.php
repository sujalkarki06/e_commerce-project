<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        $paymentMethod = session('payment_method');

        if (!$paymentMethod) {
            return redirect()->route('checkout.index')->with('error', 'Please select a payment method.');
        }

        return view('payment.index', compact('paymentMethod'));
    }

    public function store(Request $request)
    {
        // Validate payment method and details
        $this->validatePaymentDetails($request, $request->input('payment_method'));
    
        $cart = session('cart');
        $shippingDetails = session('shipping_details');
        $paymentMethod = $request->input('payment_method');
    
        // Check if cart and shipping details are available
        if (!$cart || !$shippingDetails) {
            return redirect()->route('checkout.index')->with('error', 'Your cart or shipping details are missing.');
        }
    
        // Calculate total
        $total = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));
    
        // Create the order
        $order = Order::create([
            'user_id' => Auth::id(),
            'name' => $shippingDetails['name'],
            'address' => $shippingDetails['address'],
            'city' => $shippingDetails['city'],
            'postal_code' => $shippingDetails['postal_code'],
            'country' => $shippingDetails['country'],
            'phone' => $shippingDetails['phone'],
            'payment_method' => $paymentMethod,
            'total' => $total,
            'status' => 'paid', // You can set this based on your logic
        ]);
    
        // Create order items
        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }
    
        // Clear cart and session data
        session()->forget(['cart', 'shipping_details', 'payment_method']);
    
        // Send the order confirmation email
        Mail::to(Auth::user()->email)->send(new OrderConfirmation($order));
    
        // Redirect or return a response
        return redirect()->route('orders.index')->with('success', 'Payment successful! A confirmation email has been sent.');
    }
    
    
    public function success()
    {
        // Retrieve the order ID from session
        $orderId = session('order_id');

        if (!$orderId) {
            return redirect()->route('shop.index')->with('error', 'No order found.');
        }

        $order = Order::findOrFail($orderId);

        return view('payment.success', compact('order'));
    }

    /**
     * Validate payment details based on payment method
     *
     * @param Request $request
     * @param string $paymentMethod
     * @return void
     */
    private function validatePaymentDetails(Request $request, string $paymentMethod)
    {
        $rules = [
            'card_number' => 'required_if:payment_method,credit_card',
            'card_expiry' => 'required_if:payment_method,credit_card',
            'card_cvv' => 'required_if:payment_method,credit_card',
            'paypal_email' => 'required_if:payment_method,paypal|email',
            'bank_account_number' => 'required_if:payment_method,bank_transfer',
            'bank_name' => 'required_if:payment_method,bank_transfer',
        ];

        $request->validate($rules);
    }
}
