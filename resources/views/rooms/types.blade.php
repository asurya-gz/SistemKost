@extends('layouts.dashboard')

@section('title', 'Type Kamar - Kost Honest')

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
                    <h1 class="text-3xl font-bold text-red-600">Type Kamar</h1>
                    <p class="text-gray-600 mt-1">Pilihan tipe kamar yang tersedia</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Room Types Grid -->
    <section class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(count($roomTypes) > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($roomTypes as $index => $roomType)
                    <div class="group bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 hover:scale-105 border border-gray-100 relative">
                        
                        <!-- Header dengan Icon dan Badge -->
                        <div class="bg-gradient-to-r from-red-500 via-red-600 to-pink-600 p-6 relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-32 h-32 transform rotate-45 translate-x-16 -translate-y-16 bg-white/10"></div>
                            
                            <div class="relative z-10">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="bg-white/20 backdrop-blur-sm rounded-full p-3">
                                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                                        </svg>
                                    </div>
                                    <div class="bg-white/20 backdrop-blur-sm rounded-full px-3 py-1">
                                        <span class="text-white font-bold text-xs uppercase tracking-wider">Type {{ $index + 1 }}</span>
                                    </div>
                                </div>
                                
                                <h3 class="text-2xl font-black text-white mb-1">{{ $roomType->nama }}</h3>
                                <p class="text-red-100 font-medium">{{ $roomType->ukuran_kamar }} • {{ $roomType->type_kasur }}</p>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <!-- Price -->
                            <div class="text-center mb-6">
                                <div class="text-3xl font-black text-gray-900 mb-1">
                                    Rp {{ number_format($roomType->harga/1000) }}K
                                </div>
                                <div class="text-sm text-gray-500 font-medium">/bulan</div>
                            </div>

                            <!-- Description -->
                            <div class="mb-6">
                                <p class="text-gray-600 leading-relaxed text-sm">{{ $roomType->deskripsi }}</p>
                            </div>
                            
                            <!-- Room Specs -->
                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <div class="bg-blue-50 rounded-xl p-4 text-center">
                                    <div class="bg-blue-100 rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-2">
                                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 4a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1V8zm8 0a1 1 0 011-1h4a1 1 0 011 1v2a1 1 0 01-1 1h-4a1 1 0 01-1-1V8z"/>
                                        </svg>
                                    </div>
                                    <div class="font-bold text-blue-900 text-sm">{{ $roomType->ukuran_kamar }}</div>
                                    <div class="text-blue-600 text-xs">Ukuran</div>
                                </div>
                                
                                <div class="bg-purple-50 rounded-xl p-4 text-center">
                                    <div class="bg-purple-100 rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-2">
                                        <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                                        </svg>
                                    </div>
                                    <div class="font-bold text-purple-900 text-sm">{{ $roomType->type_kasur }}</div>
                                    <div class="text-purple-600 text-xs">Kasur</div>
                                </div>
                            </div>
                            
                            <!-- Facilities -->
                            <div class="mb-6">
                                <h4 class="flex items-center text-sm font-bold text-gray-700 mb-3 uppercase tracking-wider">
                                    <div class="w-4 h-4 bg-red-500 rounded-full mr-2 flex items-center justify-center">
                                        <svg class="w-2 h-2 text-white" fill="currentColor" viewBox="0 0 8 8">
                                            <circle cx="4" cy="4" r="3"/>
                                        </svg>
                                    </div>
                                    Fasilitas Unggulan
                                </h4>
                                
                                @php
                                    $allFacilities = collect($roomType->fasilitas_kamar ?? [])
                                        ->merge($roomType->fasilitas_kost ?? [])
                                        ->take(4);
                                @endphp
                                
                                <div class="grid grid-cols-1 gap-2 mb-3">
                                    @foreach($allFacilities as $facility)
                                    <div class="flex items-center text-sm text-gray-600">
                                        <div class="w-2 h-2 bg-red-400 rounded-full mr-3"></div>
                                        <span class="text-gray-700 font-medium">{{ $facility }}</span>
                                    </div>
                                    @endforeach
                                </div>
                                
                                @if(collect($roomType->fasilitas_kamar ?? [])->merge($roomType->fasilitas_kost ?? [])->count() > 4)
                                <div class="text-center">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                        +{{ collect($roomType->fasilitas_kamar ?? [])->merge($roomType->fasilitas_kost ?? [])->count() - 4 }} fasilitas lainnya
                                    </span>
                                </div>
                                @endif
                            </div>
                            
                            <!-- Action Button -->
                            <div class="space-y-3">
                                <a href="{{ route('room.detail', strtolower($roomType->nama)) }}" 
                                   class="group/btn block w-full bg-gradient-to-r from-red-600 to-red-700 text-white py-3 px-6 rounded-2xl font-bold text-center hover:from-red-700 hover:to-red-800 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                                    <span class="flex items-center justify-center">
                                        <span class="mr-2">Lihat Detail Lengkap</span>
                                        <svg class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                        </svg>
                                    </span>
                                </a>
                                
                                <div class="text-center">
                                    <span class="text-xs text-gray-500 font-medium">Klik untuk melihat detail lengkap dan kamar tersedia</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Decorative Corner Elements -->
                        <div class="absolute top-0 left-0 w-0 h-0 border-l-[40px] border-l-transparent border-t-[40px] border-t-red-500 opacity-20"></div>
                        <div class="absolute bottom-0 right-0 w-0 h-0 border-r-[30px] border-r-transparent border-b-[30px] border-b-red-300 opacity-30"></div>
                    </div>
                    @endforeach
                </div>
            @else
                <!-- No Room Types Found -->
                <div class="text-center py-16">
                    <div class="text-6xl mb-4">🏠</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Belum Ada Type Kamar</h3>
                    <p class="text-gray-600 mb-8">Belum ada tipe kamar yang tersedia saat ini</p>
                </div>
            @endif
        </div>
    </section>
</div>
@endsection