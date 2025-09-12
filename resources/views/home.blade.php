@extends('layouts.app')

@section('title', 'Kost Honest - Hunian Nyaman dan Terpercaya')

@section('content')
<!-- Hero Section -->
<section class="relative text-white min-h-screen flex items-center" style="background-image: url('{{ asset('images/hero-honest.jpeg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <!-- Content -->
            <div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6">
                    Hunian Kost 
                    <span class="text-red-500">Honest</span>
                </h1>
                <p class="text-xl md:text-2xl mb-8 text-gray-100">
                    Tempat tinggal yang nyaman, aman, dan terpercaya dengan fasilitas lengkap untuk kehidupan sehari-hari Anda.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('rooms.index') }}" class="bg-red-600 text-white px-8 py-3 rounded-lg font-bold text-lg hover:bg-red-700 transition duration-300 text-center">
                        Cari Kamar Sekarang
                    </a>
                    <a href="#gallery" class="border-2 border-white text-white px-8 py-3 rounded-lg font-bold text-lg hover:bg-white hover:text-red-600 transition duration-300 text-center">
                        Lihat Galeri
                    </a>
                </div>
            </div>
            
            <!-- Hero Image/Visual -->
            <div class="flex justify-center">
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 max-w-md">
                    <div class="text-center">
                        <div class="flex items-center justify-center mx-auto mb-4">
                            <img src="{{ asset('images/logo/logo.png') }}" alt="Kost Honest Logo" class="w-32 h-32 object-contain">
                        </div>
                        <h3 class="text-2xl font-bold mb-4">Kost Premium</h3>
                        <p class="text-gray-100">Dilengkapi fasilitas modern untuk kenyamanan maksimal</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section id="gallery" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Galeri Kost Honest</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Lihat suasana nyaman dan fasilitas lengkap yang tersedia di Kost Honest
            </p>
        </div>
        
        <!-- Gallery Carousel -->
        <div class="relative max-w-4xl mx-auto">
            <div class="carousel-container overflow-hidden rounded-xl shadow-2xl relative">
                <div class="carousel-track flex transition-transform duration-500 ease-in-out">
                    @forelse($galleries as $index => $gallery)
                    <!-- Slide {{ $index + 1 }} -->
                    <div class="carousel-slide min-w-full relative">
                        <img src="{{ $gallery->url }}" 
                             alt="{{ $gallery->judul }}" 
                             class="w-full h-96 object-cover"
                             onerror="this.src='{{ asset('images/placeholder.jpg') }}'; this.onerror=null;">
                        <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/70 to-transparent p-6">
                            <h3 class="text-white text-xl font-bold mb-2">{{ $gallery->judul }}</h3>
                            <p class="text-white/90 text-sm">{{ $gallery->deskripsi }}</p>
                        </div>
                    </div>
                    @empty
                    <!-- Default slide if no gallery data -->
                    <div class="carousel-slide min-w-full relative">
                        <div class="w-full h-96 bg-gradient-to-br from-red-100 to-red-200 flex items-center justify-center">
                            <div class="text-center">
                                <div class="text-6xl mb-4">🏠</div>
                                <h3 class="text-2xl font-bold text-red-800 mb-2">Galeri Kost Honest</h3>
                                <p class="text-red-700">Galeri sedang dalam proses update</p>
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
            
            <!-- Navigation Buttons -->
            <button class="carousel-prev absolute left-4 top-1/2 transform -translate-y-1/2 bg-red-600 text-white p-3 rounded-full hover:bg-red-700 transition duration-300 shadow-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <button class="carousel-next absolute right-4 top-1/2 transform -translate-y-1/2 bg-red-600 text-white p-3 rounded-full hover:bg-red-700 transition duration-300 shadow-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
            
            <!-- Dots Indicator -->
            <div class="flex justify-center mt-6 space-x-2">
                @if(count($galleries) > 0)
                    @foreach($galleries as $index => $gallery)
                    <button class="carousel-dot w-3 h-3 {{ $index === 0 ? 'bg-red-600' : 'bg-gray-300' }} rounded-full hover:bg-red-400 transition duration-300" data-slide="{{ $index }}"></button>
                    @endforeach
                @else
                    <button class="carousel-dot w-3 h-3 bg-red-600 rounded-full transition duration-300" data-slide="0"></button>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Type Kamar Section -->
