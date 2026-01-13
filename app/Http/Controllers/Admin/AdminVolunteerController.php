<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\VolunteerApproved;
use App\Mail\VolunteerRejected;

class AdminVolunteerController extends Controller
{
    public function index()
    {
        $volunteers = Volunteer::with('user')->paginate(10);
        return view('admin.volunteers.index', compact('volunteers'));
    }

    public function approve(Volunteer $volunteer)
    {
        $volunteer->update(['status' => 'approved']);

        // Send email (with error handling for rate limits)
        try {
            Mail::to($volunteer->user->email)->send(new VolunteerApproved($volunteer));
        } catch (\Exception $e) {
            Log::warning('Failed to send volunteer approval email: ' . $e->getMessage());
        }

        return back()->with('success', 'Volunteer request approved successfully!');
    }

    public function reject(Request $request, Volunteer $volunteer)
    {
        $data = $request->validate([
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $volunteer->update(['status' => 'rejected']);

        // Send email (with error handling for rate limits)
        try {
            Mail::to($volunteer->user->email)->send(new VolunteerRejected($volunteer, $data['notes'] ?? null));
        } catch (\Exception $e) {
            Log::warning('Failed to send volunteer rejection email: ' . $e->getMessage());
        }

        return back()->with('success', 'Volunteer request rejected successfully!');
    }
}
