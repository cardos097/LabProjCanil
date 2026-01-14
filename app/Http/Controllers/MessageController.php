<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\Animal;

class MessageController extends Controller
{
    //Mostrar formulário de contacto ou lista de mensagens (admin)
    public function index()
    {
        // Se for admin, mostrar lista de mensagens
        if (Auth::check() && Auth::user()->role === 'admin') {
            $messages = Message::latest()->paginate(20);
            return view('admin.messages.index', compact('messages'));
        }

        // Caso contrário, mostrar formulário de contacto
        return view('messages.contact');
    }

    

    public function store(Request $request)
    {
        // Se não estiver autenticado, nome e email são obrigatórios
        $rules = [
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ];

        if (!Auth::check()) {
            $rules['email'] = ['required', 'email', 'max:255'];
            $rules['name'] = ['required', 'string', 'max:255'];
        } else {
            $rules['email'] = ['nullable', 'email', 'max:255'];
            $rules['name'] = ['nullable', 'string', 'max:255'];
        }

        $data = $request->validate($rules);

        Message::create([
            'user_id' => Auth::id(), 
            'subject' => $data['subject'],
            'message' => $data['message'],
            'email'   => $data['email'] ?? null,
            'name'    => $data['name'] ?? null,
        ]);

        return back()->with('success', 'Mensagem enviada com sucesso!');
    }
}
