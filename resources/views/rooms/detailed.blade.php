@extends('layouts.dashboard')

@section('title', $kamar->nama_kamar . ' - ' . $kamar->typeKamar->nama . ' - Kost Honest')

@section('content')
<div class="min-h-screen bg-gray-100">
    <!-- Header -->
    <header class="bg-white shadow-lg border-b border-gray-200">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex items-center space-x-4">
                <a href="{{ route('rooms.index') }}" class="flex items-center justify-center w-12 h-12 rounded-xl bg-gray-100 hover:bg-gray-200 transition-all duration-200 group">
                    <svg class="w-5 h-5 text-gray-600 group-hover:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-red-600">{{ $kamar->nama_kamar }}</h1>
                    <p class="text-gray-600 mt-1">{{ $kamar->typeKamar->nama }} - Detail dan Booking</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Room Detail Hero -->
    <section class="py-8 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid lg:grid-cols-2 gap-12 items-stretch">
            <!-- Room Images -->
            <div class="relative">
                @if($kamar->typeKamar->gambarTypeKamar && count($kamar->typeKamar->gambarTypeKamar) > 1)
                    <!-- Multiple Images - Carousel -->
                    <div class="room-carousel-container overflow-hidden rounded-2xl shadow-2xl h-full">
                        <div class="room-carousel-track flex transition-transform duration-500 ease-in-out h-full">
                            @foreach($kamar->typeKamar->gambarTypeKamar as $index => $gambar)
                            <div class="room-carousel-slide min-w-full h-full">
                                <img src="{{ $gambar->url }}" 
                                     alt="{{ $gambar->alt_text ?? 'Kamar ' . $kamar->nama_kamar . ' - Image ' . ($index + 1) }}" 
                                     class="w-full h-full object-cover">
                            </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Navigation Buttons -->
                    <button class="room-carousel-prev absolute left-4 top-1/2 transform -translate-y-1/2 bg-red-600 text-white p-3 rounded-full hover:bg-red-700 transition duration-300 shadow-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>
                    <button class="room-carousel-next absolute right-4 top-1/2 transform -translate-y-1/2 bg-red-600 text-white p-3 rounded-full hover:bg-red-700 transition duration-300 shadow-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                    
                    <!-- Dots Indicator -->
                    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
                        @foreach($kamar->typeKamar->gambarTypeKamar as $index => $gambar)
                        <button class="room-carousel-dot w-3 h-3 {{ $index === 0 ? 'bg-red-600' : 'bg-white/50 hover:bg-white' }} rounded-full transition duration-300" data-slide="{{ $index }}"></button>
                        @endforeach
                    </div>
                @else
                    <!-- Single Image -->
                    <div class="overflow-hidden rounded-2xl shadow-2xl h-full">
                        <img src="{{ $kamar->typeKamar->gambarTypeKamar->first()->url ?? 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7' }}" 
                             alt="{{ $kamar->typeKamar->gambarTypeKamar->first()->alt_text ?? 'Kamar ' . $kamar->nama_kamar }}" 
                             class="w-full h-full object-cover">
                    </div>
                @endif
            </div>

            <!-- Room Information -->
            <div class="lg:pl-8">
                <!-- Room Title & Price -->
                <div class="mb-8">
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">Kamar {{ $kamar->nama_kamar }}</h1>
                    <p class="text-xl text-gray-600 mb-4">{{ $kamar->typeKamar->nama }} - {{ ucfirst(strtolower($kamar->typeKamar->nama)) }}</p>
                    <div class="flex items-baseline mb-4">
                        <span class="text-4xl font-bold text-red-600">Rp {{ number_format($kamar->typeKamar->harga, 0, ',', '.') }}</span>
                        <span class="text-xl text-gray-500 ml-2">/bulan</span>
                    </div>
                    
                    <!-- Status Badge -->
                    <div class="mb-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                            @if($kamar->status_kamar === 'Tersedia') bg-green-100 text-green-800
                            @elseif($kamar->status_kamar === 'Booked') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800
                            @endif">
                            @if($kamar->status_kamar === 'Tersedia')
                                ✅ Tersedia
                            @elseif($kamar->status_kamar === 'Booked')
                                ⏳ Sudah Dibooking
                            @else
                                🏠 Sudah Dihuni
                            @endif
                        </span>
                    </div>
                    
                    <p class="text-lg text-gray-600 leading-relaxed">{{ $kamar->typeKamar->deskripsi ?? 'Kamar nyaman dengan fasilitas lengkap untuk kebutuhan sehari-hari Anda.' }}</p>
                </div>

                <!-- Room Specs -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Spesifikasi Kamar</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Ukuran Kamar</p>
                                <p class="font-semibold text-gray-900">{{ $kamar->typeKamar->ukuran_kamar }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Type Kasur</p>
                                <p class="font-semibold text-gray-900">{{ $kamar->typeKamar->type_kasur }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Booking Actions -->
                @if($kamar->status_kamar === 'Tersedia')
                    <div class="grid grid-cols-2 gap-4">
                        @auth
                            <button onclick="showCheckoutModal()" class="bg-red-600 text-white py-4 px-6 rounded-lg hover:bg-red-700 font-bold text-lg transition duration-300 shadow-lg">
                                Booking Sekarang
                            </button>
                        @else
                            <button onclick="showLoginAlert()" class="bg-red-600 text-white py-4 px-6 rounded-lg hover:bg-red-700 font-bold text-lg transition duration-300 shadow-lg">
                                Booking Sekarang
                            </button>
                        @endauth
                        <button onclick="window.open('https://wa.me/628123456789?text=' + encodeURIComponent('Halo! Saya ingin bertanya tentang Kamar {{ $kamar->nama_kamar }} ({{ $kamar->typeKamar->nama }})'), '_blank')" class="border-2 border-red-600 text-red-600 py-4 px-6 rounded-lg hover:bg-red-50 font-bold text-lg transition duration-300">
                            Hubungi Kami
                        </button>
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-gray-200 rounded-full mx-auto mb-4 flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM9 6c0-1.66 1.34-3 3-3s3 1.34 3 3v2H9V6z"/>
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-4">Kamar Tidak Tersedia</h4>
                        <p class="text-gray-600 mb-6 text-lg">
                            @if($kamar->status_kamar === 'Booked')
                                Kamar ini sudah dibooking. Silakan lihat kamar lain yang tersedia.
                            @else
                                Kamar ini sudah dihuni. Silakan lihat kamar lain yang tersedia.
                            @endif
                        </p>
                        <a href="{{ route('rooms.index', ['status' => 'available']) }}" class="bg-blue-600 text-white py-3 px-6 rounded-lg font-medium hover:bg-blue-700 transition duration-300 shadow-lg">
                            Lihat Kamar Available Lainnya
                        </a>
                    </div>
                @endif
            </div>
        </div>
        </div>
    </section>

    <!-- Room Facilities -->
    <section class="py-12 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Fasilitas Lengkap</h2>
            <p class="text-xl text-gray-600">Semua yang Anda butuhkan untuk kenyamanan tinggal</p>
        </div>

        <div class="grid lg:grid-cols-2 gap-12">
            <!-- Fasilitas Kost -->
            <div class="bg-gradient-to-br from-blue-50 to-white rounded-2xl p-8 shadow-lg">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mr-4">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900">Fasilitas Kost</h3>
                </div>
                <div class="space-y-3">
                    @foreach($kamar->typeKamar->fasilitas_kost ?? [] as $fasilitasKost)
                    <div class="flex items-center p-3 bg-white rounded-lg shadow-sm">
                        <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                            <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <span class="text-gray-800 font-medium">{{ $fasilitasKost }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Fasilitas Kamar -->
            <div class="bg-gradient-to-br from-red-50 to-white rounded-2xl p-8 shadow-lg">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center mr-4">
                        <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900">Fasilitas Kamar</h3>
                </div>
                <div class="space-y-3">
                    @foreach($kamar->typeKamar->fasilitas_kamar ?? [] as $fasilitasKamar)
                    <div class="flex items-center p-3 bg-white rounded-lg shadow-sm">
                        <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                            <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <span class="text-gray-800 font-medium">{{ $fasilitasKamar }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        </div>
    </section>

    <!-- Room Policies -->
    <section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-12">
            <!-- Policies -->
            <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Kebijakan Kamar</h3>
                <div class="space-y-4">
                    @foreach($kebijakan as $item)
                    <div class="flex items-start">
                        <div class="w-6 h-6 bg-red-100 rounded-full flex items-center justify-center mr-3 mt-0.5 flex-shrink-0">
                            <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-900 text-sm">{{ $item->deskripsi }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Contact Info -->
            <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Hubungi Kami</h3>
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Email</p>
                                <p class="text-gray-600">info@kosthonest.com</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">WhatsApp</p>
                                <p class="text-gray-600">+62 821 2345 6789</p>
                            </div>
                        </div>
                        
                        <div class="pt-4">
                            <a href="https://wa.me/628123456789" class="w-full bg-green-600 text-white py-3 px-4 rounded-lg hover:bg-green-700 font-medium transition duration-300 flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                </svg>
                                Chat WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
</div>

<!-- Custom Login Alert Modal -->
<div id="loginAlertModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-white bg-opacity-10 backdrop-blur-md">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md mx-4 overflow-hidden transform transition-all scale-95 opacity-0" id="loginAlertContent">
        <!-- Header -->
        <div class="bg-gradient-to-r from-red-500 to-red-600 px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white">Login Diperlukan</h3>
                </div>
                <button onclick="closeLoginAlert()" class="text-white hover:text-red-200 transition duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Content -->
        <div class="p-6">
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-red-100 rounded-full mx-auto mb-4 flex items-center justify-center">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <h4 class="text-xl font-bold text-gray-900 mb-2">Silakan Login Terlebih Dahulu</h4>
                <p class="text-gray-600 leading-relaxed">
                    Untuk melakukan booking kamar, Anda perlu login ke akun Anda terlebih dahulu. Jika belum memiliki akun, silakan daftar dulu ya!
                </p>
            </div>
            
            <!-- Actions -->
            <div class="space-y-3">
                <a href="{{ route('login') }}" class="w-full bg-red-600 text-white py-3 px-4 rounded-xl hover:bg-red-700 font-semibold transition duration-300 flex items-center justify-center shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    Login Sekarang
                </a>
                <button onclick="closeLoginAlert()" class="w-full border-2 border-gray-300 text-gray-700 py-3 px-4 rounded-xl hover:bg-gray-50 font-semibold transition duration-300">
                    Nanti Saja
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Checkout Modal - Complete Redesign -->
<div id="checkoutModal" class="fixed inset-0 z-50 hidden overflow-y-auto transition-all duration-300" style="background-color: rgba(0, 0, 0, 0.5); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);">
    <div class="min-h-screen px-2 sm:px-4 py-4 sm:py-8 flex items-center justify-center">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-4xl mx-auto overflow-hidden transform transition-all duration-300 ease-out scale-95 opacity-0 flex flex-col max-h-[90vh]" id="checkoutModalContent">
            
            <!-- Modern Header with Premium Design -->
            <div class="relative bg-gradient-to-br from-red-600 via-red-700 to-red-800 px-4 sm:px-8 py-6 sm:py-8 overflow-hidden">
                <!-- Animated Background Elements -->
                <div class="absolute inset-0 opacity-20">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white rounded-full -translate-y-16 translate-x-16 animate-pulse"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white rounded-full translate-y-12 -translate-x-12 animate-pulse"></div>
                    <div class="absolute top-1/2 left-1/2 w-16 h-16 bg-white rounded-full opacity-10 animate-bounce"></div>
                </div>
                
                <div class="relative z-10 flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-14 h-14 bg-white bg-opacity-90 rounded-2xl flex items-center justify-center backdrop-blur-sm border border-white border-opacity-50 p-2 shadow-lg">
                            <img src="{{ asset('images/logo/logo.png') }}" 
     alt="Kost Honest Logo" 
     class="w-10 h-10 object-contain"
     onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">

                            <div class="w-8 h-8 bg-red-600 rounded-lg items-center justify-center text-white font-bold text-xs hidden">
                                KH
                            </div>
                        </div>
                        <div>
                            <h2 class="text-2xl sm:text-3xl font-bold text-white tracking-tight">Checkout Booking</h2>
                            <p class="text-red-100 text-sm sm:text-base opacity-90 mt-1">Selesaikan pemesanan kamar Anda</p>
                        </div>
                    </div>
                    <button onclick="closeCheckoutModal()" class="w-12 h-12 bg-white bg-opacity-90 rounded-xl flex items-center justify-center text-red-600 hover:bg-white hover:text-red-700 transition-all duration-300 backdrop-blur-sm border border-white border-opacity-50 group shadow-lg">
                        <svg class="w-6 h-6 group-hover:rotate-90 transition-transform duration-300 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="grid lg:grid-cols-2 gap-0 flex-1 overflow-y-auto">
                
                <!-- Left Column - Booking Summary & Room Info -->
                <div class="p-4 sm:p-8 bg-gradient-to-br from-gray-50 to-white border-r border-gray-200">
                    <!-- Room Image & Info -->
                    <div class="mb-6">
                        <div class="relative rounded-2xl overflow-hidden shadow-lg mb-4">
                            <img src="{{ $kamar->typeKamar->gambarTypeKamar->first()->url ?? 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7' }}" 
                                 alt="{{ $kamar->nama_kamar }}" 
                                 class="w-full h-32 sm:h-48 object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-60"></div>
                            <div class="absolute bottom-4 left-4 right-4">
                                <h3 class="text-xl font-bold text-white">{{ $kamar->nama_kamar }}</h3>
                                <p class="text-white text-sm opacity-90">{{ $kamar->typeKamar->nama }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Details Card -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200">
                        <div class="flex items-center mb-5">
                            <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900">Ringkasan Booking</h4>
                        </div>

                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                <span class="text-gray-600 font-medium">Kamar</span>
                                <span class="font-bold text-gray-900 text-right">{{ $kamar->nama_kamar }}</span>
                            </div>
                            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                <span class="text-gray-600 font-medium">Tipe Kamar</span>
                                <span class="font-semibold text-gray-800">{{ $kamar->typeKamar->nama }}</span>
                            </div>
                            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                <span class="text-gray-600 font-medium">Harga/Bulan</span>
                                <span class="font-bold text-gray-900">Rp {{ number_format($kamar->typeKamar->harga, 0, ',', '.') }}</span>
                            </div>
                            
                            <!-- Countdown Timer -->
                            <div class="bg-red-50 rounded-xl p-4 border border-red-200">
                                <div class="flex justify-between items-center">
                                    <span class="text-red-700 font-medium flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                        </svg>
                                        Booking berakhir dalam
                                    </span>
                                    <div class="flex items-center">
                                        <div class="w-2 h-2 bg-red-500 rounded-full mr-2 animate-pulse"></div>
                                        <span class="font-bold text-red-600 text-lg" id="countdownTimer">30:00</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Price -->
                            <div class="bg-gradient-to-r from-red-600 to-red-700 rounded-xl p-4 text-white">
                                <div class="flex justify-between items-center">
                                    <span class="text-xl font-bold">Total Pembayaran</span>
                                    <span class="text-2xl font-black">Rp {{ number_format($kamar->typeKamar->harga, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Features Preview -->
                    <div class="mt-6 bg-blue-50 rounded-xl p-4 border border-blue-200">
                        <h5 class="font-bold text-blue-900 mb-3 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Yang Anda Dapatkan
                        </h5>
                        <div class="grid grid-cols-2 gap-2 text-sm">
                            <div class="flex items-center text-blue-800">
                                <div class="w-2 h-2 bg-blue-600 rounded-full mr-2"></div>
                                Fasilitas lengkap
                            </div>
                            <div class="flex items-center text-blue-800">
                                <div class="w-2 h-2 bg-blue-600 rounded-full mr-2"></div>
                                Keamanan 24 jam
                            </div>
                            <div class="flex items-center text-blue-800">
                                <div class="w-2 h-2 bg-blue-600 rounded-full mr-2"></div>
                                WiFi gratis
                            </div>
                            <div class="flex items-center text-blue-800">
                                <div class="w-2 h-2 bg-blue-600 rounded-full mr-2"></div>
                                Maintenance cepat
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Payment & Form -->
                <div class="p-4 sm:p-8 bg-white">
                    <!-- Payment Methods Section -->
                    <div class="mb-6">
                        <div class="flex items-center mb-6">
                            <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                </svg>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900">Pilih Metode Pembayaran</h4>
                        </div>

                        <div class="space-y-3">
                            <!-- Bank Transfer -->
                            <label class="group relative payment-method-option block">
                                <input type="radio" name="payment_method" value="transfer_bank" class="absolute opacity-0 peer">
                                <div class="p-4 border-2 border-gray-200 rounded-xl cursor-pointer transition-all duration-300 hover:border-blue-300 hover:bg-blue-50 peer-checked:border-blue-500 peer-checked:bg-blue-50 peer-checked:ring-2 peer-checked:ring-blue-200">
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 bg-gradient-to-br from-blue-100 to-blue-200 rounded-xl flex items-center justify-center mr-4 group-hover:from-blue-200 group-hover:to-blue-300 transition-all">
                                            <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M2 6a2 2 0 012-2h16a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V6zm2 0v2h16V6H4zm0 4v8h16v-8H4z"/>
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <p class="font-bold text-gray-900 mb-1">Transfer Bank</p>
                                            <p class="text-sm text-gray-500">BCA • Mandiri • BRI • BNI</p>
                                        </div>
                                        <div class="ml-4">
                                            <div class="w-5 h-5 border-2 border-gray-300 rounded-full relative transition-all duration-200">
                                                <div class="absolute inset-1 bg-red-600 rounded-full opacity-0 transform scale-0 transition-all duration-200"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </label>

                            <!-- E-Wallet -->
                            <label class="group relative payment-method-option block">
                                <input type="radio" name="payment_method" value="e_wallet" class="absolute opacity-0 peer">
                                <div class="p-4 border-2 border-gray-200 rounded-xl cursor-pointer transition-all duration-300 hover:border-green-300 hover:bg-green-50 peer-checked:border-green-500 peer-checked:bg-green-50 peer-checked:ring-2 peer-checked:ring-green-200">
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 bg-gradient-to-br from-green-100 to-green-200 rounded-xl flex items-center justify-center mr-4 group-hover:from-green-200 group-hover:to-green-300 transition-all">
                                            <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M21 18v1a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v13zm-2-1V5H5v12h14zM7 10h2v4H7v-4zm4-2h2v6h-2V8zm4 1h2v5h-2V9z"/>
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <p class="font-bold text-gray-900 mb-1">E-Wallet</p>
                                            <p class="text-sm text-gray-500">OVO • GoPay • DANA • ShopeePay</p>
                                        </div>
                                        <div class="ml-4">
                                            <div class="w-5 h-5 border-2 border-gray-300 rounded-full relative transition-all duration-200">
                                                <div class="absolute inset-1 bg-red-600 rounded-full opacity-0 transform scale-0 transition-all duration-200"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </label>

                            <!-- Virtual Account -->
                            <label class="group relative payment-method-option block">
                                <input type="radio" name="payment_method" value="virtual_account" class="absolute opacity-0 peer">
                                <div class="p-4 border-2 border-gray-200 rounded-xl cursor-pointer transition-all duration-300 hover:border-purple-300 hover:bg-purple-50 peer-checked:border-purple-500 peer-checked:bg-purple-50 peer-checked:ring-2 peer-checked:ring-purple-200">
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 bg-gradient-to-br from-purple-100 to-purple-200 rounded-xl flex items-center justify-center mr-4 group-hover:from-purple-200 group-hover:to-purple-300 transition-all">
                                            <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M4 4a2 2 0 00-2 2v12a2 2 0 002 2h16a2 2 0 002-2V6a2 2 0 00-2-2H4zm0 2h16v2H4V6zm0 4h16v8H4v-8zm2 2h4v4H6v-4zm6 0h4v2h-4v-2zm0 3h4v1h-4v-1z"/>
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <p class="font-bold text-gray-900 mb-1">Virtual Account</p>
                                            <p class="text-sm text-gray-500">VA BCA • VA Mandiri • VA BRI</p>
                                        </div>
                                        <div class="ml-4">
                                            <div class="w-5 h-5 border-2 border-gray-300 rounded-full relative transition-all duration-200">
                                                <div class="absolute inset-1 bg-red-600 rounded-full opacity-0 transform scale-0 transition-all duration-200"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </label>

                            <!-- Cash -->
                            <label class="group relative payment-method-option block">
                                <input type="radio" name="payment_method" value="cash" class="absolute opacity-0 peer">
                                <div class="p-4 border-2 border-gray-200 rounded-xl cursor-pointer transition-all duration-300 hover:border-yellow-300 hover:bg-yellow-50 peer-checked:border-yellow-500 peer-checked:bg-yellow-50 peer-checked:ring-2 peer-checked:ring-yellow-200">
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 bg-gradient-to-br from-yellow-100 to-yellow-200 rounded-xl flex items-center justify-center mr-4 group-hover:from-yellow-200 group-hover:to-yellow-300 transition-all">
                                            <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1.41 16.09V20h-2.67v-1.93c-1.71-.36-3.16-1.46-3.27-3.4h1.96c.1 1.05.82 1.87 2.65 1.87 1.96 0 2.4-.98 2.4-1.59 0-.83-.44-1.61-2.67-2.14-2.48-.6-4.18-1.62-4.18-3.67 0-1.72 1.39-2.84 3.11-3.21V4h2.67v1.95c1.86.45 2.79 1.86 2.85 3.39H14.3c-.05-1.11-.64-1.87-2.22-1.87-1.5 0-2.4.68-2.4 1.64 0 .84.65 1.39 2.67 1.91s4.18 1.39 4.18 3.91c-.01 1.83-1.38 2.83-3.12 3.16z"/>
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <p class="font-bold text-gray-900 mb-1">Bayar Cash</p>
                                            <p class="text-sm text-gray-500">Bayar langsung di tempat</p>
                                        </div>
                                        <div class="ml-4">
                                            <div class="w-5 h-5 border-2 border-gray-300 rounded-full relative transition-all duration-200">
                                                <div class="absolute inset-1 bg-red-600 rounded-full opacity-0 transform scale-0 transition-all duration-200"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Notes Section -->
                    <div class="mb-8">
                        <div class="flex items-center mb-4">
                            <div class="w-8 h-8 bg-gray-100 rounded-xl flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                </svg>
                            </div>
                            <label for="booking_notes" class="font-semibold text-gray-700">
                                Catatan Tambahan (Opsional)
                            </label>
                        </div>
                        <textarea id="booking_notes" rows="3" 
                                  class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-300 resize-none text-gray-700 placeholder-gray-400"
                                  placeholder="Tambahkan catatan atau permintaan khusus untuk kamar Anda..."></textarea>
                    </div>

                    <!-- Action Buttons -->
                    <div class="space-y-4">
                        <button onclick="processBooking()" id="processBookingBtn"
                                class="w-full px-8 py-4 bg-gradient-to-r from-red-600 via-red-700 to-red-800 text-white rounded-xl hover:from-red-700 hover:via-red-800 hover:to-red-900 font-bold text-lg transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed shadow-lg hover:shadow-xl transform hover:scale-[1.02] disabled:transform-none flex items-center justify-center"
                                disabled>
                            <svg class="w-6 h-6 mr-3 opacity-0" id="loadingSpinner" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a7.646 7.646 0 100 15.292V12"/>
                            </svg>
                            <svg class="w-6 h-6 mr-3" id="checkIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span id="buttonText">Konfirmasi & Proses Booking</span>
                        </button>
                        
                        <button onclick="closeCheckoutModal()" 
                                class="w-full px-8 py-4 border-2 border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 hover:border-gray-400 font-semibold text-lg transition-all duration-300">
                            Batal Booking
                        </button>
                    </div>

                    <!-- Security Notice -->
                    <div class="mt-6 bg-gray-50 rounded-xl p-4 border border-gray-200">
                        <div class="flex items-center text-gray-600 text-sm">
                            <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>
                                🔒 Data Anda aman dengan kami. Dengan melanjutkan, Anda menyetujui 
                                <a href="#" class="text-red-600 font-medium hover:underline">syarat dan ketentuan</a> kami.
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Enhanced Modal Styles for Better Responsiveness and Backdrop */
#checkoutModal {
    background: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

#checkoutModal.show {
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
}

#checkoutModalContent {
    max-height: 90vh;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Mobile optimizations */
@media (max-width: 640px) {
    #checkoutModalContent {
        max-width: 95vw;
        max-height: 95vh;
        margin: 2.5vh auto;
    }
    
    #checkoutModal .min-h-screen {
        padding: 0.5rem;
    }
    
    #checkoutModal .grid.lg\\:grid-cols-2 {
        display: block;
    }
    
    #checkoutModal .lg\\:grid-cols-2 > div {
        max-height: none !important;
    }
}

/* Tablet optimizations */
@media (min-width: 641px) and (max-width: 1024px) {
    #checkoutModalContent {
        max-width: 85vw;
        max-height: 90vh;
    }
}

/* Payment method hover effects */
.payment-method-option:hover {
    transform: translateY(-2px);
    transition: all 0.2s ease;
}

.payment-method-option input[type="radio"]:checked + div {
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

/* Enhanced Radio Button Styles */
.payment-method-option .w-5.h-5.border-2 {
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
}

.payment-method-option .w-5.h-5.border-2.border-red-600 {
    border-color: #dc2626;
    box-shadow: 0 0 0 2px rgba(220, 38, 38, 0.2);
}

.payment-method-option .bg-red-600.opacity-100.scale-100 {
    animation: radioCheckIn 0.2s cubic-bezier(0.4, 0, 0.2, 1);
}

@keyframes radioCheckIn {
    0% {
        opacity: 0;
        transform: scale(0);
    }
    50% {
        opacity: 1;
        transform: scale(1.2);
    }
    100% {
        opacity: 1;
        transform: scale(1);
    }
}

/* Smooth scrolling for modal content */
#checkoutModal .overflow-y-auto {
    scroll-behavior: smooth;
}

/* Enhanced backdrop blur support */
@supports (backdrop-filter: blur()) {
    #checkoutModal {
        backdrop-filter: blur(12px);
    }
}

@supports (-webkit-backdrop-filter: blur()) {
    #checkoutModal {
        -webkit-backdrop-filter: blur(12px);
    }
}

