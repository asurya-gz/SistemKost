<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $allowedPerPage = [3, 5, 10];
        
        if (!in_array($perPage, $allowedPerPage)) {
            $perPage = 10;
        }
        
        $search = $request->get('search');
        $statusFilter = $request->get('status_filter');
        
        $query = Booking::with(['user', 'kamar.typeKamar']);
        
        // Apply search filter
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('booking_code', 'like', '%' . $search . '%')
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', '%' . $search . '%')
                                ->orWhere('email', 'like', '%' . $search . '%');
                  })
                  ->orWhereHas('kamar', function($kamarQuery) use ($search) {
                      $kamarQuery->where('nama_kamar', 'like', '%' . $search . '%');
                  });
            });
        }
        
        // Apply status filter
        if ($statusFilter && $statusFilter !== 'all') {
            $query->where('status', $statusFilter);
        }
        
        $bookings = $query->orderBy('created_at', 'desc')->paginate($perPage);
        $bookings->appends($request->query());
        
        return view('admin.booking.index', compact('bookings', 'perPage', 'search', 'statusFilter'));
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

    public function paymentConfirmations(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $allowedPerPage = [3, 5, 10];
        
        if (!in_array($perPage, $allowedPerPage)) {
            $perPage = 10;
        }
        
        $search = $request->get('search');
        
        // Get bookings with confirmed status (awaiting verification)
        $query = Booking::with(['user', 'kamar.typeKamar'])
                       ->where('status', 'confirmed')
                       ->whereNotNull('transfer_proof');
        
        // Apply search filter
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('booking_code', 'like', '%' . $search . '%')
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', '%' . $search . '%')
                                ->orWhere('email', 'like', '%' . $search . '%');
                  })
                  ->orWhereHas('kamar', function($kamarQuery) use ($search) {
                      $kamarQuery->where('nama_kamar', 'like', '%' . $search . '%');
                  });
            });
        }
        
        $confirmations = $query->orderBy('confirmed_at', 'desc')->paginate($perPage);
        $confirmations->appends($request->query());
        
        return view('admin.payment-confirmations.index', compact('confirmations', 'perPage', 'search'));
    }

    public function approvePayment($id)
    {
        try {
            $booking = Booking::findOrFail($id);
            
            if ($booking->status !== 'confirmed') {
                return response()->json([
                    'success' => false,
                    'message' => 'Pembayaran tidak dapat disetujui karena status booking bukan confirmed'
                ]);
            }
            
            // Update booking to verified status
            $booking->update([
                'status' => 'verified',
                'verified_at' => now(),
                'verified_by' => auth()->id()
            ]);
            
            // Update room status to occupied
            $booking->kamar->update(['status_kamar' => 'Dihuni']);
            
            return response()->json([
                'success' => true,
                'message' => 'Pembayaran berhasil disetujui dan booking dikonfirmasi'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyetujui pembayaran: ' . $e->getMessage()
            ]);
        }
    }

    public function rejectPayment(Request $request, $id)
    {
        try {
            $booking = Booking::findOrFail($id);
            
            if ($booking->status !== 'confirmed') {
                return response()->json([
                    'success' => false,
                    'message' => 'Pembayaran tidak dapat ditolak karena status booking bukan confirmed'
                ]);
            }
            
            // Update booking to need_revision status
            $booking->update([
                'status' => 'need_revision',
                'rejection_reason' => $request->reason,
                'rejected_at' => now(),
                'rejected_by' => auth()->id()
            ]);
            
            // Keep room status as booked since user still has the booking
            // They just need to revise their payment proof
            
            return response()->json([
                'success' => true,
                'message' => 'Pembayaran ditolak. Pengguna perlu merevisi bukti pembayaran.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menolak pembayaran: ' . $e->getMessage()
            ]);
        }
    }

    public function extensionRequests(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $allowedPerPage = [3, 5, 10];
        
        if (!in_array($perPage, $allowedPerPage)) {
            $perPage = 10;
        }
        
        $search = $request->get('search');
        
        // Get bookings with extension requests
        $query = Booking::with(['user', 'kamar.typeKamar'])
                       ->where('extension_requested', true);
        
        // Apply search filter
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('booking_code', 'like', '%' . $search . '%')
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', '%' . $search . '%')
                                ->orWhere('email', 'like', '%' . $search . '%');
                  })
                  ->orWhereHas('kamar', function($kamarQuery) use ($search) {
                      $kamarQuery->where('nama_kamar', 'like', '%' . $search . '%');
                  });
            });
        }
        
        $extensions = $query->orderBy('updated_at', 'desc')->paginate($perPage);
        $extensions->appends($request->query());
        
        return view('admin.extensions.index', compact('extensions', 'perPage', 'search'));
    }

    public function approveExtension($id)
    {
        try {
            $booking = Booking::findOrFail($id);
            
            if (!$booking->extension_requested) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ada permintaan perpanjangan untuk booking ini'
                ]);
            }
            
            $booking->approveExtension();
            
            return response()->json([
                'success' => true,
                'message' => 'Perpanjangan berhasil disetujui'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyetujui perpanjangan: ' . $e->getMessage()
            ]);
        }
    }

    public function rejectExtension(Request $request, $id)
    {
        try {
            $booking = Booking::findOrFail($id);
            
            if (!$booking->extension_requested) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ada permintaan perpanjangan untuk booking ini'
                ]);
            }
            
            // Reset extension request
            $booking->update([
                'extension_requested' => false,
                'rental_duration_months' => 3
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Perpanjangan ditolak'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menolak perpanjangan: ' . $e->getMessage()
            ]);
        }
    }
}