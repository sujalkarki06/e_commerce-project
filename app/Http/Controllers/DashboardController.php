<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Page;



class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalCustomers = User::where('role', 2)->count();
        $totalPages = Page::count();

        return view('admin.dashboard', compact('totalOrders', 'totalProducts', 'totalCustomers', 'totalPages'));
    }
}