<section id="type-kamar" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Pilihan Type Kamar</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Berbagai pilihan kamar yang disesuaikan dengan kebutuhan dan budget Anda
            </p>
        </div>
        
   <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
    @foreach($typeKamars as $index => $typeKamar)
    <div class="group bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 hover:scale-105 border border-gray-100 relative">
        
        <!-- Header dengan Icon dan Badge -->
        <div class="bg-gradient-to-r from-red-500 via-red-600 to-pink-600 p-6 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 transform rotate-45 translate-x-16 -translate-y-16 bg-white/10"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 transform -rotate-45 -translate-x-12 translate-y-12 bg-white/5"></div>
            
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-white/20 backdrop-blur-sm rounded-2xl p-3">
                        <div class="text-3xl">🏠</div>
                    </div>
                    <div class="bg-white/20 backdrop-blur-sm rounded-full px-3 py-1">
                        <span class="text-white font-bold text-xs uppercase tracking-wider">Type {{ $index + 1 }}</span>
                    </div>
                </div>
                
                <h3 class="text-2xl font-black text-white mb-1">{{ $typeKamar->nama }}</h3>
                <p class="text-red-100 font-medium">{{ $typeKamar->ukuran_kamar }} • {{ $typeKamar->type_kasur }}</p>
            </div>
        </div>
        
        <div class="p-6">
            <!-- Description -->
            <div class="mb-6">
                <p class="text-gray-600 leading-relaxed">{{ $typeKamar->deskripsi }}</p>
            </div>
            
            <!-- Room Specs -->
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div class="bg-blue-50 rounded-xl p-4 text-center">
                    <div class="bg-blue-100 rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-2">
                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 4a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1V8zm8 0a1 1 0 011-1h4a1 1 0 011 1v2a1 1 0 01-1 1h-4a1 1 0 01-1-1V8z"/>
                        </svg>
                    </div>
                    <div class="font-bold text-blue-900 text-sm">{{ $typeKamar->ukuran_kamar }}</div>
                    <div class="text-blue-600 text-xs">Ukuran</div>
                </div>
                
                <div class="bg-purple-50 rounded-xl p-4 text-center">
                    <div class="bg-purple-100 rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-2">
                        <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                        </svg>
                    </div>
                    <div class="font-bold text-purple-900 text-sm">{{ $typeKamar->type_kasur }}</div>
                    <div class="text-purple-600 text-xs">Kasur</div>
                </div>
            </div>
            
            <!-- Facilities -->
            <div class="mb-6">
                <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                    <div class="bg-green-100 rounded-full p-1 mr-2">
                        <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    Fasilitas Unggulan
                </h4>
                
                @php
                    $allFacilities = collect($typeKamar->fasilitas_kamar ?? [])
                        ->merge($typeKamar->fasilitas_kost ?? [])
                        ->take(4);
                @endphp
                
                <div class="grid grid-cols-2 gap-2 mb-3">
                    @foreach($allFacilities as $facility)
                    <div class="flex items-center text-sm bg-gray-50 rounded-lg p-2">
                        <div class="w-2 h-2 bg-green-400 rounded-full mr-2 flex-shrink-0"></div>
                        <span class="text-gray-700 font-medium truncate">{{ $facility }}</span>
                    </div>
                    @endforeach
                </div>
                
                @if(collect($typeKamar->fasilitas_kamar ?? [])->merge($typeKamar->fasilitas_kost ?? [])->count() > 4)
                <div class="text-center">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                        +{{ collect($typeKamar->fasilitas_kamar ?? [])->merge($typeKamar->fasilitas_kost ?? [])->count() - 4 }} fasilitas lainnya
                    </span>
                </div>
                @endif
            </div>
            
            <!-- Action Button -->
            <div class="space-y-3">
                @if(auth()->check())
                    <a href="{{ route('room.detail', strtolower($typeKamar->nama)) }}" 
                       class="group/btn block w-full bg-gradient-to-r from-red-600 to-red-700 text-white py-4 px-6 rounded-2xl font-bold text-center hover:from-red-700 hover:to-red-800 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                        <span class="flex items-center justify-center">
                            <span class="mr-2">Lihat Detail Kamar</span>
                            <svg class="w-5 h-5 group-hover/btn:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </span>
                    </a>
                @else
                    <a href="{{ route('login') }}" 
                       class="group/btn block w-full bg-gradient-to-r from-red-600 to-red-700 text-white py-4 px-6 rounded-2xl font-bold text-center hover:from-red-700 hover:to-red-800 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                        <span class="flex items-center justify-center">
                            <span class="mr-2">Login untuk Lihat Detail</span>
                            <svg class="w-5 h-5 group-hover/btn:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </span>
                    </a>
                @endif
                
                <div class="text-center">
                    <span class="text-xs text-gray-500 font-medium">
                        @if(auth()->check())
                            Klik untuk melihat detail lengkap dan booking
                        @else
                            Login terlebih dahulu untuk melihat detail dan booking
                        @endif
                    </span>
                </div>
            </div>
        </div>
        
        <!-- Decorative Corner Elements -->
        <div class="absolute top-0 left-0 w-0 h-0 border-l-[40px] border-l-transparent border-t-[40px] border-t-red-500 opacity-20"></div>
        <div class="absolute bottom-0 right-0 w-0 h-0 border-r-[40px] border-r-transparent border-b-[40px] border-b-red-500 opacity-10"></div>
    </div>
    @endforeach
