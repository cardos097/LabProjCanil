<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adoption;
use App\Models\Animal;
use Illuminate\Support\Facades\Auth;

class AdoptionController extends Controller
{
    // user tries to adopt an animal
    public function store(Request $request, Animal $animal){

        // Check if the animal is already adopted
        if ($animal->status === 'adopted') {
            return back()->with('error', 'This animal was already adopted.');
        }
        if($animal->adoption){
            return back()->with('error', 'There is already a pending adoption request for this animal.');
        }

        $data = $request->validate([
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);
        Adoption::create([
            'animal_id' => $animal->id,
            'user_id'   => Auth::id(),
            'notes'     => $data['notes'] ?? null,
            'status'    => 'pending',
        ]);
        return back()->with('success', 'Adoption request submitted successfully!');
    }
    // admin approves adoption
    public function approve(Adoption $adoption){
        $this->ensureAdmin();

        $adoption->update([
            'status' => 'approved',
            'adoption_date' => now()->toDateString(),
        ]);
        $adoption->animal->update([
            'status' => 'adopted',
        ]);

        return back()->with('success', 'Adoption request approved successfully!');
    }

    // admin rejects adoption
    public function reject(Request $request, Adoption $adoption){
        $this->ensureAdmin();

        $data = $request->validate([
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);
        $adoption->update([
            'status' => 'rejected',
            'notes'  => $data['notes'] ?? $adoption->notes,
        ]);

        return back()->with('success', 'Adoption request rejected successfully!');
    }
    private function ensureAdmin(){
        if(!Auth::check() || Auth::user()->role !== 'admin'){
            abort(403);
        }
    }
}
