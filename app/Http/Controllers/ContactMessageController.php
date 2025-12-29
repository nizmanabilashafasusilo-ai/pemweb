<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class ContactMessageController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        $msg = Message::create($data);

        // Optionally notify admin by email (not implemented here)

        return redirect()->back()->with('message_sent', 'Pesan Anda telah terkirim. Terima kasih!');
    }

    // Admin index
    public function index()
    {
        $messages = Message::latest()->paginate(20);
        return view('admin.messages.index', compact('messages'));
    }

    // View single message
    public function show(Message $message)
    {
        if (! $message->read_at) {
            $message->update(['read_at' => now()]);
        }
        return view('admin.messages.show', compact('message'));
    }

    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->route('admin.messages.index')->with('success','Message deleted');
    }
}
