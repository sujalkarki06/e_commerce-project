<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
{
    // Fetch all reviews with related products and users
    $reviews = Review::with('product', 'user')->get();

    // Calculate statistics for each product
    $products = Product::withCount('reviews')
                        ->withAvg('reviews', 'rating')
                        ->get();

    return view('admin.reviews.index', compact('reviews', 'products'));
}
public function details($productId)
{
    // Fetch product and its reviews
    $product = Product::findOrFail($productId);
    // Fetch reviews for the product
    $reviews = $product->reviews;
    return view('admin.reviews.details', compact('product', 'reviews'));
}


    public function show($productId)
    {
        $product = Product::findOrFail($productId);
        $reviews = Review::where('product_id', $productId)->get();
        return view('reviews.show', compact('product', 'reviews'));
    }

    public function store(Request $request, $productId)
    {
        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|string|max:1000',
        ]);

        Review::create([
            'product_id' => $productId,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('reviews.show', $productId)->with('success', 'Review submitted successfully.');
    }
}
