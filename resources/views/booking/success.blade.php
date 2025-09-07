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
                            <div class="flex items-center justify-between p-4 
                                @if($booking->status === 'pending') bg-yellow-50 
                                @elseif($booking->status === 'confirmed') bg-blue-50 
                                @elseif($booking->status === 'need_revision') bg-orange-50
                                @elseif($booking->status === 'verified') bg-green-50
                                @elseif($booking->status === 'cancelled') bg-red-50 
                                @else bg-gray-50 @endif rounded-xl">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 
                                        @if($booking->status === 'pending') bg-yellow-400 animate-pulse
                                        @elseif($booking->status === 'confirmed') bg-blue-400 animate-pulse
                                        @elseif($booking->status === 'need_revision') bg-orange-400 animate-pulse
                                        @elseif($booking->status === 'verified') bg-green-400
                                        @elseif($booking->status === 'cancelled') bg-red-400
                                        @else bg-gray-400 @endif rounded-full mr-3"></div>
                                    <span class="font-medium 
                                        @if($booking->status === 'pending') text-yellow-800
                                        @elseif($booking->status === 'confirmed') text-blue-800
                                        @elseif($booking->status === 'need_revision') text-orange-800
                                        @elseif($booking->status === 'verified') text-green-800
                                        @elseif($booking->status === 'cancelled') text-red-800
                                        @else text-gray-800 @endif">
                                        @switch($booking->status)
                                            @case('pending')
                                                Menunggu Pembayaran
                                                @break
                                            @case('confirmed')
                                                Menunggu Verifikasi
                                                @break
                                            @case('need_revision')
                                                Butuh Revisi
                                                @break
                                            @case('verified')
                                                Terverifikasi
                                                @break
                                            @case('cancelled')
                                                Dibatalkan
                                                @break
                                            @case('expired')
                                                Expired
                                                @break
                                            @default
                                                {{ ucfirst($booking->status) }}
                                        @endswitch
                                    </span>
                                </div>
                            </div>

                            <!-- Time Remaining / Verification Info -->
                            @if($booking->status === 'pending')
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
                            @elseif($booking->status === 'confirmed')
                            <div class="bg-blue-50 p-4 rounded-xl">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-blue-800">Status:</span>
                                    <span class="text-lg font-bold text-blue-600">Menunggu Verifikasi Admin</span>
                                </div>
                                <p class="text-xs text-blue-600 mt-2">
                                    Bukti pembayaran dikonfirmasi pada {{ $booking->confirmed_at->format('d M Y H:i') }}
                                </p>
                                <p class="text-xs text-blue-600 mt-1">
                                    Admin akan memverifikasi pembayaran dalam 24 jam
                                </p>
                            </div>
                            @elseif($booking->status === 'need_revision')
                            <div class="bg-orange-50 p-4 rounded-xl">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-orange-800">Status:</span>
                                    <span class="text-lg font-bold text-orange-600">Butuh Revisi</span>
                                </div>
                                <p class="text-xs text-orange-600 mt-2">
                                    Pembayaran ditolak pada {{ $booking->rejected_at->format('d M Y H:i') }}
                                </p>
                                @if($booking->rejection_reason)
                                <p class="text-sm text-orange-700 mt-2 p-2 bg-orange-100 rounded">
                                    <strong>Alasan:</strong> {{ $booking->rejection_reason }}
                                </p>
                                @endif
                                <p class="text-xs text-orange-600 mt-2">
                                    Silakan upload ulang bukti pembayaran yang benar
                                </p>
                            </div>
                            @elseif($booking->status === 'verified')
                            <div class="bg-green-50 p-4 rounded-xl">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-green-800">Status:</span>
                                    <span class="text-lg font-bold text-green-600">Pembayaran Terverifikasi</span>
                                </div>
                                <p class="text-xs text-green-600 mt-2">
                                    Pembayaran diverifikasi pada {{ $booking->verified_at->format('d M Y H:i') }}
                                </p>
                                <p class="text-xs text-green-600 mt-1">
                                    Kamar telah dikonfirmasi dan siap ditempati
                                </p>
                            </div>
                            @endif

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
                        @if($booking->status === 'pending' || $booking->status === 'need_revision')
                        <button onclick="confirmPayment()" 
                                class="bg-green-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-green-700 transition duration-300 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            @if($booking->status === 'need_revision')
                                Upload Ulang Bukti
                            @else
                                Konfirmasi Pembayaran
                            @endif
                        </button>
                        @endif
                        <a href="{{ route('booking.detail', $booking->booking_code) }}" 
                           class="bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-blue-700 transition duration-300 text-center">
                            Lihat Detail Pembayaran
                        </a>
                        <a href="{{ route('booking.history') }}" 
                           class="bg-gray-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-gray-700 transition duration-300 text-center">
                            Lihat Riwayat Booking
                        </a>
                        @if($booking->status === 'pending')
                        <button onclick="cancelBooking()" 
                                class="border-2 border-red-600 text-red-600 px-6 py-3 rounded-xl font-semibold hover:bg-red-50 transition duration-300">
                            Batalkan Booking
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Instructions -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 mt-8">
            <div class="p-6">
                <h4 class="text-lg font-bold text-gray-900 mb-4">Instruksi Pembayaran</h4>
                
                @if($booking->payment_method === 'transfer_bank')
                <!-- Bank Transfer Instructions -->
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 mb-6">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M2 6a2 2 0 012-2h16a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V6zm2 0v2h16V6H4zm0 4v8h16v-8H4z"/>
                            </svg>
                        </div>
                        <div>
                            <h5 class="text-xl font-bold text-blue-800">Transfer ke Rekening</h5>
                            <p class="text-blue-600">Lakukan transfer sesuai nominal di bawah ini</p>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl p-6 border border-blue-200">
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="text-sm text-gray-600 font-medium">Bank</label>
                                <div class="flex items-center mt-2">
                                    <span class="text-2xl font-bold text-red-600 mr-2">BRI</span>
                                    <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs font-medium">Bank Rakyat Indonesia</span>
                                </div>
                            </div>
                            <div>
                                <label class="text-sm text-gray-600 font-medium">Nomor Rekening</label>
                                <div class="flex items-center justify-between mt-2 bg-gray-50 p-3 rounded-lg">
                                    <span class="text-xl font-mono font-bold text-gray-800">0083 0105 2138 500</span>
                                    <button onclick="copyAccountNumber()" class="text-blue-600 hover:text-blue-800 p-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M8 2a1 1 0 000 2h2a1 1 0 100-2H8z"/>
                                            <path d="M3 5a2 2 0 012-2 3 3 0 003 3h6a3 3 0 003-3 2 2 0 012 2v6h-4.586l1.293-1.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L14.586 13H19v3a2 2 0 01-2 2H5a2 2 0 01-2-2V5z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div>
                                <label class="text-sm text-gray-600 font-medium">Atas Nama</label>
                                <p class="mt-2 text-lg font-semibold text-gray-800">Tri Suci Wulandari</p>
                            </div>
                            <div>
                                <label class="text-sm text-gray-600 font-medium">Jumlah Transfer</label>
                                <p class="mt-2 text-2xl font-bold text-red-600">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                
                <div class="bg-orange-50 border border-orange-200 rounded-xl p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-orange-600 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h5 class="font-medium text-orange-800">Penting!</h5>
                            <p class="text-sm text-orange-700 mt-1">
                                @if($booking->payment_method === 'transfer_bank')
                                Transfer sesuai nominal EXACT. Setelah transfer, kirim bukti pembayaran via WhatsApp ke admin untuk konfirmasi. Booking akan expired dalam 30 menit jika tidak ada konfirmasi.
                                @else
                                Lakukan pembayaran dalam waktu 30 menit. Setelah pembayaran berhasil, booking akan dikonfirmasi dan kamar direservasi untuk Anda.
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Payment Confirmation Modal -->
<div id="paymentConfirmModal" class="fixed inset-0 z-50 hidden overflow-y-auto transition-all duration-300" style="background-color: rgba(0, 0, 0, 0.5); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);">
    <div class="min-h-screen px-4 py-8 flex items-center justify-center">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-auto overflow-hidden transform transition-all duration-300 ease-out scale-95 opacity-0" id="paymentConfirmContent">
            
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-white bg-opacity-20 rounded-xl flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white">Konfirmasi Pembayaran</h3>
                            <p class="text-green-100 text-sm">Upload bukti transfer Anda</p>
                        </div>
                    </div>
                    <button onclick="closePaymentConfirmModal()" class="w-10 h-10 bg-white bg-opacity-20 rounded-xl flex items-center justify-center text-white hover:bg-white hover:bg-opacity-30 transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Modal Content -->
            <form id="paymentConfirmForm" class="p-6" enctype="multipart/form-data">
                @csrf
                
                <!-- Transfer Proof Upload -->
                <div class="mb-6">
                    <label for="transfer_proof" class="block text-sm font-medium text-gray-700 mb-3">
                        Bukti Transfer <span class="text-red-500">*</span>
                    </label>
                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-green-400 transition-colors duration-300" id="uploadArea">
                        <input type="file" id="transfer_proof" name="transfer_proof" class="hidden" accept="image/*,.pdf" required>
                        <div id="uploadPlaceholder">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                            <p class="text-gray-600 mb-2">Klik untuk upload atau drag & drop</p>
                            <p class="text-xs text-gray-500">JPG, PNG, atau PDF (max 5MB)</p>
                        </div>
                        <div id="filePreview" class="hidden">
                            <div class="flex items-center justify-center">
                                <svg class="w-8 h-8 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                                <span id="fileName" class="text-gray-800 font-medium"></span>
                            </div>
                            <button type="button" onclick="removeFile()" class="mt-2 text-red-600 text-sm hover:text-red-800">
                                Hapus file
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Payment Notes -->
                <div class="mb-6">
                    <label for="payment_notes" class="block text-sm font-medium text-gray-700 mb-2">
                        Catatan Tambahan (Opsional)
                    </label>
                    <textarea id="payment_notes" name="payment_notes" rows="3" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-300 resize-none"
                              placeholder="Tambahkan catatan mengenai pembayaran (opsional)..."></textarea>
                </div>

                <!-- Payment Summary -->
                <div class="bg-gray-50 rounded-xl p-4 mb-6">
                    <h4 class="font-semibold text-gray-800 mb-3">Ringkasan Pembayaran</h4>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Booking Code:</span>
                            <span class="font-medium">{{ $booking->booking_code }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Jumlah Transfer:</span>
                            <span class="font-bold text-green-600">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Rekening Tujuan:</span>
                            <span class="font-medium">BRI - 0083 0105 2138 500</span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4">
                    <button type="button" onclick="closePaymentConfirmModal()" 
                            class="flex-1 px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition duration-300">
                        Batal
                    </button>
                    <button type="submit" id="submitPaymentBtn"
                            class="flex-1 px-6 py-3 bg-green-600 text-white rounded-xl font-semibold hover:bg-green-700 transition duration-300 disabled:opacity-50 disabled:cursor-not-allowed">
                        <span id="submitText">Konfirmasi Pembayaran</span>
                        <svg id="submitLoader" class="hidden animate-spin w-4 h-4 ml-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a7.646 7.646 0 100 15.292V12"/>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function copyAccountNumber() {
    const accountNumber = '008301052138500';
    navigator.clipboard.writeText(accountNumber).then(function() {
        // Show success message
        const button = event.target.closest('button');
        const originalContent = button.innerHTML;
        button.innerHTML = '<svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>';
        button.classList.add('text-green-600');
        
        setTimeout(() => {
            button.innerHTML = originalContent;
            button.classList.remove('text-green-600');
        }, 2000);
    }).catch(function(err) {
        alert('Gagal menyalin nomor rekening');
    });
}

function confirmPayment() {
    showPaymentConfirmModal();
}

function showPaymentConfirmModal() {
    const modal = document.getElementById('paymentConfirmModal');
    const content = document.getElementById('paymentConfirmContent');
    
    document.body.style.overflow = 'hidden';
    modal.classList.remove('hidden');
    
    requestAnimationFrame(() => {
        content.classList.remove('scale-95', 'opacity-0');
        content.classList.add('scale-100', 'opacity-100');
    });
}

function closePaymentConfirmModal() {
    const modal = document.getElementById('paymentConfirmModal');
    const content = document.getElementById('paymentConfirmContent');
    
    content.classList.remove('scale-100', 'opacity-100');
    content.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
        
        // Reset form
        document.getElementById('paymentConfirmForm').reset();
        document.getElementById('filePreview').classList.add('hidden');
        document.getElementById('uploadPlaceholder').classList.remove('hidden');
    }, 300);
}