/* Loading spinner animation */
@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.animate-spin {
    animation: spin 1s linear infinite;
}
</style>

<script>
// Room detail carousel functionality
document.addEventListener('DOMContentLoaded', function() {
    const track = document.querySelector('.room-carousel-track');
    const slides = document.querySelectorAll('.room-carousel-slide');
    const nextButton = document.querySelector('.room-carousel-next');
    const prevButton = document.querySelector('.room-carousel-prev');
    const dots = document.querySelectorAll('.room-carousel-dot');
    
    if (!track) return;
    
    let currentSlide = 0;
    const totalSlides = slides.length;

    function updateCarousel() {
        const translateX = -currentSlide * 100;
        track.style.transform = `translateX(${translateX}%)`;
        
        // Update dots
        dots.forEach((dot, index) => {
            if (index === currentSlide) {
                dot.classList.remove('bg-gray-300');
                dot.classList.add('bg-red-600');
            } else {
                dot.classList.remove('bg-red-600');
                dot.classList.add('bg-gray-300');
            }
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        updateCarousel();
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        updateCarousel();
    }

    // Event listeners
    if (nextButton) nextButton.addEventListener('click', nextSlide);
    if (prevButton) prevButton.addEventListener('click', prevSlide);

    // Dot navigation
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            currentSlide = index;
            updateCarousel();
        });
    });
});

