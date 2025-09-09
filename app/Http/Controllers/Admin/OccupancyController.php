<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Kamar;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OccupancyController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $statusFilter = $request->get('status_filter', 'all');
        $perPage = $request->get('per_page', 10);
        
        $allowedPerPage = [5, 10, 25, 50];
        if (!in_array($perPage, $allowedPerPage)) {
            $perPage = 10;
        }

        // Get all rooms with their current occupancy status
        $query = Kamar::with(['typeKamar', 'bookings' => function($q) {
            $q->where('status', 'verified')
              ->whereNotNull('rental_end_date')
              ->where('rental_end_date', '>', Carbon::now())
              ->with(['user.userProfile'])
              ->orderBy('rental_end_date', 'asc');
        }]);

        // Apply search filter
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama_kamar', 'like', '%' . $search . '%')
                  ->orWhereHas('typeKamar', function($typeQuery) use ($search) {
                      $typeQuery->where('nama', 'like', '%' . $search . '%');
                  })
                  ->orWhereHas('bookings.user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', '%' . $search . '%')
                               ->orWhere('email', 'like', '%' . $search . '%');
                  });
            });
        }

        // Apply status filter
        if ($statusFilter !== 'all') {
            $query->where('status_kamar', $statusFilter);
        }

        $rooms = $query->orderBy('nama_kamar')->paginate($perPage);
        $rooms->appends($request->query());

        // Get summary statistics
        $stats = [
            'total_rooms' => Kamar::count(),
            'occupied' => Kamar::where('status_kamar', 'Dihuni')->count(),
            'available' => Kamar::where('status_kamar', 'Tersedia')->count(),
            'booked' => Kamar::where('status_kamar', 'Booked')->count(),
        ];

        // Get rooms with rental expiring soon (within 7 days)
        $expiringRentals = Booking::with(['kamar', 'user'])
            ->where('status', 'verified')
            ->whereNotNull('rental_end_date')
            ->where('rental_end_date', '<=', Carbon::now()->addDays(7))
            ->where('rental_end_date', '>', Carbon::now())
            ->orderBy('rental_end_date', 'asc')
            ->take(5)
            ->get();

        return view('admin.occupancy.index', compact(
            'rooms', 'search', 'statusFilter', 'perPage', 'stats', 'expiringRentals'
        ));
    }

    public function show($id)
    {
        $room = Kamar::with([
            'typeKamar', 
            'bookings' => function($q) {
                $q->with(['user.userProfile'])
                  ->orderBy('created_at', 'desc');
            }
        ])->findOrFail($id);

        // Get current active booking
        $currentBooking = $room->bookings()
            ->where('status', 'verified')
            ->whereNotNull('rental_end_date')
            ->where('rental_end_date', '>', Carbon::now())
            ->with(['user.userProfile'])
            ->first();

        // Get booking history
        $bookingHistory = $room->bookings()
            ->with(['user.userProfile'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.occupancy.show', compact('room', 'currentBooking', 'bookingHistory'));
    }

    public function extendRental(Request $request, $bookingId)
    {
        $request->validate([
            'months' => 'required|integer|min:1|max:12',
            'reason' => 'nullable|string|max:500'
        ]);

        $booking = Booking::findOrFail($bookingId);
        
        if ($booking->status !== 'verified') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya booking yang verified yang bisa diperpanjang'
            ], 400);
        }

        try {
            $booking->rental_end_date = $booking->rental_end_date->addMonths($request->months);
            $booking->save();

            return response()->json([
                'success' => true,
                'message' => "Rental berhasil diperpanjang {$request->months} bulan",
                'new_end_date' => $booking->rental_end_date->format('d/m/Y H:i')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperpanjang rental: ' . $e->getMessage()
            ], 500);
        }
    }

    public function terminateRental(Request $request, $bookingId)
    {
        $request->validate([
            'reason' => 'required|string|max:500'
        ]);

        $booking = Booking::with(['kamar'])->findOrFail($bookingId);
        
        if ($booking->status !== 'verified') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya booking yang verified yang bisa dihentikan'
            ], 400);
        }

        try {
            // Update booking status
            $booking->update([
                'status' => 'terminated',
                'rejection_reason' => $request->reason,
                'rejected_at' => Carbon::now(),
                'rejected_by' => auth()->id()
            ]);

            // Make room available
            $booking->kamar->update(['status_kamar' => 'Tersedia']);

            return response()->json([
                'success' => true,
                'message' => 'Rental berhasil dihentikan dan kamar tersedia kembali'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghentikan rental: ' . $e->getMessage()
            ], 500);
        }
    }
}
