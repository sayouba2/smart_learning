<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'message' => 'required|string|min:10',
        ]);

        Mail::raw("Message de : {$request->name} ({$request->email})\n\n{$request->message}", function ($message) use ($request) {
            $message->to('saykoodg677@gmail.com') // ← change this to your destination address
                    ->subject('Nouveau message de contact');
        });

        return redirect()->route('contact.show')->with('success', 'Message envoyé avec succès.');
    }
}