// Enhanced Checkout Modal Functions with better backdrop
function showCheckoutModal() {
    const modal = document.getElementById('checkoutModal');
    const content = document.getElementById('checkoutModalContent');
    
    // Prevent body scroll and add blur class to body content
    document.body.style.overflow = 'hidden';
    
    // Show modal immediately
    modal.classList.remove('hidden');
    modal.style.display = 'block';
    
    // Force reflow
    modal.offsetHeight;
    
    // Add show class for enhanced backdrop
    modal.classList.add('show');
    
    // Animate modal content in with smooth transition
    requestAnimationFrame(() => {
        content.classList.remove('scale-95', 'opacity-0');
        content.classList.add('scale-100', 'opacity-100');
    });
    
    // Add event listeners for better UX
    addModalEventListeners();
}

function closeCheckoutModal() {
    const modal = document.getElementById('checkoutModal');
    const content = document.getElementById('checkoutModalContent');
    
    // Remove show class
    modal.classList.remove('show');
    
    // Animate content out
    content.classList.remove('scale-100', 'opacity-100');
    content.classList.add('scale-95', 'opacity-0');
    
    // Hide modal after animation and restore body scroll
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
        
        // Remove event listeners
        removeModalEventListeners();
    }, 300);
}

function addModalEventListeners() {
    // Close on Escape key
    document.addEventListener('keydown', handleEscapeKey);
    
    // Close on backdrop click
    const modal = document.getElementById('checkoutModal');
    modal.addEventListener('click', handleBackdropClick);
}

