@extends('layouts.dashboard')

@section('title', 'Detail Booking - Kost Honest')

@section('content')
<div class="min-h-screen bg-gray-100">
    <!-- Header -->
    <header class="bg-white shadow-lg border-b border-gray-200">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex items-center space-x-4">
                <a href="{{ route('booking.history') }}" class="flex items-center justify-center w-12 h-12 rounded-xl bg-gray-100 hover:bg-gray-200 transition-all duration-200 group">
                    <svg class="w-5 h-5 text-gray-600 group-hover:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-blue-600">Detail Booking</h1>
                    <p class="text-gray-600 mt-1">{{ $booking->booking_code }}</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Content -->
    <div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <!-- Status Alert -->
        @switch($booking->status)
            @case('pending')
                @if($booking->is_expired)
                    <div class="bg-red-50 border-l-4 border-red-400 p-6 mb-8 rounded-r-xl shadow-sm">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                                    <svg class="h-8 w-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-bold text-red-800">Booking Expired</h3>
                                <p class="text-red-700 mt-1">Booking ini telah expired karena tidak ada pembayaran dalam batas waktu yang ditentukan</p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-6 mb-8 rounded-r-xl shadow-sm">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                                    <svg class="h-8 w-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-bold text-yellow-800">Menunggu Pembayaran</h3>
                                <p class="text-yellow-700 mt-1">Booking Anda menunggu pembayaran. Segera lakukan pembayaran sebelum expired.</p>
                                <p class="text-sm text-yellow-600 mt-2 font-medium">
                                    Expires: {{ $booking->booking_expires_at->format('d M Y H:i') }} ({{ $booking->time_remaining }})
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
                @break
            @case('confirmed')
                <div class="bg-green-50 border-l-4 border-green-400 p-6 mb-8 rounded-r-xl shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="h-8 w-8 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-xl font-bold text-green-800">Booking Terkonfirmasi</h3>
                            <p class="text-green-700 mt-1">Pembayaran Anda telah berhasil dan kamar telah direservasi</p>
                        </div>
                    </div>
                </div>
                @break
            @case('cancelled')
                <div class="bg-red-50 border-l-4 border-red-400 p-6 mb-8 rounded-r-xl shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                                <svg class="h-8 w-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-xl font-bold text-red-800">Booking Dibatalkan</h3>
                            <p class="text-red-700 mt-1">Booking ini telah dibatalkan</p>
                        </div>
                    </div>
                </div>
                @break
            @case('expired')
                <div class="bg-gray-50 border-l-4 border-gray-400 p-6 mb-8 rounded-r-xl shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center">
                                <svg class="h-8 w-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-xl font-bold text-gray-800">Booking Expired</h3>
                            <p class="text-gray-700 mt-1">Booking ini telah expired karena melebihi batas waktu pembayaran</p>
                        </div>
                    </div>
                </div>
                @break
        @endswitch

        <!-- Booking Details Card -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden mb-8">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold text-white">Informasi Booking</h3>
                    <span class="bg-white bg-opacity-20 text-white px-3 py-1 rounded-full text-sm font-medium">
                        {{ $booking->booking_code }}
                    </span>
                </div>
            </div>

            <!-- Content -->
            <div class="p-6">
                <div class="grid lg:grid-cols-3 gap-8">
                    <!-- Room Images -->
                    <div class="lg:col-span-1">
                        <h4 class="text-lg font-bold text-gray-900 mb-4">Foto Kamar</h4>
                        @php
                            $images = $booking->kamar->typeKamar->gambarTypeKamar ?? collect();
                        @endphp
                        
                        @if($images->count() > 0)
                            <div class="space-y-4">
                                @foreach($images->take(3) as $image)
                                    <img src="{{ $image->url }}" 
                                         alt="{{ $booking->kamar->nama_kamar }}" 
                                         class="w-full h-48 rounded-xl object-cover shadow-sm">
                                @endforeach
                            </div>
                        @else
                            <div class="w-full h-48 bg-gray-200 rounded-xl flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Booking Information -->
                    <div class="lg:col-span-2 space-y-8">
                        <!-- Room Details -->
                        <div>
                            <h4 class="text-lg font-bold text-gray-900 mb-4">Detail Kamar</h4>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-gray-600">Nama Kamar:</span>
                                    <span class="font-medium text-gray-900">{{ $booking->kamar->nama_kamar }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-gray-600">Tipe Kamar:</span>
                                    <span class="font-medium text-gray-900">{{ $booking->kamar->typeKamar->nama }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-gray-600">Ukuran:</span>
                                    <span class="font-medium text-gray-900">{{ $booking->kamar->typeKamar->ukuran_kamar }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-gray-600">Tipe Kasur:</span>
                                    <span class="font-medium text-gray-900">{{ $booking->kamar->typeKamar->type_kasur }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-gray-600">Harga:</span>
                                    <span class="font-bold text-red-600 text-lg">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Booking Info -->
                        <div>
                            <h4 class="text-lg font-bold text-gray-900 mb-4">Informasi Booking</h4>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-gray-600">Kode Booking:</span>
                                    <span class="font-medium text-gray-900 font-mono">{{ $booking->booking_code }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-gray-600">Tanggal Booking:</span>
                                    <span class="font-medium text-gray-900">{{ $booking->created_at->format('d M Y H:i') }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-gray-600">Status:</span>
                                    <span class="font-medium">
                                        @switch($booking->status)
                                            @case('pending')
                                                @if($booking->is_expired)
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                                        <div class="w-2 h-2 bg-red-400 rounded-full mr-2"></div>
                                                        Expired
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                                        <div class="w-2 h-2 bg-yellow-400 rounded-full mr-2 animate-pulse"></div>
                                                        Menunggu Pembayaran
                                                    </span>
                                                @endif
                                                @break
                                            @case('confirmed')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                                    <div class="w-2 h-2 bg-green-400 rounded-full mr-2"></div>
                                                    Terkonfirmasi
                                                </span>
                                                @break
                                            @case('cancelled')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                                    <div class="w-2 h-2 bg-red-400 rounded-full mr-2"></div>
                                                    Dibatalkan
                                                </span>
                                                @break
                                            @case('expired')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                                    <div class="w-2 h-2 bg-gray-400 rounded-full mr-2"></div>
                                                    Expired
                                                </span>
                                                @break
                                        @endswitch
                                    </span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-gray-600">Metode Pembayaran:</span>
                                    <span class="font-medium text-gray-900">
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
                                @if($booking->status === 'pending' && !$booking->is_expired)
                                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                        <span class="text-gray-600">Expires At:</span>
                                        <span class="font-medium text-red-600">{{ $booking->booking_expires_at->format('d M Y H:i') }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Notes -->
                        @if($booking->notes)
                        <div>
                            <h4 class="text-lg font-bold text-gray-900 mb-4">Catatan</h4>
                            <div class="bg-gray-50 p-4 rounded-xl">
                                <p class="text-gray-700">{{ $booking->notes }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        @if($booking->status === 'pending' && !$booking->is_expired)
                            <button onclick="confirmBooking()" 
                                    class="bg-green-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-green-700 transition duration-300">
                                Konfirmasi Pembayaran
                            </button>
                            <button onclick="cancelBooking()" 
                                    class="border-2 border-red-600 text-red-600 px-6 py-3 rounded-xl font-semibold hover:bg-red-50 transition duration-300">
                                Batalkan Booking
                            </button>
                        @endif
                        
                        <a href="{{ route('booking.history') }}" 
                           class="bg-gray-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-gray-700 transition duration-300 text-center">
                            Kembali ke Riwayat
                        </a>
                        
                        <a href="{{ route('rooms.index') }}" 
                           class="bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-blue-700 transition duration-300 text-center">
                            Lihat Kamar Lain
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
function confirmBooking() {
    if (confirm('Apakah Anda yakin sudah melakukan pembayaran untuk booking ini?')) {
        fetch('/booking/confirm/{{ $booking->booking_code }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Booking berhasil dikonfirmasi!');
                window.location.reload();
            } else {
                alert(data.message || 'Terjadi kesalahan');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengkonfirmasi booking');
        });
    }
}

function cancelBooking() {
    if (confirm('Apakah Anda yakin ingin membatalkan booking ini?')) {
        fetch('/booking/cancel/{{ $booking->booking_code }}', {
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
                window.location.href = '{{ route("booking.history") }}';
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

// Auto-refresh page if booking is expired
@if($booking->status === 'pending' && !$booking->is_expired)
function checkExpiry() {
    const expiresAt = new Date('{{ $booking->booking_expires_at->toISOString() }}');
    const now = new Date();
    
    if (now >= expiresAt) {
        setTimeout(() => {
            window.location.reload();
        }, 2000);
    }
}

// Check expiry every 30 seconds
setInterval(checkExpiry, 30000);
@endif
</script>
@endsection