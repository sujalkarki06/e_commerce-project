<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Mail\ShippingStatusUpdated;
use App\Mail\orderConfirmation;
use App\Models\PlaceOrder;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    public function adminindex()
    {
        $orders = Order::with('user')->get();
        return view('admin.orders.index', compact('orders'));
    }

    // public function show(Order $order)
    // {
    //     return view('admin.orders.show', compact('order'));
    // }

     // Store the new order and handle payment
public function store(Request $request)
{
    // Validate the request
    $request->validate([
        'user_id' => 'required|integer',
        'name' => 'required|string',
        'address' => 'required|string',
        'city' => 'required|string',
        'postal_code' => 'required|string',
        'country' => 'required|string',
        'phone' => 'required|string',
        'payment_method' => 'required|string',
        'total' => 'required|numeric',
    ]);

    // Create a new order instance
    $order = new Order();
    $order->user_id = $request->user_id;
    $order->name = $request->name;
    $order->address = $request->address;
    $order->city = $request->city;
    $order->postal_code = $request->postal_code;
    $order->country = $request->country;
    $order->phone = $request->phone;
    $order->payment_method = $request->payment_method;
    $order->total = $request->total;
    $order->status = 'pending'; // Default status

    // Save the order to the database to generate the auto-incremented ID
    $order->save();

    // Insert order items from session cart
    foreach (session('cart', []) as $productId => $details) {
        $order->items()->create([
            'product_id' => $productId,
            'quantity' => $details['quantity'],
            'price' => $details['price'],
        ]);
    }

    // Assuming payment processing happens here and is successful
    // Ensure user exists and has a valid email
    $user = User::find($order->user_id);
    if ($user) {
        // Send order confirmation email
        Mail::to($user->email)->send(new OrderConfirmation($order));
    } else {
        // Handle the case where the user is not found
        return redirect()->route('orders.index')->with('error', 'Order created, but user email not found.');
    }

    // Redirect to orders page with success message
    return redirect()->route('orders.index')->with('success', 'Order created successfully. Payment processed!');
}


    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
                       ->with('items.product')
                       ->get();

        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        // Fetch a single order with its items and related product details
        $order = Order::with('items.product')->findOrFail($id);

        return view('orders.show', compact('order'));
    }

  public function edit($id)
    {
        $order = Order::findOrFail($id); // Find the order by ID
        return view('admin.orders.edit', compact('order'));
    }

    /**
     * Update the specified order in storage.
     */
    public function update(Request $request, $id)
{
    $order = Order::findOrFail($id);

    $request->validate([
        'delivery_status' => 'required|string',
        'tracking_number' => 'nullable|string',
        'shipping_provider' => 'required|string',
        'estimated_delivery' => 'nullable|date',
        'transaction_id' => 'nullable|string',
    ]);

    // Update the order
    $order->update($request->only('delivery_status', 'tracking_number', 'shipping_provider', 'estimated_delivery', 'transaction_id'));

    // Send email notification to the user
    Mail::to($order->user->email)->send(new ShippingStatusUpdated($order));

    return redirect()->route('admin.orders.index')->with('success', 'Order updated successfully and email sent to the user.');
}
    
    

    // Show the delivery form
    public function deliver(Order $order)
    {
        return view('admin.orders.deliver', compact('order'));
    }

    // Handle delivery status update
    public function updateDelivery(Request $request, Order $order)
    {
        $request->validate([
            'delivery_status' => 'required|string|max:255',
        ]);

        $order->update([
            'delivery_status' => $request->delivery_status,
        ]);

        return redirect()->route('orders.index')->with('success', 'Delivery status updated successfully.');
    }

    public function orderConfirmation($orderId)
    {
        // Fetch the order by ID
        $order = Order::with('items')->findOrFail($orderId); // Assuming 'items' is the relationship
    
        // Return the view and pass the order data
        return view('email.order_confirmation', compact('order'));
    }

    // public function showInvoice($id)
    // {
    //     // Fetch the order by ID, with the related items (assumes many-to-many relationship)
    //     $order = Order::with('items')->findOrFail($id);

    //     // Pass the order to the view
    //     return view('email.payment_confirmation', compact('order'));
    // }
}