</div>
        
        <!-- Room Listings Section -->
        <section id="list-kamar" class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">List Kamar Available</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Pilihan kamar yang siap untuk dihuni dengan berbagai fasilitas terbaik
                    </p>
                </div>
                
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    <!-- Room 1 - Standard 101 -->
                    <div class="group bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100">
                        <div class="relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=400&h=250&fit=crop&crop=center" 
                                 alt="Kamar 101" class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-700">
                            
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            
                            <div class="absolute top-4 left-4">
                                <div class="flex items-center bg-green-500 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg">
                                    <div class="w-2 h-2 bg-white rounded-full mr-2 animate-pulse"></div>
                                    Available
                                </div>
                            </div>
                            <div class="absolute top-4 right-4">
                                <span class="bg-blue-600 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg border-2 border-white">
                                    💎 Standard
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-1">Kamar 101</h3>
                                    <p class="text-gray-500 font-medium">Standard Room</p>
                                </div>
                                <div class="text-right">
                                    <div class="text-2xl font-black text-red-600 mb-1">Rp 800K</div>
                                    <div class="text-sm text-gray-500 font-medium">/bulan</div>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between bg-gray-50 rounded-xl p-3 mb-4">
                                <div class="flex items-center text-gray-700">
                                    <div class="bg-red-100 rounded-full p-2 mr-2">
                                        <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 4a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1V8zm8 0a1 1 0 011-1h4a1 1 0 011 1v2a1 1 0 01-1 1h-4a1 1 0 01-1-1V8z"/>
                                        </svg>
                                    </div>
                                    <span class="font-semibold text-sm">3x3m</span>
                                </div>
                                <div class="flex items-center text-gray-700">
                                    <div class="bg-blue-100 rounded-full p-2 mr-2">
                                        <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                                        </svg>
                                    </div>
                                    <span class="font-semibold text-sm">Single Bed</span>
                                </div>
                            </div>
                            
                            <div class="mb-5">
                                <div class="grid grid-cols-2 gap-2">
                                    <div class="flex items-center text-sm text-gray-600">
                                        <div class="w-2 h-2 bg-red-400 rounded-full mr-2"></div>
                                        <span>WiFi</span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-600">
                                        <div class="w-2 h-2 bg-red-400 rounded-full mr-2"></div>
                                        <span>Kamar Mandi Dalam</span>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <span class="text-red-600 text-sm font-semibold">+2 fasilitas lainnya</span>
                                </div>
                            </div>
                            
                            @if(auth()->check())
                                <a href="{{ route('room.detailed', 1) }}" 
                                   class="block w-full bg-red-600 text-white py-3 px-4 rounded-xl font-bold text-sm hover:bg-red-700 transition duration-300 text-center">
                                    Lihat Detail & Booking
                                </a>
                            @else
                                <a href="{{ route('login') }}" 
                                   class="block w-full bg-gray-600 text-white py-3 px-4 rounded-xl font-bold text-sm hover:bg-gray-700 transition duration-300 text-center">
                                    Login untuk Detail & Booking
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Room 2 - Standard 102 -->
                    <div class="group bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100">
                        <div class="relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=400&h=250&fit=crop&crop=center" 
                                 alt="Kamar 102" class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-700">
                            
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            
                            <div class="absolute top-4 left-4">
                                <div class="flex items-center bg-green-500 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg">
                                    <div class="w-2 h-2 bg-white rounded-full mr-2 animate-pulse"></div>
                                    Available
                                </div>
                            </div>
                            <div class="absolute top-4 right-4">
                                <span class="bg-blue-600 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg border-2 border-white">
                                    💎 Standard
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-1">Kamar 102</h3>
                                    <p class="text-gray-500 font-medium">Standard Room</p>
                                </div>
                                <div class="text-right">
                                    <div class="text-2xl font-black text-red-600 mb-1">Rp 800K</div>
                                    <div class="text-sm text-gray-500 font-medium">/bulan</div>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between bg-gray-50 rounded-xl p-3 mb-4">
                                <div class="flex items-center text-gray-700">
                                    <div class="bg-red-100 rounded-full p-2 mr-2">
                                        <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 4a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1V8zm8 0a1 1 0 011-1h4a1 1 0 011 1v2a1 1 0 01-1 1h-4a1 1 0 01-1-1V8z"/>
                                        </svg>
                                    </div>
                                    <span class="font-semibold text-sm">3x3m</span>
                                </div>
                                <div class="flex items-center text-gray-700">
                                    <div class="bg-blue-100 rounded-full p-2 mr-2">
                                        <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                                        </svg>
                                    </div>
                                    <span class="font-semibold text-sm">Single Bed</span>
                                </div>
                            </div>
                            
                            <div class="mb-5">
                                <div class="grid grid-cols-2 gap-2">
                                    <div class="flex items-center text-sm text-gray-600">
                                        <div class="w-2 h-2 bg-red-400 rounded-full mr-2"></div>
                                        <span>WiFi</span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-600">
                                        <div class="w-2 h-2 bg-red-400 rounded-full mr-2"></div>
                                        <span>Kamar Mandi Dalam</span>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <span class="text-red-600 text-sm font-semibold">+2 fasilitas lainnya</span>
                                </div>
                            </div>
                            
                            @if(auth()->check())
                                <a href="{{ route('room.detailed', 3) }}" 
                                   class="block w-full bg-red-600 text-white py-3 px-4 rounded-xl font-bold text-sm hover:bg-red-700 transition duration-300 text-center">
                                    Lihat Detail & Booking
                                </a>
                            @else
                                <a href="{{ route('login') }}" 
                                   class="block w-full bg-gray-600 text-white py-3 px-4 rounded-xl font-bold text-sm hover:bg-gray-700 transition duration-300 text-center">
                                    Login untuk Detail & Booking
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Room 3 - Deluxe 201 (Popular) -->
                    <div class="group bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 ring-2 ring-red-200 border-red-200 relative">
                        <!-- Popular Ribbon -->
                        <div class="absolute top-0 right-0 z-10">
                            <div class="bg-gradient-to-r from-red-500 via-red-600 to-pink-600 text-white px-4 py-2 rounded-bl-2xl shadow-xl">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    <span class="font-bold text-xs uppercase tracking-wider">Terpopuler</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=400&h=250&fit=crop&crop=center" 
                                 alt="Kamar 201" class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-700">
                            
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            
                            <div class="absolute top-4 left-4">
                                <div class="flex items-center bg-green-500 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg">
                                    <div class="w-2 h-2 bg-white rounded-full mr-2 animate-pulse"></div>
                                    Available
                                </div>
                            </div>
                            <div class="absolute bottom-4 right-4">
                                <span class="bg-purple-600 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg border-2 border-white">
                                    ⭐ Deluxe
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-1">Kamar 201</h3>
                                    <p class="text-gray-500 font-medium">Deluxe Room</p>
                                </div>
                                <div class="text-right">
                                    <div class="text-2xl font-black text-red-600 mb-1">Rp 1.2M</div>
                                    <div class="text-sm text-gray-500 font-medium">/bulan</div>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between bg-gray-50 rounded-xl p-3 mb-4">
                                <div class="flex items-center text-gray-700">
                                    <div class="bg-red-100 rounded-full p-2 mr-2">
                                        <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 4a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1V8zm8 0a1 1 0 011-1h4a1 1 0 011 1v2a1 1 0 01-1 1h-4a1 1 0 01-1-1V8z"/>
                                        </svg>
                                    </div>
                                    <span class="font-semibold text-sm">3x4m</span>
                                </div>
                                <div class="flex items-center text-gray-700">
                                    <div class="bg-blue-100 rounded-full p-2 mr-2">
                                        <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                                        </svg>
                                    </div>
                                    <span class="font-semibold text-sm">Queen Bed</span>
                                </div>
                            </div>
                            
                            <div class="mb-5">
                                <div class="grid grid-cols-2 gap-2">
                                    <div class="flex items-center text-sm text-gray-600">
                                        <div class="w-2 h-2 bg-red-400 rounded-full mr-2"></div>
                                        <span>AC</span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-600">
                                        <div class="w-2 h-2 bg-red-400 rounded-full mr-2"></div>
                                        <span>WiFi Premium</span>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <span class="text-red-600 text-sm font-semibold">+3 fasilitas lainnya</span>
                                </div>
                            </div>
                            
                            @if(auth()->check())
                                <a href="{{ route('room.detailed', 5) }}" 
                                   class="block w-full bg-red-600 text-white py-3 px-4 rounded-xl font-bold text-sm hover:bg-red-700 transition duration-300 text-center">
                                    Lihat Detail & Booking
                                </a>
                            @else
                                <a href="{{ route('login') }}" 
                                   class="block w-full bg-gray-600 text-white py-3 px-4 rounded-xl font-bold text-sm hover:bg-gray-700 transition duration-300 text-center">
                                    Login untuk Detail & Booking
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Room 4 - Deluxe 202 -->
                    <div class="group bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100">
                        <div class="relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=400&h=250&fit=crop&crop=center" 
                                 alt="Kamar 202" class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-700">
                            
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            
                            <div class="absolute top-4 left-4">
                                <div class="flex items-center bg-green-500 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg">
                                    <div class="w-2 h-2 bg-white rounded-full mr-2 animate-pulse"></div>
                                    Available
                                </div>
                            </div>
                            <div class="absolute top-4 right-4">
                                <span class="bg-purple-600 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg border-2 border-white">
                                    ⭐ Deluxe
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-1">Kamar 202</h3>
                                    <p class="text-gray-500 font-medium">Deluxe Room</p>
                                </div>
                                <div class="text-right">
                                    <div class="text-2xl font-black text-red-600 mb-1">Rp 1.2M</div>
                                    <div class="text-sm text-gray-500 font-medium">/bulan</div>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between bg-gray-50 rounded-xl p-3 mb-4">
                                <div class="flex items-center text-gray-700">
                                    <div class="bg-red-100 rounded-full p-2 mr-2">
                                        <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 4a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1V8zm8 0a1 1 0 011-1h4a1 1 0 011 1v2a1 1 0 01-1 1h-4a1 1 0 01-1-1V8z"/>
                                        </svg>
                                    </div>
                                    <span class="font-semibold text-sm">3x4m</span>
                                </div>
                                <div class="flex items-center text-gray-700">
                                    <div class="bg-blue-100 rounded-full p-2 mr-2">
                                        <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                                        </svg>
                                    </div>
                                    <span class="font-semibold text-sm">Queen Bed</span>
                                </div>
                            </div>
                            
                            <div class="mb-5">
                                <div class="grid grid-cols-2 gap-2">
                                    <div class="flex items-center text-sm text-gray-600">
                                        <div class="w-2 h-2 bg-red-400 rounded-full mr-2"></div>
                                        <span>AC</span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-600">
                                        <div class="w-2 h-2 bg-red-400 rounded-full mr-2"></div>
                                        <span>Smart TV</span>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <span class="text-red-600 text-sm font-semibold">+3 fasilitas lainnya</span>
                                </div>
                            </div>
                            
                            @if(auth()->check())
                                <a href="{{ route('room.detailed', 7) }}" 
                                   class="block w-full bg-red-600 text-white py-3 px-4 rounded-xl font-bold text-sm hover:bg-red-700 transition duration-300 text-center">
                                    Lihat Detail & Booking
                                </a>
                            @else
                                <a href="{{ route('login') }}" 
                                   class="block w-full bg-gray-600 text-white py-3 px-4 rounded-xl font-bold text-sm hover:bg-gray-700 transition duration-300 text-center">
                                    Login untuk Detail & Booking
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Room 5 - VIP 301 -->
                    <div class="group bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100">
                        <div class="relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1571508601891-ca5e7a713859?w=400&h=250&fit=crop&crop=center" 
                                 alt="Kamar 301" class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-700">
                            
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            
                            <div class="absolute top-4 left-4">
                                <div class="flex items-center bg-green-500 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg">
                                    <div class="w-2 h-2 bg-white rounded-full mr-2 animate-pulse"></div>
                                    Available
                                </div>
                            </div>
                            <div class="absolute top-4 right-4">
                                <span class="bg-gradient-to-r from-yellow-500 to-orange-500 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg border-2 border-white">
                                    👑 VIP
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-1">Kamar 301</h3>
                                    <p class="text-gray-500 font-medium">VIP Room</p>
                                </div>
                                <div class="text-right">
                                    <div class="text-2xl font-black text-red-600 mb-1">Rp 1.8M</div>
                                    <div class="text-sm text-gray-500 font-medium">/bulan</div>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between bg-gray-50 rounded-xl p-3 mb-4">
                                <div class="flex items-center text-gray-700">
                                    <div class="bg-red-100 rounded-full p-2 mr-2">
                                        <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 4a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1V8zm8 0a1 1 0 011-1h4a1 1 0 011 1v2a1 1 0 01-1 1h-4a1 1 0 01-1-1V8z"/>
                                        </svg>
                                    </div>
                                    <span class="font-semibold text-sm">4x5m</span>
                                </div>
                                <div class="flex items-center text-gray-700">
                                    <div class="bg-blue-100 rounded-full p-2 mr-2">
                                        <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                                        </svg>
                                    </div>
                                    <span class="font-semibold text-sm">King Bed</span>
                                </div>
                            </div>
                            
                            <div class="mb-5">
                                <div class="grid grid-cols-2 gap-2">
                                    <div class="flex items-center text-sm text-gray-600">
                                        <div class="w-2 h-2 bg-red-400 rounded-full mr-2"></div>
                                        <span>Mini Kitchen</span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-600">
                                        <div class="w-2 h-2 bg-red-400 rounded-full mr-2"></div>
                                        <span>AC Premium</span>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <span class="text-red-600 text-sm font-semibold">+4 fasilitas lainnya</span>
                                </div>
                            </div>
                            
                            @if(auth()->check())
                                <a href="{{ route('room.detailed', 9) }}" 
                                   class="block w-full bg-red-600 text-white py-3 px-4 rounded-xl font-bold text-sm hover:bg-red-700 transition duration-300 text-center">
                                    Lihat Detail & Booking
                                </a>
                            @else
                                <a href="{{ route('login') }}" 
                                   class="block w-full bg-gray-600 text-white py-3 px-4 rounded-xl font-bold text-sm hover:bg-gray-700 transition duration-300 text-center">
                                    Login untuk Detail & Booking
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Room 6 - VIP 302 -->
                    <div class="group bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100">
                        <div class="relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1571508601891-ca5e7a713859?w=400&h=250&fit=crop&crop=center" 
                                 alt="Kamar 302" class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-700">
                            
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            
                            <div class="absolute top-4 left-4">
                                <div class="flex items-center bg-green-500 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg">
                                    <div class="w-2 h-2 bg-white rounded-full mr-2 animate-pulse"></div>
                                    Available
                                </div>
                            </div>
                            <div class="absolute top-4 right-4">
                                <span class="bg-gradient-to-r from-yellow-500 to-orange-500 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg border-2 border-white">
                                    👑 VIP
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-1">Kamar 302</h3>
                                    <p class="text-gray-500 font-medium">VIP Room</p>
                                </div>
                                <div class="text-right">
                                    <div class="text-2xl font-black text-red-600 mb-1">Rp 1.8M</div>
                                    <div class="text-sm text-gray-500 font-medium">/bulan</div>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between bg-gray-50 rounded-xl p-3 mb-4">
                                <div class="flex items-center text-gray-700">
                                    <div class="bg-red-100 rounded-full p-2 mr-2">
                                        <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 4a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1V8zm8 0a1 1 0 011-1h4a1 1 0 011 1v2a1 1 0 01-1 1h-4a1 1 0 01-1-1V8z"/>
                                        </svg>
                                    </div>
                                    <span class="font-semibold text-sm">4x5m</span>
                                </div>
                                <div class="flex items-center text-gray-700">
                                    <div class="bg-blue-100 rounded-full p-2 mr-2">
                                        <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                                        </svg>
                                    </div>
                                    <span class="font-semibold text-sm">King Bed</span>
                                </div>
                            </div>
                            
                            <div class="mb-5">
                                <div class="grid grid-cols-2 gap-2">
                                    <div class="flex items-center text-sm text-gray-600">
                                        <div class="w-2 h-2 bg-red-400 rounded-full mr-2"></div>
                                        <span>Smart TV 50"</span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-600">
                                        <div class="w-2 h-2 bg-red-400 rounded-full mr-2"></div>
                                        <span>Kulkas Pribadi</span>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <span class="text-red-600 text-sm font-semibold">+4 fasilitas lainnya</span>
                                </div>
                            </div>
                            
                            @if(auth()->check())
                                <a href="{{ route('room.detailed', 11) }}" 
                                   class="block w-full bg-red-600 text-white py-3 px-4 rounded-xl font-bold text-sm hover:bg-red-700 transition duration-300 text-center">
                                    Lihat Detail & Booking
                                </a>
                            @else
                                <a href="{{ route('login') }}" 
                                   class="block w-full bg-gray-600 text-white py-3 px-4 rounded-xl font-bold text-sm hover:bg-gray-700 transition duration-300 text-center">
                                    Login untuk Detail & Booking
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Call to Action - Lihat Semua Kamar -->
                <div class="text-center mt-8 mb-6">
                    <a href="{{ route('rooms.index') }}" class="inline-flex items-center px-8 py-3 rounded-xl font-semibold text-lg transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105" style="background: linear-gradient(135deg, #dc2626, #b91c1c) !important; color: white !important;">
                        <span class="mr-3">Lihat Semua Kamar</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                    <p class="text-gray-600 mt-4 text-base">Filter berdasarkan type kamar dan status ketersediaan</p>
                </div>
            </div>
        </section>
        
    </div>
