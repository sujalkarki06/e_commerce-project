<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Wishlist;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $wishlists = Wishlist::where('user_id', Auth::id())->with('product')->get();
            return view('wishlist.index', compact('wishlists'));
        }

        return redirect()->route('login'); // Redirect to login if not authenticated
    }


    public function store(Request $request)
{
    $productId = $request->input('product_id');
    $quantity = $request->input('quantity', 1);

    // Validate input
    $validated = $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
    ]);

    // Add to cart logic
    $product = Product::find($productId);

    if (!$product) {
        return response()->json(['success' => false, 'message' => 'Product not found.']);
    }

    $cart = session()->get('cart', []);
    if (isset($cart[$productId])) {
        $cart[$productId]['quantity'] += $quantity;
    } else {
        $cart[$productId] = [
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $quantity,
            'image' => $product->image,
        ];
    }

    session()->put('cart', $cart);

    return response()->json(['success' => true, 'message' => 'Product added to cart.']);
}



public function destroy($productId)
{
    if (Auth::check()) {
        $userId = Auth::id();
        Wishlist::where('user_id', $userId)->where('product_id', $productId)->delete();
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false], 403); // Respond with error if not authenticated
}


public function toggle($productId)
{
    if (!Auth::check()) {
        return response()->json(['added' => false], 403); // Respond with error if not authenticated
    }

    $user = Auth::user();

    try {
        // Check if the product is already in the wishlist
        $inWishlist = $user->wishlist()->where('product_id', $productId)->exists();

        if ($inWishlist) {
            // Remove from wishlist
            $user->wishlist()->detach($productId);
            $added = false;
        } else {
            // Add to wishlist
            $user->wishlist()->attach($productId);
            $added = true;
        }

        return response()->json([
            'added' => $added,
        ]);
    } catch (\Exception $e) {
        // Handle exceptions and return error response
        return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
    }
}





}
