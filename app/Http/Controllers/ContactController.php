<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact'); // Pastikan file contact.blade.php ada di resources/views
    }

    public function send(Request $request)
    {
        // Validasi input
        $data = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|min:3|max:1000',
        ]);

        $recipient = config('mail.from.address', env('MAIL_TO_ADDRESS', 'admin@example.com'));

        Mail::send('emails.contact', ['data' => $data], function ($message) use ($data, $recipient) {
            $message->to($recipient)
                ->subject('New Contact Form Message')
                ->from($data['email'], $data['name']);
        });

        // Logika pengiriman email bisa ditambahkan di sini

        return redirect()->back()->with('success', 'Message sent successfully!');
    }
}
