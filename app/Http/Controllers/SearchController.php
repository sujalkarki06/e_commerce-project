<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Replace with your product model if different


class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Perform the search. Adjust the search logic as needed.
        $products = Product::where('name', 'like', "%{$query}%")
                            ->orWhere('description', 'like', "%{$query}%")
                            ->get();

        // Return a view with search results
        return view('search.results', compact('products'));
    }
}
