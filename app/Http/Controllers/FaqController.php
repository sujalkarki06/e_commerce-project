<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;


class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::all(); // Fetch all FAQs
        return view('admin.faqs.index', compact('faqs'));
    }
    
    public function show()
    {
        $faqs = Faq::all();
        return view('faq.index', compact('faqs'));
    }
}
