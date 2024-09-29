<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class PageController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request) // Corrected here
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Page::create($request->all());

        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully.');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page) // Corrected here
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $page->update($request->all());

        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully.');
    }

    public function destroy(Page $page)
    {
        $page->delete();

        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully.');
    }

    public function about()
{
    try {
        // Fetch the 'About Us' page from the database
        $page = Page::where('title', 'About Us')->firstOrFail();
    } catch (ModelNotFoundException $e) {
        // If the page is not found, return a custom view or message
        return view('errors.page-not-found', ['message' => 'The About Us page is not available.']);
    }

    // Debugging: check what page is being fetched

    return view('about', compact('page'));
}

public function privacy_policy()
{
    try {
        // Fetch the 'Privacy Policy' page from the database
        $page = Page::where('title', 'Privacy Policy')->firstOrFail();
    } catch (ModelNotFoundException $e) {
        // If the page is not found, return a custom view or message
        return view('errors.page-not-found', ['message' => 'The Privacy Policy page is not available.']);
    }

    // Debugging: check what page is being fetched

    return view('privacypolicy', compact('page'));
}
public function terms_condition()
{
    try {
        // Fetch the 'Privacy Policy' page from the database
        $page = Page::where('title', 'Terms & Condition')->firstOrFail();
    } catch (ModelNotFoundException $e) {
        // If the page is not found, return a custom view or message
        return view('errors.page-not-found', ['message' => 'The Privacy Policy page is not available.']);
    }

    // Debugging: check what page is being fetched

    return view('terms_condition', compact('page'));
}
public function shipping_returns()
{
    try {
        // Fetch the 'Privacy Policy' page from the database
        $page = Page::where('title', 'Shipping & Returns')->firstOrFail();
    } catch (ModelNotFoundException $e) {
        // If the page is not found, return a custom view or message
        return view('errors.page-not-found', ['message' => 'The Privacy Policy page is not available.']);
    }

    // Debugging: check what page is being fetched

    return view('shipping_returns', compact('page'));
}

}
