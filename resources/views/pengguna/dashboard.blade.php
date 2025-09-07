@extends('layouts.dashboard')

@section('title', 'Dashboard Pengguna - Kost Honest')

@section('content')
<div class="min-h-screen bg-gray-100">
    <!-- Mobile Header -->
    <header class="lg:hidden bg-white shadow-lg border-b border-gray-200 sticky top-0 z-40">
        <div class="flex items-center justify-between px-4 py-3">
            <!-- Logo and Brand -->
            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/logo/logo.png') }}" alt="Kost Honest Logo" class="h-8 w-8 object-contain">
                <h1 class="text-xl font-bold text-red-600">Kost Honest</h1>
            </div>
            
            <!-- Mobile Menu Button -->
            <button onclick="toggleMobileMenu()" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors">
                <svg id="menu-icon" class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg id="close-icon" class="w-6 h-6 text-gray-700 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden lg:hidden bg-white border-t border-gray-200">
            <div class="px-4 py-2 space-y-1">
                <div class="flex items-center px-3 py-2 rounded-lg bg-gray-50">
                    <svg class="w-5 h-5 mr-3 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                    </svg>
                    <span class="font-medium text-gray-700">{{ auth()->user()->name }}</span>
                </div>
                
                <!-- Mobile Profile Button -->
                <a href="{{ route('pengguna.profile') }}" class="flex items-center w-full px-3 py-2 text-gray-700 rounded-lg hover:bg-red-50 hover:text-red-600 transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Profile Saya
                </a>

                <!-- Mobile Change Password Button -->
                <a href="{{ route('pengguna.change-password') }}" class="flex items-center w-full px-3 py-2 text-gray-700 rounded-lg hover:bg-red-50 hover:text-red-600 transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 12H9v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-1C2 13.896 2.896 13 4 13h2.343z"/>
                    </svg>
                    Ubah Password
                </a>
                
                <!-- Mobile Logout Button -->
                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-3 py-2 text-gray-700 rounded-lg hover:bg-red-50 hover:text-red-600 transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Desktop Header -->
    <header class="hidden lg:block bg-white shadow-lg border-b border-gray-200">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <!-- Logo and Title -->
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('images/logo/logo.png') }}" alt="Kost Honest Logo" class="h-12 w-12 object-contain">
                    <div>
                        <h1 class="text-4xl font-bold text-red-600">Dashboard Pengguna</h1>
                        <p class="text-gray-600 mt-1">Kelola aktivitas kost Anda dengan mudah</p>
                    </div>
                </div>
                
                <!-- User Menu -->
                <div class="flex items-center space-x-6">
                    <!-- User Info -->
                    <div class="flex items-center space-x-3 bg-gray-50 rounded-xl px-4 py-3">
                        <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                            <p class="text-sm text-gray-500">Pengguna</p>
                        </div>
                    </div>
                    
                    <!-- Dropdown Menu -->
                    <div class="relative">
                        <button onclick="toggleDropdown()" class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 hover:bg-red-50 hover:border-red-200 border-2 border-transparent transition-all duration-200 group">
                            <svg class="w-4 h-4 text-gray-600 group-hover:text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                            </svg>
                        </button>
                        
                        <!-- Dropdown Content -->
                        <div id="dropdown-menu" class="hidden absolute right-0 mt-3 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-50 overflow-hidden">
                            <div class="py-1">
                                <a href="{{ route('pengguna.profile') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                    <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Profile Saya
                                </a>

                                <a href="{{ route('pengguna.change-password') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                    <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 12H9v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-1C2 13.896 2.896 13 4 13h2.343z"/>
                                    </svg>
                                    Ubah Password
                                </a>
                                
                                <hr class="border-gray-200">
                                
                                <form action="{{ route('logout') }}" method="POST" class="block">
                                    @csrf
                                    <button type="submit" class="flex items-center w-full px-4 py-3 text-sm text-left text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors">
                                        <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Content Area -->
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6 rounded-r-xl shadow-sm">
            <div class="flex">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="h-5 w-5 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="ml-3">
                    <p class="font-semibold text-green-800">Berhasil!</p>
                    <p class="text-sm text-green-700">{{ session('success') }}</p>
                </div>
            </div>
        </div>
        @endif

        @if(session('login_success'))
        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6 rounded-r-xl shadow-sm">
            <div class="flex">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="h-5 w-5 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="ml-3">
                    <p class="font-semibold text-blue-800">Selamat Datang!</p>
                    <p class="text-sm text-blue-700">{{ session('login_success') }}</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Quick Actions -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
            <!-- Lihat Kamar Available -->
            <a href="{{ route('rooms.index') }}" class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300 group cursor-pointer block">
                <div class="text-center">
                    <div class="w-16 h-16 bg-red-500 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Lihat Kamar</h3>
                    <p class="text-gray-600 mb-4">Jelajahi kamar yang tersedia</p>
                    <div class="w-full bg-red-500 hover:bg-red-600 text-white py-3 rounded-xl font-semibold transition-all duration-300 group-hover:bg-red-600">
                        Explore Rooms
                    </div>
                </div>
            </a>
            
            <!-- Type Kamar -->
            <a href="{{ route('rooms.types') }}" class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300 group cursor-pointer block">
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-500 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Type Kamar</h3>
                    <p class="text-gray-600 mb-4">Pilihan tipe kamar tersedia</p>
                    <div class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-xl font-semibold transition-all duration-300 group-hover:bg-blue-600">
                        Lihat Type Kamar
                    </div>
                </div>
            </a>
            
            <!-- Booking History -->
            <a href="{{ route('booking.history') }}" class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300 group cursor-pointer block">
                <div class="text-center">
                    <div class="w-16 h-16 bg-green-500 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Riwayat Booking</h3>
                    <p class="text-gray-600 mb-4">Lihat booking sebelumnya</p>
                    <div class="w-full bg-green-500 hover:bg-green-600 text-white py-3 rounded-xl font-semibold transition-all duration-300 group-hover:bg-green-600">
                        Lihat Riwayat
                    </div>
                </div>
            </a>

            <!-- Kamar Saya (Only shown if user has verified booking) -->
            @if($hasVerifiedBooking)
                <a href="#" class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300 group cursor-pointer block">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-purple-500 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Kamar Saya</h3>
                        <p class="text-gray-600 mb-4">{{ $currentBooking->kamar->nama_kamar ?? 'Lihat kamar yang sedang dihuni' }}</p>
                        <div class="w-full bg-purple-500 hover:bg-purple-600 text-white py-3 rounded-xl font-semibold transition-all duration-300 group-hover:bg-purple-600">
                            Lihat Kamar
                        </div>
                    </div>
                </a>
            @else
                <!-- Disabled Kamar Saya -->
                <div class="bg-gray-50 rounded-2xl shadow-lg p-6 border border-gray-200 cursor-not-allowed opacity-60">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-gray-400 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 1L3 5V11C3 16.55 6.84 21.74 12 23C17.16 21.74 21 16.55 21 11V5L12 1M12 7C13.4 7 14.8 8.6 14.8 10V11C15.4 11 16 11.4 16 12V16C16 16.6 15.6 17 15 17H9C8.4 17 8 16.6 8 16V12C8 11.4 8.4 11 9 11V10C9 8.6 10.6 7 12 7M12 8.2C11.2 8.2 10.2 9.2 10.2 10V11H13.8V10C13.8 9.2 12.8 8.2 12 8.2Z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-500 mb-2">Kamar Saya</h3>
                        <p class="text-gray-400 mb-4">Booking perlu diverifikasi admin dulu</p>
                        <div class="w-full bg-gray-400 text-white py-3 rounded-xl font-semibold cursor-not-allowed">
                            Tidak Tersedia
                        </div>
                    </div>
                </div>
            @endif

            <!-- Tagihan Saya (Only shown if user has verified booking) -->
            @if($hasVerifiedBooking)
                <a href="#" class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300 group cursor-pointer block">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-orange-500 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Tagihan Saya</h3>
                        <p class="text-gray-600 mb-4">Rp {{ number_format($currentBooking->total_amount ?? 0, 0, ',', '.') }}/bulan</p>
                        <div class="w-full bg-orange-500 hover:bg-orange-600 text-white py-3 rounded-xl font-semibold transition-all duration-300 group-hover:bg-orange-600">
                            Lihat Tagihan
                        </div>
                    </div>
                </a>
            @else
                <!-- Disabled Tagihan Saya -->
                <div class="bg-gray-50 rounded-2xl shadow-lg p-6 border border-gray-200 cursor-not-allowed opacity-60">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-gray-400 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 1L3 5V11C3 16.55 6.84 21.74 12 23C17.16 21.74 21 16.55 21 11V5L12 1M12 7C13.4 7 14.8 8.6 14.8 10V11C15.4 11 16 11.4 16 12V16C16 16.6 15.6 17 15 17H9C8.4 17 8 16.6 8 16V12C8 11.4 8.4 11 9 11V10C9 8.6 10.6 7 12 7M12 8.2C11.2 8.2 10.2 9.2 10.2 10V11H13.8V10C13.8 9.2 12.8 8.2 12 8.2Z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-500 mb-2">Tagihan Saya</h3>
                        <p class="text-gray-400 mb-4">Booking perlu diverifikasi admin dulu</p>
                        <div class="w-full bg-gray-400 text-white py-3 rounded-xl font-semibold cursor-not-allowed">
                            Tidak Tersedia
                        </div>
                    </div>
                </div>
            @endif
            
        </div>
    </div>