// File upload handling
document.addEventListener('DOMContentLoaded', function() {
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('transfer_proof');
    const uploadPlaceholder = document.getElementById('uploadPlaceholder');
    const filePreview = document.getElementById('filePreview');
    const fileName = document.getElementById('fileName');

    // Click to upload
    uploadArea.addEventListener('click', () => {
        fileInput.click();
    });

    // Drag and drop
    uploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadArea.classList.add('border-green-400', 'bg-green-50');
    });

    uploadArea.addEventListener('dragleave', () => {
        uploadArea.classList.remove('border-green-400', 'bg-green-50');
    });

    uploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadArea.classList.remove('border-green-400', 'bg-green-50');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            handleFile(files[0]);
        }
    });

    // File input change
    fileInput.addEventListener('change', (e) => {
        if (e.target.files.length > 0) {
            handleFile(e.target.files[0]);
        }
    });

    function handleFile(file) {
        // Validate file
        const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];
        const maxSize = 5 * 1024 * 1024; // 5MB

        if (!validTypes.includes(file.type)) {
            alert('File harus berupa JPG, PNG, atau PDF');
            return;
        }

        if (file.size > maxSize) {
            alert('Ukuran file maksimal 5MB');
            return;
        }

        // Show preview
        fileName.textContent = file.name;
        uploadPlaceholder.classList.add('hidden');
        filePreview.classList.remove('hidden');
        uploadArea.classList.add('border-green-400');

        // Set file to input
        const dt = new DataTransfer();
        dt.items.add(file);
        fileInput.files = dt.files;
    }
});

