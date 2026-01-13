<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Mail\MessageReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminMessageController extends Controller
{
    // List messages (admin)
    public function index()
    {
        $messages = Message::latest()->paginate(15);
        return view('admin.messages.index', compact('messages'));
    }

    // Show a single message
    public function show(Message $message)
    {
        return view('admin.messages.show', compact('message'));
    }

    // Reply to a message
    public function reply(Request $request, Message $message)
    {
        $data = $request->validate([
            'reply' => ['required', 'string', 'max:5000'],
        ]);

        // Get email to send reply to
        $email = $message->email ?? ($message->user?->email);
        
        if (!$email) {
            return back()->with('error', 'Não há email para responder.');
        }

        // Send email
        Mail::to($email)->send(new MessageReply($message->subject, $data['reply']));

        return back()->with('success', 'Resposta enviada com sucesso!');
    }

    // Delete a message
    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->route('admin.messages.index')->with('success', 'Mensagem removida.');
    }
}
