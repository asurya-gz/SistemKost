<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'kamar.typeKamar']);
        
        // Filter by status if provided
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }
        
        $bookings = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return view('admin.booking.index', compact('bookings'));
    }

    public function create()
    {
        return view('admin.booking.create');
    }

    public function store(Request $request)
    {
        // Implementation for storing booking
    }

    public function show($id)
    {
        return view('admin.booking.show', compact('id'));
    }

    public function edit($id)
    {
        return view('admin.booking.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Implementation for updating booking
    }

    public function destroy($id)
    {
        // Implementation for deleting booking
    }

    public function confirm($id)
    {
        try {
            $booking = Booking::findOrFail($id);
            
            if ($booking->status !== 'pending') {
                return response()->json([
                    'success' => false,
                    'message' => 'Booking tidak dapat dikonfirmasi karena status saat ini adalah ' . $booking->status
                ]);
            }
            
            $booking->confirm();
            
            return response()->json([
                'success' => true,
                'message' => 'Booking berhasil dikonfirmasi'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengkonfirmasi booking: ' . $e->getMessage()
            ]);
        }
    }

    public function cancel($id)
    {
        try {
            $booking = Booking::findOrFail($id);
            
            if ($booking->status !== 'pending') {
                return response()->json([
                    'success' => false,
                    'message' => 'Booking tidak dapat dibatalkan karena status saat ini adalah ' . $booking->status
                ]);
            }
            
            $booking->cancel();
            
            return response()->json([
                'success' => true,
                'message' => 'Booking berhasil dibatalkan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal membatalkan booking: ' . $e->getMessage()
            ]);
        }
    }
}