@extends('layouts.admin')

@section('title', 'Booking - Admin Dashboard')

@section('page-title', 'Booking')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6 h-[90vh] flex flex-col">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-semibold text-gray-900">Daftar Booking</h3>
    </div>

    <!-- Search and Filter Section -->
    <div class="mb-6 bg-gray-50 p-4 rounded-lg">
        <form method="GET" action="{{ route('admin.booking.index') }}" class="flex gap-4 items-center">
            <!-- Search Input -->
            <div class="flex-1">
                <input type="text" 
                       name="search" 
                       id="search"
                       value="{{ $search ?? '' }}"
                       placeholder="Cari kode booking, nama user, email, atau nama kamar..."
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
            </div>
            
            <!-- Status Filter -->
            <div class="min-w-40">
                <select name="status_filter" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    <option value="all" {{ $statusFilter === 'all' || !$statusFilter ? 'selected' : '' }}>Semua Status</option>
                    <option value="pending" {{ $statusFilter === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ $statusFilter === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="cancelled" {{ $statusFilter === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    <option value="expired" {{ $statusFilter === 'expired' ? 'selected' : '' }}>Expired</option>
                </select>
            </div>
            
            <!-- Preserve per_page value -->
            <input type="hidden" name="per_page" value="{{ $perPage }}">
            
            <!-- Action Buttons -->
            <div class="flex space-x-2">
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition-colors flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <span>Cari</span>
                </button>
                <a href="{{ route('admin.booking.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md transition-colors flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    <span>Reset</span>
                </a>
            </div>
        </form>
    </div>

    <div class="flex-1 overflow-hidden flex flex-col">
        <div class="flex-1 overflow-x-auto">
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
        
        <!-- Pagination Links -->
        <div class="mt-6 border-t border-gray-200 pt-4">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div class="flex items-center space-x-4">
                    <div class="text-sm text-gray-700">
                        Menampilkan <span class="font-medium">{{ $perPage }}</span> dari <span class="font-medium">{{ $bookings->total() }}</span> hasil
                    </div>
                    
                    <!-- Per Page Selector -->
                    <div class="flex items-center space-x-2">
                        <label class="text-sm text-gray-600">Per halaman:</label>
                        <select id="perPageSelect" 
                                class="px-3 py-1 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                            <option value="3" {{ $perPage == 3 ? 'selected' : '' }}>3</option>
                            <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                            <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                        </select>
                    </div>
                </div>
                
                @if($bookings->hasPages())
                <div class="flex space-x-1">
                    {{-- Previous Page Link --}}
                    @if($bookings->onFirstPage())
                        <span class="px-3 py-2 text-sm text-gray-400 bg-gray-100 border border-gray-300 rounded-md cursor-not-allowed">
                            &laquo; Previous
                        </span>
                    @else
                        <a href="{{ $bookings->previousPageUrl() }}" 
                           class="px-3 py-2 text-sm text-gray-600 bg-white border border-gray-300 rounded-md hover:bg-gray-50 hover:text-gray-800 transition-colors">
                            &laquo; Previous
                        </a>
                    @endif

                    {{-- Page Numbers with Smart Display --}}
                    @php
                        $currentPage = $bookings->currentPage();
                        $lastPage = $bookings->lastPage();
                        $maxVisible = 5; // Maximum visible page numbers
                        
                        if ($lastPage <= $maxVisible) {
                            // If total pages <= 5, show all
                            $startPage = 1;
                            $endPage = $lastPage;
                        } else {
                            // Smart pagination logic
                            if ($currentPage <= 3) {
                                $startPage = 1;
                                $endPage = $maxVisible;
                            } elseif ($currentPage >= $lastPage - 2) {
                                $startPage = $lastPage - $maxVisible + 1;
                                $endPage = $lastPage;
                            } else {
                                $startPage = $currentPage - 2;
                                $endPage = $currentPage + 2;
                            }
                        }
                    @endphp

                    {{-- First page and ellipsis --}}
                    @if($startPage > 1)
                        <a href="{{ $bookings->url(1) }}" 
                           class="px-3 py-2 text-sm text-gray-600 bg-white border border-gray-300 rounded-md hover:bg-gray-50 hover:text-gray-800 transition-colors">
                            1
                        </a>
                        @if($startPage > 2)
                            <span class="px-3 py-2 text-sm text-gray-500">...</span>
                        @endif
                    @endif

                    {{-- Visible page range --}}
                    @for($page = $startPage; $page <= $endPage; $page++)
                        @if($page == $currentPage)
                            <span class="px-3 py-2 text-sm font-medium text-white bg-red-600 border border-red-600 rounded-md">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $bookings->url($page) }}" 
                               class="px-3 py-2 text-sm text-gray-600 bg-white border border-gray-300 rounded-md hover:bg-gray-50 hover:text-gray-800 transition-colors">
                                {{ $page }}
                            </a>
                        @endif
                    @endfor

                    {{-- Last page and ellipsis --}}
                    @if($endPage < $lastPage)
                        @if($endPage < $lastPage - 1)
                            <span class="px-3 py-2 text-sm text-gray-500">...</span>
                        @endif
                        <a href="{{ $bookings->url($lastPage) }}" 
                           class="px-3 py-2 text-sm text-gray-600 bg-white border border-gray-300 rounded-md hover:bg-gray-50 hover:text-gray-800 transition-colors">
                            {{ $lastPage }}
                        </a>
                    @endif

                    {{-- Next Page Link --}}
                    @if($bookings->hasMorePages())
                        <a href="{{ $bookings->nextPageUrl() }}" 
                           class="px-3 py-2 text-sm text-gray-600 bg-white border border-gray-300 rounded-md hover:bg-gray-50 hover:text-gray-800 transition-colors">
                            Next &raquo;
                        </a>
                    @else
                        <span class="px-3 py-2 text-sm text-gray-400 bg-gray-100 border border-gray-300 rounded-md cursor-not-allowed">
                            Next &raquo;
                        </span>
                    @endif
                </div>
                @else
                <div class="text-sm text-gray-500">
                    Halaman 1 dari 1
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const perPageSelect = document.getElementById('perPageSelect');
    
    if (perPageSelect) {
        perPageSelect.addEventListener('change', function() {
            const selectedValue = this.value;
            const currentUrl = new URL(window.location.href);
            
            // Update the per_page parameter
            currentUrl.searchParams.set('per_page', selectedValue);
            // Reset to page 1 when changing per_page
            currentUrl.searchParams.delete('page');
            
            // Redirect to new URL
            window.location.href = currentUrl.toString();
        });
    }
});

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