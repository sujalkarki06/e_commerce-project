<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function store(Request $request)
    {
        $product = Product::findOrFail($request->input('product_id'));
        $cart = Session::get('cart', []);
        $quantity = $request->input('quantity');
        
        // Check if the product is already in the cart
        if (isset($cart[$product->id])) {
            // Update the quantity if the product is already in the cart
            $cart[$product->id]['quantity'] += $quantity;
            $message = 'Item already added to the cart.';
        } else {
            // Add the product to the cart
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'image' => $product->image
            ];
            $message = 'Item added to the cart.';
        }
    
        Session::put('cart', $cart);
    
        // Return a JSON response
        return response()->json(['success' => true, 'message' => $message]);
    }

    public function update(Request $request, $id)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$id])) {
            // Validate the quantity input
            $quantity = $request->input('quantity');
            if ($quantity > 0) {
                $cart[$id]['quantity'] = $quantity;
                Session::put('cart', $cart);
                return response()->json(['success' => true, 'message' => 'Quantity updated.']);
            } else {
                return response()->json(['success' => false, 'message' => 'Quantity must be at least 1.']);
            }
        }
        return response()->json(['success' => false, 'message' => 'Item not found in cart.']);
    }

    public function destroy($id)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
            // Flash message to session
            return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
        }
        return redirect()->route('cart.index')->with('error', 'Item not found in cart.');
    }
    
    public function showCart()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function updateQuantity(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate(['quantity' => 'required|integer|min:1']);

        // Retrieve the cart from session
        $cart = session()->get('cart');

        // Check if the item exists in the cart
        if (isset($cart[$id])) {
            // Update the quantity
            $cart[$id]['quantity'] = $request->input('quantity');
            session()->put('cart', $cart);
            return response()->json(['success' => true, 'cart' => $cart]);
        }

        return response()->json(['success' => false], 404);
    }
    
}
