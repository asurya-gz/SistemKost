@extends('layouts.dashboard')

@section('title', 'Riwayat Booking - Kost Honest')

@section('content')
<div class="min-h-screen bg-gray-100">
    <!-- Header -->
    <header class="bg-white shadow-lg border-b border-gray-200">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex items-center space-x-4">
                <a href="{{ route('pengguna.dashboard') }}" class="flex items-center justify-center w-12 h-12 rounded-xl bg-gray-100 hover:bg-gray-200 transition-all duration-200 group">
                    <svg class="w-5 h-5 text-gray-600 group-hover:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-red-600">Riwayat Booking</h1>
                    <p class="text-gray-600 mt-1">Lihat semua booking yang pernah Anda buat</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Content -->
    <div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        @if($bookings->count() > 0)
            <!-- Controls Section -->
            <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <!-- Page Info -->
                <div class="text-sm text-gray-600">
                    Menampilkan {{ $bookings->firstItem() }} - {{ $bookings->lastItem() }} dari {{ $bookings->total() }} booking
                </div>
                
                <!-- Per Page Selector -->
                <div class="flex items-center space-x-3">
                    <label for="per_page" class="text-sm font-medium text-gray-700 whitespace-nowrap">
                        Tampilkan per halaman:
                    </label>
                    <select id="per_page" name="per_page" onchange="changePerPage(this.value)"
                            class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500 bg-white min-w-[70px]">
                        <option value="3" {{ $perPage == 3 ? 'selected' : '' }}>3</option>
                        <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                        <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                    </select>
                </div>
            </div>
            <!-- Booking Cards -->
            <div class="space-y-6">
                @foreach($bookings as $booking)
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <!-- Booking Code and Status -->
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">{{ $booking->booking_code }}</h3>
                                <p class="text-sm text-gray-500 mt-1">{{ $booking->created_at->format('d M Y H:i') }}</p>
                            </div>
                            
                            <!-- Status Badge -->
                            <div>
                                @switch($booking->status)
                                    @case('pending')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                            <div class="w-2 h-2 bg-yellow-400 rounded-full mr-2 animate-pulse"></div>
                                            Menunggu Pembayaran
                                        </span>
                                        @break
                                    @case('confirmed')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                            <div class="w-2 h-2 bg-green-400 rounded-full mr-2"></div>
                                            Terkonfirmasi
                                        </span>
                                        @break
                                    @case('expired')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                            <div class="w-2 h-2 bg-gray-400 rounded-full mr-2"></div>
                                            Expired
                                        </span>
                                        @break
                                    @case('cancelled')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                            <div class="w-2 h-2 bg-red-400 rounded-full mr-2"></div>
                                            Dibatalkan
                                        </span>
                                        @break
                                @endswitch
                            </div>
                        </div>

                        <!-- Room Details -->
                        <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6">
                            <!-- Room Info -->
                            <div class="flex items-start space-x-4 flex-1">
                                <!-- Room Image -->
                                <div class="flex-shrink-0 relative">
                                    @php
                                        $firstImage = $booking->kamar->typeKamar->gambarTypeKamar->first()->url ?? 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=400&h=300&fit=crop&crop=center'
                                    @endphp
                                    <img src="{{ $firstImage }}" 
                                         alt="{{ $booking->kamar->nama_kamar }}" 
                                         class="w-32 h-24 rounded-xl object-cover">
                                </div>
                                
                                <!-- Room Details -->
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-lg font-semibold text-gray-900">{{ $booking->kamar->nama_kamar }}</h4>
                                    <p class="text-gray-600">{{ $booking->kamar->typeKamar->nama }}</p>
                                    <p class="text-sm text-gray-500 mt-1">{{ $booking->kamar->typeKamar->ukuran_kamar }} • {{ $booking->kamar->typeKamar->type_kasur }}</p>
                                    
                                    <!-- Payment Method -->
                                    <div class="mt-2">
                                        <span class="text-sm text-gray-500">Metode Pembayaran: </span>
                                        <span class="text-sm font-medium text-gray-900">
                                            @switch($booking->payment_method)
                                                @case('transfer_bank')
                                                    Transfer Bank
                                                    @break
                                                @case('e_wallet')
                                                    E-Wallet
                                                    @break
                                                @case('virtual_account')
                                                    Virtual Account
                                                    @break
                                                @case('cash')
                                                    Bayar Cash
                                                    @break
                                            @endswitch
                                        </span>
                                    </div>

                                    @if($booking->notes)
                                    <div class="mt-2">
                                        <span class="text-sm text-gray-500">Catatan: </span>
                                        <span class="text-sm text-gray-900">{{ $booking->notes }}</span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Price and Actions -->
                            <div class="flex flex-col lg:items-end lg:text-right space-y-4 lg:min-w-[200px]">
                                <div>
                                    <p class="text-2xl font-bold text-red-600">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</p>
                                    <p class="text-sm text-gray-500">per bulan</p>
                                    
                                    @if($booking->status === 'pending' && !$booking->is_expired)
                                        <div class="mt-2">
                                            <p class="text-xs text-red-600 font-medium">Expires in:</p>
                                            <p class="text-sm font-bold text-red-600">{{ $booking->time_remaining }}</p>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Action Buttons -->
                                <div class="flex flex-col space-y-2 w-full lg:w-auto lg:min-w-[140px]">
                                    <a href="{{ route('booking.detail', $booking->booking_code) }}" 
                                       class="inline-block text-center bg-blue-600 text-white py-2.5 px-6 rounded-lg hover:bg-blue-700 font-medium transition duration-300 text-sm whitespace-nowrap">
                                        Lihat Detail
                                    </a>
                                    
                                    @if($booking->status === 'pending' && !$booking->is_expired)
                                        <button onclick="cancelBooking('{{ $booking->booking_code }}')" 
                                                class="text-center border-2 border-red-600 text-red-600 py-2.5 px-6 rounded-lg hover:bg-red-50 font-medium transition duration-300 text-sm whitespace-nowrap">
                                            Batalkan
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <!-- Pagination Info -->
                    <div class="text-sm text-gray-600 order-2 sm:order-1">
                        Halaman {{ $bookings->currentPage() }} dari {{ $bookings->lastPage() }}
                    </div>
                    
                    <!-- Pagination Links -->
                    <div class="order-1 sm:order-2">
                        {{ $bookings->links() }}
                    </div>
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="w-24 h-24 bg-gray-200 rounded-full mx-auto mb-6 flex items-center justify-center">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Booking</h3>
                <p class="text-gray-600 mb-6">Anda belum pernah melakukan booking kamar</p>
                <a href="{{ route('rooms.index') }}" 
                   class="bg-red-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-red-700 transition duration-300">
                    Mulai Booking Sekarang
                </a>
            </div>
        @endif
    </div>
</div>

<script>
function cancelBooking(bookingCode) {
    if (confirm('Apakah Anda yakin ingin membatalkan booking ini?')) {
        fetch('/booking/cancel/' + bookingCode, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Booking berhasil dibatalkan');
                window.location.reload();
            } else {
                alert(data.message || 'Terjadi kesalahan');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat membatalkan booking');
        });
    }
}

function changePerPage(value) {
    // Get current URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    
    // Update per_page parameter
    urlParams.set('per_page', value);
    
    // Remove page parameter to go to first page when changing per_page
    urlParams.delete('page');
    
    // Redirect to new URL
    window.location.href = window.location.pathname + '?' + urlParams.toString();
}
</script>
@endsection