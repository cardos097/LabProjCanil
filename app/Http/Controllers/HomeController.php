<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $totalDonations = Donation::whereIn('status', ['completed', 'paid'])->sum('amount') / 100;
        
        return view('home', compact('totalDonations'));
    }
}