function removeModalEventListeners() {
    document.removeEventListener('keydown', handleEscapeKey);
    
    const modal = document.getElementById('checkoutModal');
    modal.removeEventListener('click', handleBackdropClick);
}

function handleEscapeKey(e) {
    if (e.key === 'Escape') {
        closeCheckoutModal();
    }
}

function handleBackdropClick(e) {
    if (e.target === e.currentTarget) {
        closeCheckoutModal();
    }
}

// Enhanced Payment method selection with modern UX
document.addEventListener('DOMContentLoaded', function() {
    const paymentOptions = document.querySelectorAll('.payment-method-option');
    const processBtn = document.getElementById('processBookingBtn');
    
    // Countdown timer functionality
    let countdownMinutes = 30;
    let countdownSeconds = 0;
    const countdownElement = document.getElementById('countdownTimer');
    
    function updateCountdown() {
        if (countdownSeconds === 0) {
            if (countdownMinutes === 0) {
                clearInterval(countdownInterval);
                countdownElement.textContent = "Waktu Habis";
                countdownElement.classList.add('text-red-800', 'animate-pulse');
                return;
            }
            countdownMinutes--;
            countdownSeconds = 59;
        } else {
            countdownSeconds--;
        }
        
        const displayMinutes = countdownMinutes.toString().padStart(2, '0');
        const displaySeconds = countdownSeconds.toString().padStart(2, '0');
        countdownElement.textContent = `${displayMinutes}:${displaySeconds}`;
        
        // Change color when under 5 minutes
        if (countdownMinutes < 5) {
            countdownElement.classList.add('animate-pulse');
        }
    }
    
    const countdownInterval = setInterval(updateCountdown, 1000);
    
    // Initialize all radio buttons as unselected
    paymentOptions.forEach(option => {
        const radioCircle = option.querySelector('.w-5.h-5.border-2');
        const redDot = radioCircle ? radioCircle.querySelector('.bg-red-600') : null;
        if (radioCircle) {
            radioCircle.classList.add('border-gray-300');
            radioCircle.classList.remove('border-red-600');
        }
        if (redDot) {
            redDot.classList.add('opacity-0', 'scale-0');
            redDot.classList.remove('opacity-100', 'scale-100');
        }
    });

    // Enhanced payment option selection
    paymentOptions.forEach(option => {
        const radio = option.querySelector('input[type="radio"]');
        
        option.addEventListener('click', function(e) {
            if (e.target.tagName !== 'INPUT') {
                e.preventDefault();
            }
            
            // Remove selected state from all options
            paymentOptions.forEach(opt => {
                const optDiv = opt.querySelector('div[class*="border-2"]');
                optDiv.classList.remove('border-blue-500', 'bg-blue-50', 'ring-2', 'ring-blue-200');
                optDiv.classList.remove('border-green-500', 'bg-green-50', 'ring-2', 'ring-green-200');
                optDiv.classList.remove('border-purple-500', 'bg-purple-50', 'ring-2', 'ring-purple-200');
                optDiv.classList.remove('border-yellow-500', 'bg-yellow-50', 'ring-2', 'ring-yellow-200');
                optDiv.classList.add('border-gray-200');
                
                // Reset radio button appearance
                const radioCircle = opt.querySelector('.w-5.h-5.border-2');
                const redDot = radioCircle ? radioCircle.querySelector('.bg-red-600') : null;
                if (radioCircle) {
                    radioCircle.classList.remove('border-red-600');
                    radioCircle.classList.add('border-gray-300');
                }
                if (redDot) {
                    redDot.classList.add('opacity-0', 'scale-0');
                    redDot.classList.remove('opacity-100', 'scale-100');
                }
                
                const optRadio = opt.querySelector('input[type="radio"]');
                optRadio.checked = false;
            });
            
            // Add selected state to clicked option
            const optDiv = this.querySelector('div[class*="border-2"]');
            const value = radio.value;
            
            // Apply color based on payment method
            if (value === 'transfer_bank') {
                optDiv.classList.add('border-blue-500', 'bg-blue-50', 'ring-2', 'ring-blue-200');
            } else if (value === 'e_wallet') {
                optDiv.classList.add('border-green-500', 'bg-green-50', 'ring-2', 'ring-green-200');
            } else if (value === 'virtual_account') {
                optDiv.classList.add('border-purple-500', 'bg-purple-50', 'ring-2', 'ring-purple-200');
            } else if (value === 'cash') {
                optDiv.classList.add('border-yellow-500', 'bg-yellow-50', 'ring-2', 'ring-yellow-200');
            }
            
            optDiv.classList.remove('border-gray-200');
            
            // Activate radio button appearance
            const radioCircle = this.querySelector('.w-5.h-5.border-2');
            const redDot = radioCircle.querySelector('.bg-red-600');
            if (radioCircle) {
                radioCircle.classList.remove('border-gray-300');
                radioCircle.classList.add('border-red-600');
            }
            if (redDot) {
                redDot.classList.remove('opacity-0', 'scale-0');
                redDot.classList.add('opacity-100', 'scale-100');
            }
            
            // Check the radio button
            radio.checked = true;
            
            // Enable and update process button
            processBtn.disabled = false;
            processBtn.classList.add('hover:scale-[1.02]');
            processBtn.classList.remove('disabled:transform-none');
        });
    });
});

