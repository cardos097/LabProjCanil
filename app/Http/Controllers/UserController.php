<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        $adoptedAnimals = $user->adoptedAnimals()->with('adoptedBy')->get();

        return view('profile', compact('user', 'adoptedAnimals'));
    }
}
