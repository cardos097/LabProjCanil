<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuccessStory;
use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminSuccessStoryController extends Controller
{
    //List of success stories (admin)
    public function index()
    {
        
        $stories = SuccessStory::latest()->paginate(10);
        return view('admin.stories.index', compact('stories'));
    }

    // Show form to create a new success story
    public function create()
    {
        
        $animals = Animal::all();
        return view('admin.stories.create', compact('animals'));
    }

    // Create a new success story
    public function store(Request $request)
    {
        $this->ensureAdmin();  // Ensure only admins can create stories

        // Validate form data
        $data = $request->validate([
            'animal_id' => ['required', 'exists:animals,id'],
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'published' => ['nullable', 'boolean'],
        ]);

        // If the form contains an image, store it
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('success_stories', 'public');
        }

        // Set the user id who created the story
        $data['user_id'] = Auth::id();

        // Set published status
        $data['published'] = $request->boolean('published');

        // Create the success story in the database
        SuccessStory::create($data);

        // Redirect back to listing with success message
        return redirect()->route('admin.stories.index')->with('success', 'História criada com sucesso!');
    }

    // Edit an existing success story
    public function edit(SuccessStory $story)
    {
        $animals = Animal::all();  
        return view('admin.stories.edit', compact('story', 'animals'));
    }

    // Update a success story in the database
    public function update(Request $request, SuccessStory $story)
    {
        $this->ensureAdmin();  // Ensure only admins can edit stories

        // Validate the form data
        $data = $request->validate([
            'animal_id' => ['required', 'exists:animals,id'],
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'published' => ['nullable', 'boolean'],
        ]);

        // If a new image was uploaded, store it
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('success_stories', 'public');
        }

        // Update story data
        $story->update($data);

        // Redirect back to listing with success message
        return redirect()->route('admin.stories.index')->with('success', 'História atualizada com sucesso!');
    }

    // Delete a success story
    public function destroy(SuccessStory $story)
    {
        $story->delete();  

        
        return redirect()->route('admin.stories.index')->with('success', 'História removida com sucesso.');
    }

    // Helper to ensure the current user is an admin
    private function ensureAdmin()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403); // Permission denied for non-admins
        }
    }

    // Show details of a success story (admin)
    public function show(SuccessStory $story)
    {
        return view('admin.stories.show', compact('story'));
    }
}
