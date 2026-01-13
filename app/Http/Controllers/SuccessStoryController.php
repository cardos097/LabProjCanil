<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuccessStory;
use Illuminate\Support\Facades\Auth;
use App\Models\Animal;


class SuccessStoryController extends Controller
{
    //public page: published story
    public function index(){
        $stories = SuccessStory::where('published', true)->with('animal')->latest()->get();
        return view('success_stories.index', compact('stories'));
    }

    //public page: show single story
    public function show(SuccessStory $story){
        return view('success_stories.show', compact('story'));
    }

    //admin creates new story
    public function store(Request $request){

        $this->EnsureAdmin();

        $data = $request->validate([
            'animal_id'=>['required','exists:animals,id'],
            'title'=>['required','string','max:255'],
            'content'=>['required','string'],
            'photo'=>['nullable','image','max:2048'],
            'published'=>['nullable','boolean'],
        ]);

        if($request->hasFile('photo')){
            $data['photo'] = $request->file('photo')->store('success_stories','public');
        }

        $data['user_id'] = Auth::id();
        $data['published'] = $request->boolean('published');

        SuccessStory::create($data);
        return back()->with('success','Story created successfully.');
    }

    private function ensureAdmin(){
        if(!Auth::check() || Auth::user()->role !== 'admin'){
            abort(403);
        }
    }
}
