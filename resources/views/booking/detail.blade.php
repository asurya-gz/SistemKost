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
                <div class="bg-blue-50 border-l-4 border-blue-400 p-6 mb-8 rounded-r-xl shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-xl font-bold text-blue-800">Menunggu Verifikasi</h3>
                            <p class="text-blue-700 mt-1">Bukti pembayaran telah diterima dan sedang diverifikasi admin</p>
                            @if($booking->confirmed_at)
                            <p class="text-sm text-blue-600 mt-2 font-medium">
                                Dikonfirmasi: {{ $booking->confirmed_at->format('d M Y H:i') }}
                            </p>
                            @endif
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
            @case('need_revision')
                <div class="bg-orange-50 border-l-4 border-orange-400 p-6 mb-8 rounded-r-xl shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center">
                                <svg class="h-8 w-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-xl font-bold text-orange-800">Butuh Revisi</h3>
                            <p class="text-orange-700 mt-1">Bukti pembayaran ditolak dan perlu direvisi</p>
                            @if($booking->rejected_at)
                            <p class="text-sm text-orange-600 mt-2 font-medium">
                                Ditolak: {{ $booking->rejected_at->format('d M Y H:i') }}
                            </p>
                            @endif
                            @if($booking->rejection_reason)
                            <div class="mt-3 p-3 bg-orange-100 rounded-lg">
                                <p class="text-sm text-orange-800"><strong>Alasan penolakan:</strong></p>
                                <p class="text-sm text-orange-700 mt-1">{{ $booking->rejection_reason }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @break
            @case('verified')
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
                            <h3 class="text-xl font-bold text-green-800">Pembayaran Terverifikasi</h3>
                            <p class="text-green-700 mt-1">Pembayaran telah diverifikasi admin dan kamar siap ditempati</p>
                            @if($booking->verified_at)
                            <p class="text-sm text-green-600 mt-2 font-medium">
                                Diverifikasi: {{ $booking->verified_at->format('d M Y H:i') }}
                            </p>
                            @endif
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
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                                    <div class="w-2 h-2 bg-blue-400 rounded-full mr-2 animate-pulse"></div>
                                                    Menunggu Verifikasi
                                                </span>
                                                @break
                                            @case('cancelled')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                                    <div class="w-2 h-2 bg-red-400 rounded-full mr-2"></div>
                                                    Dibatalkan
                                                </span>
                                                @break
                                            @case('need_revision')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-orange-100 text-orange-800">
                                                    <div class="w-2 h-2 bg-orange-400 rounded-full mr-2 animate-pulse"></div>
                                                    Butuh Revisi
                                                </span>
                                                @break
                                            @case('verified')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                                    <div class="w-2 h-2 bg-green-400 rounded-full mr-2"></div>
                                                    Terverifikasi
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
                        
                        <!-- Button untuk status butuh revisi -->
                        @if($booking->status == 'need_revision')
                        <button onclick="confirmBooking()" 
                                style="background-color: #ea580c !important; color: white !important; padding: 12px 24px !important; border-radius: 12px !important; font-weight: 600 !important; border: none !important; cursor: pointer !important; display: inline-block !important;">
                            Upload Bukti Pembayaran Baru
                        </button>
                        @endif
                        
                        <!-- Button untuk status pending -->  
                        @if($booking->status == 'pending' && !$booking->is_expired)
                        <button onclick="confirmBooking()" class="bg-green-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-green-700 transition duration-300">
                            Konfirmasi Pembayaran
                        </button>
                        <button onclick="cancelBooking()" class="border-2 border-red-600 text-red-600 px-6 py-3 rounded-xl font-semibold hover:bg-red-50 transition duration-300">
                            Batalkan Booking
                        </button>
                        @endif
                        
                        <!-- Button navigasi selalu tampil -->
                        <a href="{{ route('booking.history') }}" class="bg-gray-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-gray-700 transition duration-300 text-center">
                            Kembali ke Riwayat
                        </a>
                        
                        <a href="{{ route('rooms.index') }}" class="bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-blue-700 transition duration-300 text-center">
                            Lihat Kamar Lain
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Payment Confirmation Modal -->
@if($booking->status === 'pending' || $booking->status === 'need_revision')
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
                            <h3 class="text-xl font-bold text-white">
                                @if($booking->status === 'need_revision')
                                    Upload Bukti Transfer Baru
                                @else
                                    Konfirmasi Pembayaran
                                @endif
                            </h3>
                            <p class="text-green-100 text-sm">
                                @if($booking->status === 'need_revision')
                                    Perbaiki bukti transfer Anda
                                @else
                                    Upload bukti transfer Anda
                                @endif
                            </p>
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
                
                @if($booking->status === 'need_revision' && $booking->rejection_reason)
                <!-- Rejection Reason Alert -->
                <div class="bg-orange-50 border border-orange-200 rounded-xl p-4 mb-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-orange-600 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h5 class="font-medium text-orange-800">Alasan Penolakan:</h5>
                            <p class="text-sm text-orange-700 mt-1">{{ $booking->rejection_reason }}</p>
                        </div>
                    </div>
                </div>
                @endif
                
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
                        <span id="submitText">
                            @if($booking->status === 'need_revision')
                                Upload Bukti Baru
                            @else
                                Konfirmasi Pembayaran
                            @endif
                        </span>
                        <svg id="submitLoader" class="hidden animate-spin w-4 h-4 ml-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a7.646 7.646 0 100 15.292V12"/>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

<script>
function confirmBooking() {
    // Open the payment confirmation modal
    openPaymentConfirmModal();
}

function openPaymentConfirmModal() {
    const modal = document.getElementById('paymentConfirmModal');
    const content = document.getElementById('paymentConfirmContent');
    
    modal.classList.remove('hidden');
    setTimeout(() => {
        content.classList.remove('scale-95', 'opacity-0');
        content.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closePaymentConfirmModal() {
    const modal = document.getElementById('paymentConfirmModal');
    const content = document.getElementById('paymentConfirmContent');
    
    content.classList.remove('scale-100', 'opacity-100');
    content.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
        // Reset form
        document.getElementById('paymentConfirmForm').reset();
        resetFileUpload();
    }, 300);
}

// File upload handling
document.addEventListener('DOMContentLoaded', function() {
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('transfer_proof');
    const uploadPlaceholder = document.getElementById('uploadPlaceholder');
    const filePreview = document.getElementById('filePreview');
    const fileName = document.getElementById('fileName');

    if (uploadArea && fileInput) {
        // Click to upload
        uploadArea.addEventListener('click', () => {
            fileInput.click();
        });

        // Drag and drop
        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.classList.add('border-green-400', 'bg-green-50');
        });

        uploadArea.addEventListener('dragleave', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('border-green-400', 'bg-green-50');
        });

        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('border-green-400', 'bg-green-50');
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                handleFileSelect(files[0]);
            }
        });

        // File input change
        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                handleFileSelect(e.target.files[0]);
            }
        });
    }

    // Form submission
    const form = document.getElementById('paymentConfirmForm');
    if (form) {
        form.addEventListener('submit', handleFormSubmit);
    }
});