</div>

<script>
function toggleDropdown() {
    const dropdown = document.getElementById('dropdown-menu');
    const button = document.querySelector('button[onclick="toggleDropdown()"]');
    
    if (dropdown.classList.contains('hidden')) {
        dropdown.classList.remove('hidden');
        dropdown.classList.add('animate-fadeIn');
        button.classList.add('bg-red-50', 'border-red-200');
        button.classList.remove('bg-gray-100');
    } else {
        dropdown.classList.add('hidden');
        dropdown.classList.remove('animate-fadeIn');
        button.classList.remove('bg-red-50', 'border-red-200');
        button.classList.add('bg-gray-100');
    }
}

function toggleMobileMenu() {
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIcon = document.getElementById('menu-icon');
    const closeIcon = document.getElementById('close-icon');
    
    mobileMenu.classList.toggle('hidden');
    menuIcon.classList.toggle('hidden');
    closeIcon.classList.toggle('hidden');
}

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('dropdown-menu');
    const button = document.querySelector('button[onclick="toggleDropdown()"]');
    const dropdownButton = event.target.closest('button[onclick="toggleDropdown()"]');
    
    if (!dropdownButton && dropdown && !dropdown.contains(event.target) && !dropdown.classList.contains('hidden')) {
        dropdown.classList.add('hidden');
        dropdown.classList.remove('animate-fadeIn');
        if (button) {
            button.classList.remove('bg-red-50', 'border-red-200');
            button.classList.add('bg-gray-100');
        }
    }
    
    // Close mobile menu when clicking outside
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileButton = event.target.closest('button[onclick="toggleMobileMenu()"]');
    
    if (!mobileButton && mobileMenu && !mobileMenu.contains(event.target) && !mobileMenu.classList.contains('hidden')) {
        toggleMobileMenu();
    }
});

// Add simple fade animation with CSS
const style = document.createElement('style');
style.textContent = `
    .animate-fadeIn {
        animation: fadeIn 0.2s ease-out;
    }
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
`;
document.head.appendChild(style);
</script>
@endsection