<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        $slug = Str::slug($request->name);
    
        Category::create([
            'name' => $request->name,
            'slug' => $slug,
        ]);
    
        return redirect()->route('admin.categories.index')
                         ->with('success', 'Category created successfully.');
    }
    
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255',
    ]);

    $slug = Str::slug($request->name);

    // Update category in the database
    $category->update([
        'name' => $request->name,
        'slug' => $slug,
    ]);

    // Redirect back to the categories index with a success message
    return redirect()->route('admin.categories.index')
                     ->with('success', 'Category updated successfully.');
}


    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Category deleted successfully.');
    }
}
