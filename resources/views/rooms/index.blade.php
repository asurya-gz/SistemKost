@extends('layouts.dashboard')

@section('title', 'Daftar Kamar - Kost Honest')

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
                    <h1 class="text-3xl font-bold text-red-600">Daftar Kamar</h1>
                    <p class="text-gray-600 mt-1">Pilih kamar sesuai kebutuhan Anda</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Filter Section -->
    <section class="bg-white py-3 shadow-lg border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="space-y-4">
            <!-- Filter Row -->
            <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                <!-- Filter Label -->
                <div class="text-sm font-semibold text-gray-700">
                    Filter :
                </div>
                
                <!-- Filter Dropdowns -->
                <div class="flex gap-3">
                    <!-- Room Type Dropdown -->
                    <select onchange="filterRooms('type', this.value)" 
                            class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent cursor-pointer">
                        <option value="all" {{ $selectedType === 'all' ? 'selected' : '' }}>🏠 All Types</option>
                        @foreach($roomTypes as $typeKamar)
                        <option value="{{ $typeKamar->nama }}" {{ $selectedType === $typeKamar->nama ? 'selected' : '' }}>
                            {{ $typeKamar->nama }}
                        </option>
                        @endforeach
                    </select>
                    
                    <!-- Status Dropdown -->
                    <select onchange="filterRooms('status', this.value)" 
                            class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent cursor-pointer">
                        <option value="all" {{ $selectedStatus === 'all' ? 'selected' : '' }}>📋 All Status</option>
                        @foreach($roomStatuses as $status)
                        <option value="{{ $status }}" {{ $selectedStatus === $status ? 'selected' : '' }}>
                            @if($status === 'Tersedia') ✅ Tersedia
                            @elseif($status === 'Booked') 📝 Booked
                            @else 🔒 Dihuni
                            @endif
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <!-- Search Row -->
            <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                <!-- Search Label -->
                <div class="text-sm font-semibold text-gray-700">
                    Search :
                </div>
                
                <!-- Search Input -->
                <div class="w-40">
                    <input type="text" 
                           id="searchInput"
                           placeholder="Cari..."
                           class="w-full px-3 py-2 border-2 border-red-400 rounded-lg text-sm font-medium focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-600 placeholder-gray-500 bg-white shadow-sm transition-all duration-200 hover:border-red-500"
                           oninput="searchRooms(this.value)">
                </div>
            </div>
        </div>
        </div>
    </section>

    <script>
function filterRooms(filterType, value) {
    const urlParams = new URLSearchParams(window.location.search);
    
    if (filterType === 'type') {
        if (value === 'all') {
            urlParams.delete('type');
        } else {
            urlParams.set('type', value);
        }
    } else if (filterType === 'status') {
        if (value === 'all') {
            urlParams.delete('status');
        } else {
            urlParams.set('status', value);
        }
    }
    
    // Redirect to new URL
    window.location.href = '{{ route("rooms.index") }}' + (urlParams.toString() ? '?' + urlParams.toString() : '');
}