function processBooking() {
    const selectedPayment = document.querySelector('input[name="payment_method"]:checked');
    const notes = document.getElementById('booking_notes').value;
    
    if (!selectedPayment) {
        // Show modern alert
        showModernAlert('Pilih Metode Pembayaran', 'Silakan pilih salah satu metode pembayaran terlebih dahulu.', 'warning');
        return;
    }
    
    // Enhanced loading state with animations
    const processBtn = document.getElementById('processBookingBtn');
    const buttonText = document.getElementById('buttonText');
    const checkIcon = document.getElementById('checkIcon');
    const loadingSpinner = document.getElementById('loadingSpinner');
    
    // Show loading animation
    buttonText.textContent = 'Memproses Booking...';
    checkIcon.classList.add('opacity-0');
    loadingSpinner.classList.remove('opacity-0');
    loadingSpinner.classList.add('animate-spin');
    processBtn.disabled = true;
    processBtn.classList.add('cursor-not-allowed');
    processBtn.classList.remove('hover:scale-[1.02]');
    
    // Prepare booking data
    const bookingData = {
        kamar_id: {{ $kamar->id }},
        payment_method: selectedPayment.value,
        notes: notes,
        _token: '{{ csrf_token() }}'
    };
    
    // Send booking request with timeout
    const controller = new AbortController();
    const timeoutId = setTimeout(() => controller.abort(), 30000); // 30 second timeout
    
    fetch('/booking/create', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify(bookingData),
        signal: controller.signal
    })
    .then(response => {
        clearTimeout(timeoutId);
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Show success state
            buttonText.textContent = 'Booking Berhasil!';
            loadingSpinner.classList.add('opacity-0');
            loadingSpinner.classList.remove('animate-spin');
            checkIcon.classList.remove('opacity-0');
            processBtn.classList.remove('bg-gradient-to-r', 'from-red-600', 'via-red-700', 'to-red-800');
            processBtn.classList.add('bg-gradient-to-r', 'from-green-600', 'to-green-700');
            
            // Close modal and redirect after short delay
            setTimeout(() => {
                closeCheckoutModal();
                window.location.href = '/booking/success/' + data.booking_code;
            }, 1500);
        } else {
            throw new Error(data.message || 'Terjadi kesalahan saat memproses booking');
        }
    })
    .catch(error => {
        clearTimeout(timeoutId);
        console.error('Booking Error:', error);
        
        // Show error state
        buttonText.textContent = 'Booking Gagal - Coba Lagi';
        loadingSpinner.classList.add('opacity-0');
        loadingSpinner.classList.remove('animate-spin');
        checkIcon.classList.remove('opacity-0');
        processBtn.classList.remove('bg-gradient-to-r', 'from-red-600', 'via-red-700', 'to-red-800');
        processBtn.classList.add('bg-gradient-to-r', 'from-red-700', 'to-red-800');
        
        const errorMessage = error.name === 'AbortError' 
            ? 'Koneksi timeout. Silakan coba lagi.' 
            : error.message || 'Terjadi kesalahan saat memproses booking. Silakan coba lagi.';
            
        showModernAlert('Booking Gagal', errorMessage, 'error');
        
        // Reset button after 3 seconds
        setTimeout(() => {
            resetBookingButton();
        }, 3000);
    });
}