function handleFileSelect(file) {
    const maxSize = 5 * 1024 * 1024; // 5MB
    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];
    
    if (file.size > maxSize) {
        alert('File terlalu besar. Maksimal 5MB.');
        return;
    }
    
    if (!allowedTypes.includes(file.type)) {
        alert('Format file tidak didukung. Gunakan JPG, PNG, atau PDF.');
        return;
    }
    
    // Update UI
    const uploadPlaceholder = document.getElementById('uploadPlaceholder');
    const filePreview = document.getElementById('filePreview');
    const fileName = document.getElementById('fileName');
    
    uploadPlaceholder.classList.add('hidden');
    filePreview.classList.remove('hidden');
    fileName.textContent = file.name;
}

function removeFile() {
    resetFileUpload();
    document.getElementById('transfer_proof').value = '';
}

function resetFileUpload() {
    const uploadPlaceholder = document.getElementById('uploadPlaceholder');
    const filePreview = document.getElementById('filePreview');
    
    if (uploadPlaceholder && filePreview) {
        uploadPlaceholder.classList.remove('hidden');
        filePreview.classList.add('hidden');
    }
}

function handleFormSubmit(e) {
    e.preventDefault();
    
    const submitBtn = document.getElementById('submitPaymentBtn');
    const submitText = document.getElementById('submitText');
    const submitLoader = document.getElementById('submitLoader');
    const form = document.getElementById('paymentConfirmForm');
    
    // Disable submit button
    submitBtn.disabled = true;
    submitText.classList.add('hidden');
    submitLoader.classList.remove('hidden');
    
    // Create FormData
    const formData = new FormData(form);
    
    // Submit form
    fetch('/booking/confirm/{{ $booking->booking_code }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message || 'Pembayaran berhasil dikonfirmasi!');
            closePaymentConfirmModal();
            window.location.reload();
        } else {
            alert(data.message || 'Terjadi kesalahan');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat mengkonfirmasi pembayaran');
    })
    .finally(() => {
        // Re-enable submit button
        submitBtn.disabled = false;
        submitText.classList.remove('hidden');
        submitLoader.classList.add('hidden');
    });
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