function searchRooms(searchTerm) {
    const rooms = document.querySelectorAll('.room-card');
    const searchLower = searchTerm.toLowerCase();
    
    rooms.forEach(room => {
        const roomNumber = room.querySelector('.room-number').textContent.toLowerCase();
        const roomType = room.querySelector('.room-type').textContent.toLowerCase();
        const facilities = room.querySelector('.facilities').textContent.toLowerCase();
        
        const isMatch = roomNumber.includes(searchLower) || 
                       roomType.includes(searchLower) || 
                       facilities.includes(searchLower);
        
        if (isMatch) {
            room.style.display = 'block';
        } else {
            room.style.display = 'none';
        }
    });
    
    // Update results count
    const visibleRooms = document.querySelectorAll('.room-card[style="display: block"], .room-card:not([style*="display: none"])');
    const resultsText = document.querySelector('.results-count');
    if (resultsText) {
        resultsText.textContent = `Menampilkan ${visibleRooms.length} kamar`;
    }
    }
    </script>

    <!-- Rooms Grid -->
    <section class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(count($rooms) > 0)
            <!-- Room Count -->
            <div class="mb-8">
                <p class="text-lg text-gray-600">
                    Menampilkan {{ count($rooms) }} kamar
                    @if($selectedType !== 'all') untuk tipe {{ ucfirst($selectedType) }} @endif
                    @if($selectedStatus !== 'all') dengan status {{ ucfirst($selectedStatus) }} @endif
                </p>
            </div>

            <!-- Rooms Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($rooms as $kamar)
                <div class="room-card group bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100
                    {{ $kamar->status_kamar !== 'Tersedia' ? 'opacity-75' : '' }}">
                    
                    <!-- Room Image -->
                    <div class="relative overflow-hidden">
                        @php
                            $firstImage = $kamar->typeKamar->gambarTypeKamar->first()->url ?? 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=800&h=500&fit=crop&crop=center'
                        @endphp
                        <img src="{{ $firstImage }}" alt="{{ $kamar->typeKamar->gambarTypeKamar->first()->alt_text ?? 'Kamar ' . $kamar->nama_kamar }}" 
                             class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-700">
                        
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        
                        <!-- Status Badge -->
                        <div class="absolute top-4 left-4">
                            @if($kamar->status_kamar === 'Tersedia')
                                <div class="flex items-center bg-green-500 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg">
                                    <div class="w-2 h-2 bg-white rounded-full mr-2 animate-pulse"></div>
                                    Tersedia
                                </div>
                            @elseif($kamar->status_kamar === 'Booked')
                                <div class="flex items-center bg-orange-500 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg">
                                    <div class="w-2 h-2 bg-white rounded-full mr-2"></div>
                                    Booked
                                </div>
                            @else
                                <div class="flex items-center bg-red-500 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg">
                                    <div class="w-2 h-2 bg-white rounded-full mr-2"></div>
                                    Dihuni
                                </div>
                            @endif
                        </div>
                        
                        <!-- Room Type Badge -->
                        <div class="absolute top-4 right-4">
                            <span class="bg-blue-600 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg border-2 border-white">
                                {{ $kamar->typeKamar->nama }}
                            </span>
                        </div>

                    </div>
                    
                    <!-- Room Info -->
                    <div class="p-8">
                        <!-- Header -->
                        <div class="flex justify-between items-start mb-5">
                            <div>
                                <h3 class="room-number text-2xl font-bold text-gray-900 mb-1">{{ $kamar->nama_kamar }}</h3>
                                <p class="room-type text-gray-500 font-medium">{{ $kamar->typeKamar->nama }}</p>
                            </div>
                            <div class="text-right">
                                <div class="text-3xl font-black text-red-600 mb-1">
                                    Rp {{ number_format($kamar->typeKamar->harga/1000) }}K
                                </div>
                                <div class="text-sm text-gray-500 font-medium">/bulan</div>
                            </div>
                        </div>
                        
                        <!-- Room Specs -->
                        <div class="flex items-center justify-between bg-gray-50 rounded-2xl p-4 mb-5">
                            <div class="flex items-center text-gray-700">
                                <div class="bg-red-100 rounded-full p-2 mr-3">
                                    <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 4a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1V8zm8 0a1 1 0 011-1h4a1 1 0 011 1v2a1 1 0 01-1 1h-4a1 1 0 01-1-1V8z"/>
                                    </svg>
                                </div>
                                <span class="font-semibold">{{ $kamar->typeKamar->ukuran_kamar }}</span>
                            </div>
                            <div class="flex items-center text-gray-700">
                                <div class="bg-blue-100 rounded-full p-2 mr-3">
                                    <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                                    </svg>
                                </div>
                                <span class="font-semibold">{{ $kamar->typeKamar->type_kasur }}</span>
                            </div>
                        </div>
                        
                        <!-- Facilities -->
                        <div class="facilities mb-6">
                            <h4 class="text-sm font-bold text-gray-700 mb-3 uppercase tracking-wider">Fasilitas Utama</h4>
                            <div class="grid grid-cols-2 gap-2">
                                @foreach(array_slice($kamar->typeKamar->fasilitas_kamar ?? [], 0, 4) as $facility)
                                <div class="flex items-center text-sm text-gray-600">
                                    <div class="w-2 h-2 bg-red-400 rounded-full mr-2"></div>
                                    <span>{{ $facility }}</span>
                                </div>
                                @endforeach
                            </div>
                            @if(count($kamar->typeKamar->fasilitas_kamar ?? []) > 4)
                            <div class="mt-2">
                                <span class="text-red-600 text-sm font-semibold">+{{ count($kamar->typeKamar->fasilitas_kamar) - 4 }} fasilitas lainnya</span>
                            </div>
                            @endif
                        </div>
                        
                        <!-- Action Button -->
                        @if($kamar->status_kamar === 'Tersedia')
                            @if(auth()->check())
                                <a href="{{ route('room.detailed', $kamar->id) }}" 
                                   class="block w-full text-center py-4 rounded-2xl font-bold text-lg transition-all duration-300 transform hover:shadow-xl hover:scale-105"
                                   style="background: linear-gradient(135deg, #dc2626, #b91c1c) !important; color: white !important;">
                                    <span class="flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        Lihat Detail & Booking
                                    </span>
                                </a>
                            @else
                                <a href="{{ route('login') }}" 
                                   class="block w-full text-center py-4 rounded-2xl font-bold text-lg transition-all duration-300 transform hover:shadow-xl hover:scale-105"
                                   style="background: linear-gradient(135deg, #6b7280, #4b5563) !important; color: white !important;">
                                    <span class="flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                                        </svg>
                                        Login untuk Detail & Booking
                                    </span>
                                </a>
                            @endif
                        @elseif($kamar->status_kamar === 'Booked')
                            <div class="block w-full text-center py-4 rounded-2xl font-bold text-lg bg-orange-100 text-orange-600 cursor-not-allowed">
                                <span class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                    Booked
                                </span>
                            </div>
                        @endif
                        <!-- Occupied status: no button shown -->
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <!-- No Rooms Found -->
            <div class="text-center py-16">
                <div class="text-6xl mb-4">🔍</div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Tidak Ada Kamar Ditemukan</h3>
                <p class="text-gray-600 mb-8">Coba ubah filter pencarian Anda</p>
                <a href="{{ route('rooms.index') }}" class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition duration-300">
                    Lihat Semua Kamar
                </a>
            </div>
        @endif
        </div>
    </section>
</div>

@endsection