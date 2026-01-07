<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
            'email'   => ['nullable', 'email', 'max:255'],
            'name'    => ['nullable', 'string', 'max:255'],
        ]);

        Message::create([
            'user_id' => Auth::id(), // null if not authenticated
            'subject' => $data['subject'],
            'message' => $data['message'],
            'email'   => $data['email'] ?? null,
            'name'    => $data['name'] ?? null,
        ]);

        return back()->with('success', 'Mensagem enviada com sucesso!');
    }
}
