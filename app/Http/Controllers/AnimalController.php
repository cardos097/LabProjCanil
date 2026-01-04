<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;

class AnimalController extends Controller
{
    public function index(){

        $animals = Animal::where('status','available')->latest()->get();

        return view('animals.index', compact('animals'));
    }

    public function show(Animal $animal){

        $animal->load(['comments.user','adoption']);

        return view('animals.show', compact('animal'));
    }
}
