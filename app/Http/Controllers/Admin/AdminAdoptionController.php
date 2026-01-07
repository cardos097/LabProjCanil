<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Adoption;

class AdminAdoptionController extends Controller
{
    public function index()
    {
        $adoptions = Adoption::with(['animal', 'user'])
            ->latest()
            ->paginate(10);

        return view('admin.adoptions.index', compact('adoptions'));
    }
}