</section>



<!-- Fasilitas Section -->
<section id="fasilitas" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Fasilitas Unggulan</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Kami menyediakan berbagai fasilitas terbaik untuk memastikan kenyamanan dan kemudahan hidup Anda
            </p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Facility 1 -->
            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition duration-300">
                <div class="bg-red-100 rounded-full w-16 h-16 flex items-center justify-center text-3xl mb-6">
                    🔒
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Keamanan 24 Jam</h3>
                <p class="text-gray-600">
                    Sistem keamanan terdepan dengan CCTV, akses kartu, dan penjaga keamanan 24 jam untuk menjamin keselamatan penghuni.
                </p>
            </div>
            
            <!-- Facility 2 -->
            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition duration-300">
                <div class="bg-red-100 rounded-full w-16 h-16 flex items-center justify-center text-3xl mb-6">
                    🌐
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">WiFi Super Cepat</h3>
                <p class="text-gray-600">
                    Internet berkecepatan tinggi di seluruh area kost untuk mendukung aktivitas belajar, bekerja, dan hiburan Anda.
                </p>
            </div>
            
            <!-- Facility 3 -->
            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition duration-300">
                <div class="bg-red-100 rounded-full w-16 h-16 flex items-center justify-center text-3xl mb-6">
                    🍽️
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Dapur Bersama</h3>
                <p class="text-gray-600">
                    Dapur lengkap dengan peralatan memasak modern yang dapat digunakan bersama untuk memasak makanan favorit Anda.
                </p>
            </div>
            
            <!-- Facility 4 -->
            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition duration-300">
                <div class="bg-red-100 rounded-full w-16 h-16 flex items-center justify-center text-3xl mb-6">
                    🧺
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Laundry Service</h3>
                <p class="text-gray-600">
                    Layanan laundry profesional dengan mesin cuci dan pengering modern untuk kemudahan perawatan pakaian.
                </p>
            </div>
            
            <!-- Facility 5 -->
            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition duration-300">
                <div class="bg-red-100 rounded-full w-16 h-16 flex items-center justify-center text-3xl mb-6">
                    🚗
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Parkir Luas</h3>
                <p class="text-gray-600">
                    Area parkir yang luas dan aman untuk kendaraan motor dan mobil dengan sistem pengawasan CCTV.
                </p>
            </div>
            
            <!-- Facility 6 -->
            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition duration-300">
                <div class="bg-red-100 rounded-full w-16 h-16 flex items-center justify-center text-3xl mb-6">
                    ❄️
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">AC & Kamar Mandi</h3>
                <p class="text-gray-600">
                    Setiap kamar dilengkapi AC dan kamar mandi dalam dengan air panas untuk kenyamanan maksimal.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Tentang Section -->