function resetBookingButton() {
    const processBtn = document.getElementById('processBookingBtn');
    const buttonText = document.getElementById('buttonText');
    const checkIcon = document.getElementById('checkIcon');
    const loadingSpinner = document.getElementById('loadingSpinner');
    
    buttonText.textContent = 'Konfirmasi & Proses Booking';
    checkIcon.classList.remove('opacity-0');
    loadingSpinner.classList.add('opacity-0');
    loadingSpinner.classList.remove('animate-spin');
    processBtn.disabled = false;
    processBtn.classList.remove('cursor-not-allowed', 'bg-gradient-to-r', 'from-red-700', 'to-red-800', 'from-green-600', 'to-green-700');
    processBtn.classList.add('bg-gradient-to-r', 'from-red-600', 'via-red-700', 'to-red-800', 'hover:scale-[1.02]');
}

function showModernAlert(title, message, type = 'info') {
    // Create modern alert overlay
    const alertOverlay = document.createElement('div');
    alertOverlay.className = 'fixed inset-0 z-[60] flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm';
    
    const iconColors = {
        'warning': 'text-yellow-600 bg-yellow-100',
        'error': 'text-red-600 bg-red-100',
        'info': 'text-blue-600 bg-blue-100',
        'success': 'text-green-600 bg-green-100'
    };
    
    const icons = {
        'warning': '⚠️',
        'error': '❌',
        'info': 'ℹ️',
        'success': '✅'
    };
    
    alertOverlay.innerHTML = `
        <div class="bg-white rounded-2xl shadow-2xl max-w-md mx-4 p-6 transform transition-all scale-95 opacity-0" id="modernAlert">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 rounded-full flex items-center justify-center mr-4 ${iconColors[type]}">
                    <span class="text-2xl">${icons[type]}</span>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">${title}</h3>
                </div>
            </div>
            <p class="text-gray-600 mb-6">${message}</p>
            <button onclick="closeModernAlert()" class="w-full bg-red-600 text-white py-3 rounded-xl font-semibold hover:bg-red-700 transition-colors">
                Tutup
            </button>
        </div>
    `;
    
    document.body.appendChild(alertOverlay);
    
    // Animate in
    setTimeout(() => {
        const alert = document.getElementById('modernAlert');
        alert.classList.remove('scale-95', 'opacity-0');
        alert.classList.add('scale-100', 'opacity-100');
    }, 50);
    
    // Auto close after 5 seconds
    setTimeout(() => {
        closeModernAlert();
    }, 5000);
}