function removeFile() {
    document.getElementById('transfer_proof').value = '';
    document.getElementById('filePreview').classList.add('hidden');
    document.getElementById('uploadPlaceholder').classList.remove('hidden');
    document.getElementById('uploadArea').classList.remove('border-green-400');
}

// Form submission
document.getElementById('paymentConfirmForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const submitBtn = document.getElementById('submitPaymentBtn');
    const submitText = document.getElementById('submitText');
    const submitLoader = document.getElementById('submitLoader');
    
    // Show loading state
    submitBtn.disabled = true;
    submitText.textContent = 'Mengirim...';
    submitLoader.classList.remove('hidden');
    
    const formData = new FormData(this);
    
    fetch('/booking/confirm/{{ $booking->booking_code }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            submitText.textContent = 'Berhasil!';
            submitLoader.classList.add('hidden');
            
            setTimeout(() => {
                closePaymentConfirmModal();
                alert('Pembayaran berhasil dikonfirmasi! Admin akan memverifikasi dalam 24 jam.');
                window.location.reload();
            }, 1500);
        } else {
            throw new Error(data.message || 'Terjadi kesalahan');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert(error.message || 'Terjadi kesalahan saat konfirmasi pembayaran');
        
        // Reset button
        submitBtn.disabled = false;
        submitText.textContent = 'Konfirmasi Pembayaran';
        submitLoader.classList.add('hidden');
    });
});

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