<section id="tentang" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                    Mengapa Memilih <span class="text-red-600">Kost Honest?</span>
                </h2>
                <p class="text-lg text-gray-600 mb-6">
                    Kami berkomitmen untuk memberikan pengalaman hunian terbaik dengan standar kualitas tinggi dan pelayanan yang mengutamakan kepuasan penghuni.
                </p>
                
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold mr-4 mt-1">✓</div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Lokasi Strategis</h4>
                            <p class="text-gray-600">Dekat dengan pusat bisnis, kampus, dan fasilitas umum</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold mr-4 mt-1">✓</div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Harga Terjangkau</h4>
                            <p class="text-gray-600">Paket sewa bulanan dan tahunan dengan harga kompetitif</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold mr-4 mt-1">✓</div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Pengelolaan Profesional</h4>
                            <p class="text-gray-600">Tim manajemen berpengalaman dan responsif 24/7</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold mr-4 mt-1">✓</div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Komunitas Supportif</h4>
                            <p class="text-gray-600">Lingkungan yang ramah dengan berbagai kegiatan bersama</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-2xl p-8">
                <div class="text-center">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Statistik Kepuasan</h3>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <div class="text-4xl font-bold text-red-600 mb-2">98%</div>
                            <div class="text-sm text-gray-700">Tingkat Kepuasan</div>
                        </div>
                        <div>
                            <div class="text-4xl font-bold text-red-600 mb-2">150+</div>
                            <div class="text-sm text-gray-700">Penghuni Aktif</div>
                        </div>
                        <div>
                            <div class="text-4xl font-bold text-red-600 mb-2">5★</div>
                            <div class="text-sm text-gray-700">Rating Rata-rata</div>
                        </div>
                        <div>
                            <div class="text-4xl font-bold text-red-600 mb-2">3</div>
                            <div class="text-sm text-gray-700">Tahun Beroperasi</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Lokasi Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Lokasi Strategis</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Temukan kami di lokasi yang mudah diakses dan dekat dengan berbagai fasilitas umum
            </p>
        </div>
        
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-center mb-6">
                    <div class="bg-red-100 rounded-full p-3 mr-4">
                        <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Kost Honest</h3>
                        <p class="text-gray-600">WCQH+V9C, Pedalangan, Kec. Banyumanik, Kota Semarang, Jawa Tengah 50268</p>
                    </div>
                </div>

                <div class="mt-6 grid md:grid-cols-3 gap-4">
                    <div class="text-center p-4 bg-red-50 rounded-xl">
                        <div class="text-2xl mb-2">🏫</div>
                        <h4 class="font-semibold text-gray-900">Dekat Kampus</h4>
                        <p class="text-sm text-gray-600">5 menit ke UNDIP</p>
                    </div>
                    <div class="text-center p-4 bg-red-50 rounded-xl">
                        <div class="text-2xl mb-2">🛒</div>
                        <h4 class="font-semibold text-gray-900">Dekat Mall</h4>
                        <p class="text-sm text-gray-600">10 menit ke mal terdekat</p>
                    </div>
                    <div class="text-center p-4 bg-red-50 rounded-xl">
                        <div class="text-2xl mb-2">🚌</div>
                        <h4 class="font-semibold text-gray-900">Transportasi</h4>
                        <p class="text-sm text-gray-600">Akses mudah angkutan umum</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Kontak Section -->
<section id="kontak" class="py-16 bg-gray-900 text-white">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-10">
      <h2 class="text-3xl md:text-4xl font-bold mb-4">Hubungi Kami</h2>
      <p class="text-lg text-gray-300">
        Silakan hubungi kami melalui informasi berikut:
      </p>
    </div>

    <div class="space-y-6">
      <div class="flex items-center">
        <div class="bg-red-600 rounded-full w-12 h-12 flex items-center justify-center text-xl mr-4">
          📞
        </div>
        <div>
          <h4 class="font-semibold">Telepon</h4>
          <p class="text-gray-300">081325851480</p>
        </div>
      </div>

      <div class="flex items-center">
        <div class="bg-red-600 rounded-full w-12 h-12 flex items-center justify-center text-xl mr-4">
          📍
        </div>
        <div>
          <h4 class="font-semibold">Alamat</h4>
          <p class="text-gray-300">
            WCQH+V9C, Pedalangan, Kec. Banyumanik,<br>
            Kota Semarang, Jawa Tengah 50268
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection