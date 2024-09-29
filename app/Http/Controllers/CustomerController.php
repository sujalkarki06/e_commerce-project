<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Show all customers
    public function index()
    {
        $customers = User::where('role', 2)->get();
        return view('admin.customers.index', compact('customers'));
    }

    // Show a single customer
    public function show(User $user)
    {
        // Ensure that the user has the role of 2
        if ($user->role !== 2) {
            abort(404);
        }

        return view('admin.customers.show', compact('user'));
    }
}
