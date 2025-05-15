<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Ici vous pourriez envoyer un email ou enregistrer le message dans la base de données
        // Par exemple : Mail::to('admin@example.com')->send(new ContactFormMail($validated));

        return back()->with('success', 'Votre message a été envoyé avec succès!');
    }
} 