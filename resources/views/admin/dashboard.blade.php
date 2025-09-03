@extends('layouts.admin')

@section('title', 'Admin Dashboard - Kost Honest')
@section('page-title', 'Dashboard')

@section('content')
<!-- Alert Notification -->
<div id="success-notification" class="hidden fixed top-4 right-4 z-50 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-lg max-w-sm">
    <div class="flex items-center">
        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
        </svg>
        <span id="success-message"></span>
    </div>
</div>

<!-- Header Section -->
<div class="bg-gradient-to-r from-red-600 to-red-700 rounded-2xl shadow-xl p-8 mb-8 text-white">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
        <div class="mb-6 lg:mb-0">
            <div class="flex items-center mb-4">
                <div class="bg-white bg-opacity-20 rounded-xl p-3 mr-4">
                    <svg class="w-10 h-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H7m0 0H5m2 0v-4"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold mb-1">Selamat Datang, {{ auth()->user()->name }}!</h1>
                    <p class="text-red-100 text-lg">Kelola sistem kost dengan kontrol penuh</p>
                </div>
            </div>
            <div class="flex flex-wrap gap-6 text-red-100">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                    </svg>
                    <span>Role: <strong class="text-white">{{ ucfirst(auth()->user()->role) }}</strong></span>
                </div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                    </svg>
                    <span>{{ auth()->user()->email }}</span>
                </div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                    </svg>
                    <span>{{ now()->locale('id')->translatedFormat('l, d F Y - H:i') }}</span>
                </div>
            </div>
        </div>
        <div class="hidden lg:block">
            <div class="bg-white bg-opacity-10 rounded-xl p-6 backdrop-blur-sm">
                <div class="text-center">
                    <div class="text-3xl font-bold mb-1">{{ date('H:i') }}</div>
                    <div class="text-red-100 text-sm">{{ now()->locale('id')->translatedFormat('d M Y') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Users Card -->
    <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300 border-l-4 border-blue-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Total Users</p>
                <p class="text-3xl font-bold text-gray-900 mb-2">24</p>
                <div class="flex items-center text-sm">
                    <span class="text-green-600 font-medium">+12%</span>
                    <span class="text-gray-500 ml-1">dari bulan lalu</span>
                </div>
            </div>
            <div class="bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl p-4">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Total Kost Card -->
    <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300 border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Total Kost</p>
                <p class="text-3xl font-bold text-gray-900 mb-2">6</p>
                <div class="flex items-center text-sm">
                    <span class="text-green-600 font-medium">+2</span>
                    <span class="text-gray-500 ml-1">kost baru</span>
                </div>
            </div>
            <div class="bg-gradient-to-br from-green-400 to-green-600 rounded-xl p-4">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Available Rooms Card -->
    <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300 border-l-4 border-yellow-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Kamar Tersedia</p>
                <p class="text-3xl font-bold text-gray-900 mb-2">12</p>
                <div class="flex items-center text-sm">
                    <span class="text-yellow-600 font-medium">5</span>
                    <span class="text-gray-500 ml-1">kamar kosong</span>
                </div>
            </div>
            <div class="bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-xl p-4">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Occupancy Rate Card -->
    <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300 border-l-4 border-red-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Tingkat Hunian</p>
                <p class="text-3xl font-bold text-gray-900 mb-2">85%</p>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-gradient-to-r from-red-400 to-red-600 h-2 rounded-full" style="width: 85%"></div>
                </div>
            </div>
            <div class="bg-gradient-to-br from-red-400 to-red-600 rounded-xl p-4">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M16 6l2.29 2.29-4.88 4.88-4-4L2 16.59 3.41 18l6-6 4 4 6.3-6.29L22 12V6z"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions & Management Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
    <!-- Quick Actions -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <h4 class="text-xl font-bold text-gray-900">Quick Actions</h4>
                <div class="text-sm text-gray-500">Aksi Cepat</div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <button class="group relative overflow-hidden bg-gradient-to-r from-blue-500 to-blue-600 text-white p-6 rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 hover:scale-105 hover:shadow-xl">
                    <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    <div class="flex items-center">
                        <div class="bg-white bg-opacity-20 rounded-lg p-3 mr-4">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                            </svg>
                        </div>
                        <div class="text-left">
                            <div class="font-semibold text-lg">Tambah User</div>
                            <div class="text-blue-100 text-sm">Kelola pengguna sistem</div>
                        </div>
                    </div>
                </button>
                
                <button class="group relative overflow-hidden bg-gradient-to-r from-green-500 to-green-600 text-white p-6 rounded-xl hover:from-green-600 hover:to-green-700 transition-all duration-300 hover:scale-105 hover:shadow-xl">
                    <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    <div class="flex items-center">
                        <div class="bg-white bg-opacity-20 rounded-lg p-3 mr-4">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                            </svg>
                        </div>
                        <div class="text-left">
                            <div class="font-semibold text-lg">Tambah Kost</div>
                            <div class="text-green-100 text-sm">Daftarkan kost baru</div>
                        </div>
                    </div>
                </button>
                
                <button class="group relative overflow-hidden bg-gradient-to-r from-yellow-500 to-yellow-600 text-white p-6 rounded-xl hover:from-yellow-600 hover:to-yellow-700 transition-all duration-300 hover:scale-105 hover:shadow-xl">
                    <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    <div class="flex items-center">
                        <div class="bg-white bg-opacity-20 rounded-lg p-3 mr-4">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                            </svg>
                        </div>
                        <div class="text-left">
                            <div class="font-semibold text-lg">Tambah Tipe</div>
                            <div class="text-yellow-100 text-sm">Atur tipe kamar</div>
                        </div>
                    </div>
                </button>
                
                <button class="group relative overflow-hidden bg-gradient-to-r from-purple-500 to-purple-600 text-white p-6 rounded-xl hover:from-purple-600 hover:to-purple-700 transition-all duration-300 hover:scale-105 hover:shadow-xl">
                    <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    <div class="flex items-center">
                        <div class="bg-white bg-opacity-20 rounded-lg p-3 mr-4">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                            </svg>
                        </div>
                        <div class="text-left">
                            <div class="font-semibold text-lg">Kelola Galeri</div>
                            <div class="text-purple-100 text-sm">Upload foto kost</div>
                        </div>
                    </div>
                </button>
            </div>
        </div>
    </div>
    
    <!-- System Info -->
    <div class="space-y-6">
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h5 class="text-lg font-bold text-gray-900 mb-4">System Info</h5>
            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Server Status</span>
                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">Online</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Database</span>
                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">Connected</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Storage</span>
                    <span class="text-gray-900 font-medium">78% Used</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-gradient-to-r from-green-400 to-blue-500 h-2 rounded-full" style="width: 78%"></div>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h5 class="text-lg font-bold text-gray-900 mb-4">Quick Stats</h5>
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Hari ini</span>
                    <span class="font-bold text-blue-600">3 Pendaftar</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Minggu ini</span>
                    <span class="font-bold text-green-600">12 Booking</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Bulan ini</span>
                    <span class="font-bold text-purple-600">₹ 45,680,000</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity & Analytics -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Recent Activity -->
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <h4 class="text-xl font-bold text-gray-900">Recent Activity</h4>
            <button class="text-red-600 hover:text-red-700 font-medium text-sm">
                View All
            </button>
        </div>
        <div class="space-y-4">
            <div class="flex items-center p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl border-l-4 border-green-500 hover:shadow-md transition-shadow duration-300">
                <div class="bg-green-500 rounded-xl p-3 mr-4">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="font-semibold text-gray-900">User baru mendaftar</p>
                    <p class="text-sm text-gray-600">John Doe bergabung dengan sistem</p>
                    <p class="text-xs text-gray-500 mt-1">2 jam yang lalu</p>
                </div>
            </div>
            
            <div class="flex items-center p-4 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl border-l-4 border-blue-500 hover:shadow-md transition-shadow duration-300">
                <div class="bg-blue-500 rounded-xl p-3 mr-4">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="font-semibold text-gray-900">Kamar 201 telah dipesan</p>
                    <p class="text-sm text-gray-600">Jane Smith melakukan booking</p>
                    <p class="text-xs text-gray-500 mt-1">4 jam yang lalu</p>
                </div>
            </div>
            
            <div class="flex items-center p-4 bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl border-l-4 border-purple-500 hover:shadow-md transition-shadow duration-300">
                <div class="bg-purple-500 rounded-xl p-3 mr-4">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="font-semibold text-gray-900">Tipe kamar baru ditambahkan</p>
                    <p class="text-sm text-gray-600">Tipe "Deluxe" telah dibuat</p>
                    <p class="text-xs text-gray-500 mt-1">6 jam yang lalu</p>
                </div>
            </div>
            
            <div class="flex items-center p-4 bg-gradient-to-r from-orange-50 to-yellow-50 rounded-xl border-l-4 border-orange-500 hover:shadow-md transition-shadow duration-300">
                <div class="bg-orange-500 rounded-xl p-3 mr-4">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="font-semibold text-gray-900">Review baru diterima</p>
                    <p class="text-sm text-gray-600">Rating 5 bintang untuk Kost Mawar</p>
                    <p class="text-xs text-gray-500 mt-1">1 hari yang lalu</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Analytics Chart Placeholder -->
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <h4 class="text-xl font-bold text-gray-900">Analytics Overview</h4>
            <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
                <option>Last 30 days</option>
                <option>Last 7 days</option>
                <option>Last 90 days</option>
            </select>
        </div>
        
        <!-- Simple Chart Representation -->
        <div class="h-64 bg-gradient-to-br from-red-50 to-pink-50 rounded-xl p-6 flex flex-col justify-center items-center">
            <svg class="w-16 h-16 text-red-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
            <h3 class="text-lg font-bold text-gray-700 mb-2">Grafik Analitik</h3>
            <p class="text-gray-500 text-center text-sm">Visualisasi data statistik akan ditampilkan di sini. Termasuk trend booking, pendapatan, dan tingkat hunian.</p>
            <button class="mt-4 px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-300">
                View Details
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Show success notification if login was successful
    @if(session('login_success'))
        showSuccessAlert('{{ session('login_success') }}');
    @endif
    
    // Auto-update time display
    function updateTime() {
        const now = new Date();
        const timeElements = document.querySelectorAll('.current-time');
        timeElements.forEach(element => {
            element.textContent = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit'
            });
        });
    }
    
    // Update time every minute
    setInterval(updateTime, 60000);
    updateTime();
    
    // Add hover animations to stat cards
    const statCards = document.querySelectorAll('.hover\\:shadow-xl');
    statCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
    
    // Show success alert function
    function showSuccessAlert(message) {
        const alertDiv = document.getElementById('success-notification');
        const alertMessage = document.getElementById('success-message');
        
        alertMessage.textContent = message;
        alertDiv.classList.remove('hidden');
        
        // Auto hide after 3 seconds
        setTimeout(() => {
            alertDiv.classList.add('hidden');
        }, 3000);
    }
});
</script>
@endsection