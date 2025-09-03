@extends('layouts.admin')

@section('title', 'Booking - Admin Dashboard')

@section('page-title', 'Booking')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-semibold text-gray-900">Daftar Booking</h3>
        <div class="flex space-x-2">
            <form method="GET" action="{{ route('admin.booking.index') }}" class="flex space-x-2">
                <select name="status" onchange="this.form.submit()" class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    <option value="all" {{ request('status') === 'all' || !request('status') ? 'selected' : '' }}>Semua Status</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    <option value="expired" {{ request('status') === 'expired' ? 'selected' : '' }}>Expired</option>
                </select>
            </form>
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-gray-50">
                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Kode Booking</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">User</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Kamar</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Total</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Status</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Tanggal</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($bookings as $booking)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-4 py-4">
                        <div class="font-medium text-gray-900">{{ $booking->booking_code }}</div>
                        @if($booking->is_expired)
                            <span class="text-xs text-red-600 font-medium">Expired</span>
                        @elseif($booking->status === 'pending')
                            <span class="text-xs text-amber-600">{{ $booking->time_remaining }}</span>
                        @endif
                    </td>
                    <td class="px-4 py-4">
                        <div class="font-medium text-gray-900">{{ $booking->user->name }}</div>
                        <div class="text-sm text-gray-500">{{ $booking->user->email }}</div>
                    </td>
                    <td class="px-4 py-4">
                        <div class="font-medium text-gray-900">{{ $booking->kamar->nama_kamar }}</div>
                        @if($booking->kamar->typeKamar)
                            <div class="text-sm text-gray-500">{{ $booking->kamar->typeKamar->nama_tipe }}</div>
                        @endif
                    </td>
                    <td class="px-4 py-4">
                        <div class="font-medium text-gray-900">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</div>
                        <div class="text-sm text-gray-500 capitalize">{{ str_replace('_', ' ', $booking->payment_method) }}</div>
                    </td>
                    <td class="px-4 py-4">
                        @if($booking->status === 'pending')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                Pending
                            </span>
                        @elseif($booking->status === 'confirmed')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Confirmed
                            </span>
                        @elseif($booking->status === 'cancelled')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                Cancelled
                            </span>
                        @elseif($booking->status === 'expired')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                Expired
                            </span>
                        @endif
                    </td>
                    <td class="px-4 py-4">
                        <div class="text-sm text-gray-900">{{ $booking->created_at->format('d M Y') }}</div>
                        <div class="text-xs text-gray-500">{{ $booking->created_at->format('H:i') }}</div>
                    </td>
                    <td class="px-4 py-4">
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('admin.booking.show', $booking->id) }}" 
                               class="inline-flex items-center justify-center w-8 h-8 text-blue-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition-colors"
                               title="Lihat Detail">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </a>
                            @if($booking->status === 'pending')
                                <button onclick="confirmBooking({{ $booking->id }})" 
                                        class="inline-flex items-center justify-center w-8 h-8 text-green-600 hover:text-green-700 hover:bg-green-50 rounded-lg transition-colors"
                                        title="Konfirmasi Booking">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </button>
                                <button onclick="cancelBooking({{ $booking->id }})" 
                                        class="inline-flex items-center justify-center w-8 h-8 text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors"
                                        title="Batalkan Booking">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-12 text-center text-gray-500">
                        <div class="flex flex-col items-center">
                            <svg class="w-12 h-12 mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <p class="text-lg font-medium mb-2">Belum ada booking</p>
                            <p class="text-sm">Data booking akan muncul di sini ketika ada pengguna yang melakukan booking</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    @if($bookings->hasPages())
        <div class="mt-6 flex justify-center">
            {{ $bookings->withQueryString()->links() }}
        </div>
    @endif
</div>

@push('scripts')
<script>
function confirmBooking(bookingId) {
    if (confirm('Yakin ingin mengkonfirmasi booking ini?')) {
        fetch(`/admin/booking/${bookingId}/confirm`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Gagal mengkonfirmasi booking: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengkonfirmasi booking');
        });
    }
}

function cancelBooking(bookingId) {
    if (confirm('Yakin ingin membatalkan booking ini?')) {
        fetch(`/admin/booking/${bookingId}/cancel`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Gagal membatalkan booking: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat membatalkan booking');
        });
    }
}
</script>
@endpush
@endsection