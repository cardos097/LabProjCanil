<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use Illuminate\Http\Request;

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
            'gender' => ['nullable', 'string', 'max:20'],
            'description' => ['nullable', 'string', 'max:5000'],
            'status' => ['required', 'in:available,adopted'],
        ]);

        Animal::create($data);

        return redirect()->route('admin.animals.index')->with('success', 'Animal criado com sucesso!');
    }

    public function show(Animal $animal)
    {
        // não precisamos para já
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
            'gender' => ['nullable', 'string', 'max:20'],
            'description' => ['nullable', 'string', 'max:5000'],
            'status' => ['required', 'in:available,adopted'],
        ]);

        $animal->update($data);

        return redirect()->route('admin.animals.index')->with('success', 'Animal atualizado com sucesso!');
    }

    public function destroy(Animal $animal)
    {
        $animal->delete();
        return redirect()->route('admin.animals.index')->with('success', 'Animal removido.');
    }
}
