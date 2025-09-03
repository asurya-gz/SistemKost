<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'kamar_id' => 'required|exists:kamar,id',
            'payment_method' => 'required|in:transfer_bank,e_wallet,virtual_account,cash',
            'notes' => 'nullable|string|max:500'
        ]);

        $user = Auth::user();
        $kamar = Kamar::with('typeKamar')->findOrFail($request->kamar_id);

        // Check if room is still available
        if ($kamar->status_kamar !== 'Tersedia') {
            return response()->json([
                'success' => false,
                'message' => 'Kamar tidak lagi tersedia'
            ], 400);
        }

        // Check if user has pending booking for this room
        $existingBooking = Booking::where('user_id', $user->id)
                                 ->where('kamar_id', $kamar->id)
                                 ->where('status', 'pending')
                                 ->first();

        if ($existingBooking) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah memiliki booking pending untuk kamar ini'
            ], 400);
        }

        DB::beginTransaction();
        try {
            // Create booking
            $booking = Booking::create([
                'user_id' => $user->id,
                'kamar_id' => $kamar->id,
                'booking_code' => Booking::generateBookingCode(),
                'status' => 'pending',
                'payment_method' => $request->payment_method,
                'total_amount' => $kamar->typeKamar->harga,
                'booking_expires_at' => Carbon::now()->addMinutes(30),
                'notes' => $request->notes
            ]);

            // Update room status to booked
            $kamar->update(['status_kamar' => 'Booked']);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Booking berhasil dibuat',
                'booking_code' => $booking->booking_code
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat membuat booking'
            ], 500);
        }
    }

    public function success($bookingCode)
    {
        $booking = Booking::with(['kamar.typeKamar', 'user'])
                         ->where('booking_code', $bookingCode)
                         ->where('user_id', Auth::id())
                         ->firstOrFail();

        return view('booking.success', compact('booking'));
    }

    public function history()
    {
        $user = Auth::user();
        $bookings = Booking::with(['kamar.typeKamar'])
                          ->where('user_id', $user->id)
                          ->orderBy('created_at', 'desc')
                          ->paginate(10);

        return view('booking.history', compact('bookings'));
    }

    public function cancel($bookingCode)
    {
        $booking = Booking::where('booking_code', $bookingCode)
                         ->where('user_id', Auth::id())
                         ->where('status', 'pending')
                         ->firstOrFail();

        DB::beginTransaction();
        try {
            $booking->cancel();
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Booking berhasil dibatalkan'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat membatalkan booking'
            ], 500);
        }
    }

    public function confirm(Request $request, $bookingCode)
    {
        $booking = Booking::where('booking_code', $bookingCode)
                         ->where('user_id', Auth::id())
                         ->where('status', 'pending')
                         ->firstOrFail();

        // Check if booking is not expired
        if ($booking->is_expired) {
            return response()->json([
                'success' => false,
                'message' => 'Booking telah expired'
            ], 400);
        }

        DB::beginTransaction();
        try {
            $booking->confirm();
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Booking berhasil dikonfirmasi'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengkonfirmasi booking'
            ], 500);
        }
    }

    public function checkExpired()
    {
        $expiredBookings = Booking::expired()->get();

        foreach ($expiredBookings as $booking) {
            DB::beginTransaction();
            try {
                $booking->markAsExpired();
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                \Log::error('Failed to expire booking: ' . $booking->id, ['error' => $e->getMessage()]);
            }
        }

        return response()->json([
            'success' => true,
            'expired_count' => $expiredBookings->count()
        ]);
    }

    public function detail($bookingCode)
    {
        $booking = Booking::with(['kamar.typeKamar.gambarTypeKamar', 'user'])
                         ->where('booking_code', $bookingCode)
                         ->where('user_id', Auth::id())
                         ->firstOrFail();

        return view('booking.detail', compact('booking'));
    }
}