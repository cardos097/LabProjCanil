<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Armazenar um novo comentário
     */

    public function store(Request $request, Animal $animal)
{
    $data = $request->validate([
        'content' => ['required', 'string', 'max:1000'],
        'rating'  => ['nullable', 'integer', 'min:1', 'max:5'],
    ]);

    Comment::create([
        'user_id'   => Auth::id(),
        'animal_id' => $animal->id,
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
