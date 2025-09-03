@extends('layouts.dashboard')

@section('title', 'Booking Berhasil - Kost Honest')

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
                    <h1 class="text-3xl font-bold text-green-600">Booking Berhasil!</h1>
                    <p class="text-gray-600 mt-1">Booking Anda telah berhasil dibuat</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Content -->
    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <!-- Success Message -->
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
                    <h3 class="text-xl font-bold text-green-800">Booking Berhasil Dibuat!</h3>
                    <p class="text-green-700 mt-1">Booking Anda telah berhasil dibuat dan menunggu pembayaran</p>
                </div>
            </div>
        </div>

        <!-- Booking Details Card -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-red-500 to-red-600 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold text-white">Detail Booking</h3>
                    <span class="bg-white bg-opacity-20 text-white px-3 py-1 rounded-full text-sm font-medium">
                        {{ $booking->booking_code }}
                    </span>
                </div>
            </div>

            <!-- Content -->
            <div class="p-6">
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Room Info -->
                    <div>
                        <h4 class="text-lg font-bold text-gray-900 mb-4">Informasi Kamar</h4>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-gray-600">Kamar:</span>
                                <span class="font-medium text-gray-900">{{ $booking->kamar->nama_kamar }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-gray-600">Type:</span>
                                <span class="font-medium text-gray-900">{{ $booking->kamar->typeKamar->nama }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-gray-600">Harga:</span>
                                <span class="font-medium text-red-600">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</span>
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
                        </div>
                    </div>

                    <!-- Booking Info -->
                    <div>
                        <h4 class="text-lg font-bold text-gray-900 mb-4">Status Booking</h4>
                        <div class="space-y-4">
                            <!-- Status Badge -->
                            <div class="flex items-center justify-between p-4 bg-yellow-50 rounded-xl">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-yellow-400 rounded-full mr-3 animate-pulse"></div>
                                    <span class="font-medium text-yellow-800">Menunggu Pembayaran</span>
                                </div>
                            </div>

                            <!-- Time Remaining -->
                            <div class="bg-red-50 p-4 rounded-xl">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-red-800">Waktu tersisa:</span>
                                    <span class="text-lg font-bold text-red-600" id="countdown">
                                        {{ $booking->time_remaining }}
                                    </span>
                                </div>
                                <p class="text-xs text-red-600 mt-2">
                                    Booking akan expired pada {{ $booking->booking_expires_at->format('d M Y H:i') }}
                                </p>
                            </div>

                            <!-- Notes -->
                            @if($booking->notes)
                            <div class="bg-gray-50 p-4 rounded-xl">
                                <span class="text-sm font-medium text-gray-700 block mb-2">Catatan:</span>
                                <p class="text-sm text-gray-600">{{ $booking->notes }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('booking.detail', $booking->booking_code) }}" 
                           class="bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-blue-700 transition duration-300 text-center">
                            Lihat Detail Pembayaran
                        </a>
                        <a href="{{ route('booking.history') }}" 
                           class="bg-gray-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-gray-700 transition duration-300 text-center">
                            Lihat Riwayat Booking
                        </a>
                        <button onclick="cancelBooking()" 
                                class="border-2 border-red-600 text-red-600 px-6 py-3 rounded-xl font-semibold hover:bg-red-50 transition duration-300">
                            Batalkan Booking
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Instructions -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 mt-8">
            <div class="p-6">
                <h4 class="text-lg font-bold text-gray-900 mb-4">Instruksi Pembayaran</h4>
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-blue-600 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h5 class="font-medium text-blue-800">Penting!</h5>
                            <p class="text-sm text-blue-700 mt-1">
                                Silakan lakukan pembayaran sesuai metode yang dipilih dalam waktu 30 menit. 
                                Setelah pembayaran berhasil, booking Anda akan dikonfirmasi dan kamar akan direservasi untuk Anda.
                                Jika tidak melakukan pembayaran dalam waktu yang ditentukan, booking akan otomatis dibatalkan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
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
                window.location.href = '{{ route("pengguna.dashboard") }}';
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

// Countdown timer
function updateCountdown() {
    const expiresAt = new Date('{{ $booking->booking_expires_at->toISOString() }}');
    const now = new Date();
    const diff = expiresAt - now;
    
    if (diff <= 0) {
        document.getElementById('countdown').textContent = 'Expired';
        setTimeout(() => {
            window.location.reload();
        }, 2000);
        return;
    }
    
    const hours = Math.floor(diff / (1000 * 60 * 60));
    const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((diff % (1000 * 60)) / 1000);
    
    let timeString = '';
    if (hours > 0) {
        timeString = `${hours}h ${minutes}m ${seconds}s`;
    } else if (minutes > 0) {
        timeString = `${minutes}m ${seconds}s`;
    } else {
        timeString = `${seconds}s`;
    }
    
    document.getElementById('countdown').textContent = timeString;
}

// Update countdown every second
setInterval(updateCountdown, 1000);
updateCountdown();
</script>
@endsection