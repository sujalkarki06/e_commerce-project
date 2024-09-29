<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;
use App\Models\ContactReply;


class ContactController extends Controller
{
    public function contact_index()
    {
        $contacts = Contact::all(); // Fetch all contact messages
        return view('admin.contacts.index', compact('contacts'));
    }
    
    public function show($id)
    {
        $contact = Contact::findOrFail($id); // Fetch the contact message by ID
        return view('admin.contacts.show', compact('contact'));
    }
    
    public function reply($id)
{
    $contact = Contact::findOrFail($id); // Fetch the contact message by ID
    return view('admin.contacts.reply', compact('contact'));
}

public function sendReply(Request $request, $id)
{
    $contact = Contact::findOrFail($id);

    $request->validate([
        'reply' => 'required|string',
    ]);

    // Create a new reply
    ContactReply::create([
        'contact_id' => $contact->id,
        'reply' => $request->input('reply'),
    ]);

    // Update the contact message to mark it as replied
    $contact->update(['replied' => true]);

    return redirect()->route('admin.contacts.index')->with('success', 'Reply sent successfully.');
}



    public function index()
    {
        $user = Auth::user();
        return view('contact', ['user' => $user]);
    }

    public function submit(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Save the contact message
        Contact::create($validatedData);

        return redirect()->route('contact')->with('success', 'Message sent successfully!');
    }
}
