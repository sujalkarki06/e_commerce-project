<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;


class HomeController extends Controller
{
    public function index()
    {
        // Fetch all categories
        $categories = Category::all();
        
        // Fetch all products or a limited number of products
        $products = Product::latest()->take(8)->get(); // Fetch the latest 8 products (change as needed)

        // Pass categories and products to the view
        return view('home', compact('categories', 'products'));
    }
}
