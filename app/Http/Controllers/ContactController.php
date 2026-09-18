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
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'service' => 'nullable|string|max:255',
            'preferred_date' => 'nullable|string|max:100',
            'company' => 'nullable|string|max:255',
            'message' => 'required|string|min:3|max:2000',
        ]);

        $recipient = config('mail.from.address', env('MAIL_TO_ADDRESS', 'admin@example.com'));

        try {
            Mail::send('emails.contact', ['data' => $data], function ($message) use ($data, $recipient) {
                $message->to($recipient)
                    ->subject('Pesan Baru Contact Form - ' . ($data['company'] ?? $data['name']))
                    ->from($data['email'], $data['name']);
            });
        } catch (\Exception $e) {
            // Log error if needed, proceed with user feedback
        }

        return redirect()->back()->with('success', 'Pesan Anda berhasil dikirim! Tim kami akan segera menghubungi Anda.');
    }
}
