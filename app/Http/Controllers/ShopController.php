<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Category;
use App\Models\Wishlist;

class ShopController extends Controller
{
    // Display a listing of products on the shop page
    public function index(Request $request)
    {
        $query = Product::query();
    
        // Apply category filter
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }
    
        // Apply price filter
        if ($request->has('price') && is_numeric($request->price)) {
            $maxPrice = (float) $request->price;
            $query->where('price', '<=', $maxPrice);
        }
    
        // Apply sorting
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'latest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }
    
        // Load products with average rating calculation
        $products = $query->with('reviews')->get()->map(function($product) {
            $product->averageRating = $product->reviews->avg('rating');
            return $product;
        });
    
        // Fetch categories for filter options
        $categories = Category::all();
    
        // Initialize wishlist array
        $wishlist = [];
        if (Auth::check()) {
            $userId = Auth::id();
            $wishlistItems = Wishlist::where('user_id', $userId)->pluck('product_id')->toArray();
            $wishlist = $wishlistItems;
        }
    
        // Determine max price for the range slider
        $maxPrice = Product::max('price');
    
        return view('shop.index', compact('products', 'categories', 'wishlist', 'maxPrice'));
    }
    
    // Display a single product details
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('shop.show', compact('product'));
    }
}