function closeModernAlert() {
    const alertOverlay = document.querySelector('.fixed.inset-0.z-\\[60\\]');
    if (alertOverlay) {
        const alert = document.getElementById('modernAlert');
        alert.classList.add('scale-95', 'opacity-0');
        alert.classList.remove('scale-100', 'opacity-100');
        
        setTimeout(() => {
            document.body.removeChild(alertOverlay);
        }, 300);
    }
}

// Close checkout modal when clicking outside
document.getElementById('checkoutModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeCheckoutModal();
    }
});

// Close checkout modal with ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const modal = document.getElementById('checkoutModal');
        if (!modal.classList.contains('hidden')) {
            closeCheckoutModal();
        }
    }
});

// Custom Login Alert Functions
function showLoginAlert() {
    const modal = document.getElementById('loginAlertModal');
    const content = document.getElementById('loginAlertContent');
    
    // Show modal
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    // Animate in
    setTimeout(() => {
        content.classList.remove('scale-95', 'opacity-0');
        content.classList.add('scale-100', 'opacity-100');
    }, 50);
}

function closeLoginAlert() {
    const modal = document.getElementById('loginAlertModal');
    const content = document.getElementById('loginAlertContent');
    
    // Animate out
    content.classList.remove('scale-100', 'opacity-100');
    content.classList.add('scale-95', 'opacity-0');
    
    // Hide modal after animation
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }, 300);
}

// Close modal when clicking outside
document.getElementById('loginAlertModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeLoginAlert();
    }
});

// Close modal with ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const modal = document.getElementById('loginAlertModal');
        if (modal.classList.contains('flex')) {
            closeLoginAlert();
        }
    }
});
</script>
@endsection