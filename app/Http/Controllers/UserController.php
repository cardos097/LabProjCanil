<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Animal;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        $adoptedAnimals = Animal::where('adopted_by', $user->id)->get();

        return view('profile', compact('user', 'adoptedAnimals'));
    }
}
