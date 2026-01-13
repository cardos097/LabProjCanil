<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Support\Facades\Auth;

class AdminDonationController extends Controller
{
    public function index()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }

        $donations = Donation::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.donations.index', compact('donations'));
    }
}
