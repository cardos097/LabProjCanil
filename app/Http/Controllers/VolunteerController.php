<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Volunteer;
use Illuminate\Support\Facades\Auth;

class VolunteerController extends Controller
{
    public function create(){
        return view('volunteers.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'availability'=>['nullable','string','max:300'],
            'skills'=>['nullable','string','max:1000'],
            'notes'=>['nullable','string','max:1000'],
        ]);

        Volunteer::updateOrCreate(
            ['user_id'=> Auth::id()],
            ['availability'=>$data['availability'] ?? null,
            'skills'=>$data['skills'] ?? null,
            'notes'=>$data['notes'] ?? null,
            ]
        );

        return redirect()->route('volunteers.create')->with('success','Volunteer registry done successfully');
    }
}
