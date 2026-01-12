<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;

class AdminController extends Controller
{
    public function index()
    {
        $totalDonations = Donation::where('status', 'succeeded')->sum('amount') / 100; // convert cents to euros
        return view('admin.index', compact('totalDonations'));
    }
}
