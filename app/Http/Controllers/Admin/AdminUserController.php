<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function index()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }

        $users = User::withCount(['adoptions', 'donations', 'comments'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function toggleAdmin(User $user)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }

        // Prevent admin from removing their own admin role
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Não podes remover a tua própria permissão de admin.');
        }

        $user->update([
            'role' => $user->role === 'admin' ? 'user' : 'admin'
        ]);

        $action = $user->role === 'admin' ? 'promovido a' : 'removido de';
        return back()->with('success', "Utilizador {$action} administrador com sucesso!");
    }

    public function destroy(User $user)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }

        // Prevent admin from deleting themselves
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Não podes eliminar a tua própria conta.');
        }

        $userName = $user->name;
        $user->delete();

        return back()->with('success', "Utilizador {$userName} eliminado com sucesso!");
    }
}
