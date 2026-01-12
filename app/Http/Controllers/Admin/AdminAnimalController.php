<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminAnimalController extends Controller
{
    public function index()
    {
        $animals = Animal::latest()->paginate(10);
        return view('admin.animals.index', compact('animals'));
    }

    public function create()
    {
        return view('admin.animals.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'species' => ['required', 'string', 'max:50'],
            'breed' => ['nullable', 'string', 'max:255'],
            'age' => ['nullable', 'integer', 'min:0', 'max:40'],
            'gender' => ['nullable', 'in:Masculino,Feminino'],
            'description' => ['nullable', 'string', 'max:5000'],
            'status' => ['required', 'in:Disponível,Adotado'],
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Photo validation
        ]);

        // Save uploaded photo if present
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('animals', 'public');
        }

        Animal::create($data);

        return redirect()->route('admin.animals.index')->with('success', 'Animal criado com sucesso!');
    }

    public function show(Animal $animal)
    {
        return redirect()->route('admin.animals.edit', $animal);
    }

    public function edit(Animal $animal)
    {
        return view('admin.animals.edit', compact('animal'));
    }

    public function update(Request $request, Animal $animal)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'species' => ['required', 'string', 'max:50'],
            'breed' => ['nullable', 'string', 'max:255'],
            'age' => ['nullable', 'integer', 'min:0', 'max:40'],
            'gender' => ['nullable', 'in:Masculino,Feminino'],
            'description' => ['nullable', 'string', 'max:5000'],
            'status' => ['required', 'in:Disponível,Adotado'],
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Save uploaded photo if present
        if ($request->hasFile('photo')) {
            // Deletar a foto anterior se existir
            if ($animal->photo) {
                // Delete previous photo if exists
                Storage::disk('public')->delete($animal->photo);
            }

            // Store the new photo
            $data['photo'] = $request->file('photo')->store('animals', 'public');
        }

        $animal->update($data);

        return redirect()->route('admin.animals.index')->with('success', 'Animal atualizado com sucesso!');
    }

    public function destroy(Animal $animal)
    {
        // Delete animal photo from storage if present
        if ($animal->photo) {
            Storage::disk('public')->delete($animal->photo);
        }

        $animal->delete();
        return redirect()->route('admin.animals.index')->with('success', 'Animal removido.');
    }
}
