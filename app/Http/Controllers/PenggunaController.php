<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class PenggunaController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        
        // Check if user has any verified booking (admin approved)
        $hasVerifiedBooking = Booking::where('user_id', $user->id)
                                   ->where('status', 'verified')
                                   ->exists();
        
        // Get current verified booking if exists
        $currentBooking = null;
        if ($hasVerifiedBooking) {
            $currentBooking = Booking::with(['kamar.typeKamar'])
                                   ->where('user_id', $user->id)
                                   ->where('status', 'verified')
                                   ->latest()
                                   ->first();
        }
        
        return view('pengguna.dashboard', compact('hasVerifiedBooking', 'currentBooking'));
    }
}