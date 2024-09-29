<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    // Display a listing of products
    public function index()
    {
        $products = Product::all(); // Retrieve all products
        return view('admin.products.index', compact('products'));
    }

    // Show the form for creating a new product
    public function create()
    {
        $categories = Category::all(); // Fetch categories for dropdown
        return view('admin.products.create', compact('categories'));
    }

    // Store a newly created product in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation for image
            'category_id' => 'required|exists:categories,id', // Validate category_id
        ]);

        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->quantity = $request->input('quantity');
        $product->category_id = $request->input('category_id');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('uploads', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Product added successfully!');
    }

    // Show the form for editing the specified product
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // Update the specified product in storage
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('uploads', 'public');
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    // Remove the specified product from storage
    public function destroy(Product $product)
    {
        // Delete image from storage if exists
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

    // Display a single product details
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('shop.show', compact('product'));
    }
}
