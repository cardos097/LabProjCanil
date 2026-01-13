<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Mostrar página de comentários e avaliações
     */
    public function index()
    {
        $comments = Comment::latest()->paginate(10);
        
        // Se autenticado, mostrar apenas animais que adotou
        if (Auth::check()) {
            $animals = Animal::whereHas('adoptions', function ($query) {
                $query->where('user_id', Auth::id())->where('status', 'approved');
            })->get();
        } else {
            $animals = collect();
        }
        
        return view('comments.index', compact('comments', 'animals'));
    }

    /**
     * Armazenar um novo comentário
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'animal_id' => ['nullable', 'exists:animals,id'],
            'content' => ['required', 'string', 'max:1000'],
            'rating'  => ['nullable', 'integer', 'min:1', 'max:5'],
        ]);

        // Se especificar animal_id, verificar se adotou
        if ($data['animal_id']) {
            $hasAdoption = Animal::where('id', $data['animal_id'])
                ->whereHas('adoptions', function ($query) {
                    $query->where('user_id', Auth::id())->where('status', 'approved');
                })
                ->exists();

            if (!$hasAdoption) {
                return back()->with('error', 'Só podes comentar sobre animais que adotaste.');
            }
        }

        Comment::create([
            'user_id'   => Auth::id(),
            'animal_id' => $data['animal_id'] ?? null,
            'content'   => $data['content'],
            'rating'    => $data['rating'] ?? null,
        ]);

        return back()->with('success', 'Comentário adicionado com sucesso!');
    }

    /**
     * Apagar comentário (autor ou admin)
     */
    public function destroy(Comment $comment)
    {
        if (
            Auth::id() !== $comment->user_id &&
            Auth::user()->role !== 'admin'
        ) {
            abort(403);
        }

        $comment->delete();

        return back()->with('success', 'Comentário removido.');
    }
}

