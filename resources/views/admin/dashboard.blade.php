@extends('layouts.admin')

@section('title', 'Admin Dashboard - Kost Honest')
@section('page-title', 'Dashboard')

@section('content')
<!-- Export Buttons -->
<div class="mb-6 flex justify-end space-x-4">
    <a href="{{ route('admin.dashboard.export.pdf') }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-colors duration-300 flex items-center">
        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
            <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" />
        </svg>
        Export PDF
    </a>
    <a href="{{ route('admin.dashboard.export.excel') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors duration-300 flex items-center">
        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
            <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" />
        </svg>
        Export Excel
    </a>
</div>
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
            <div class="mb-4">
                <h1 class="text-3xl font-bold mb-1">Selamat Datang, {{ auth()->user()->name }}!</h1>
                <p class="text-red-100 text-lg">Kelola sistem kost dengan kontrol penuh</p>
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
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Users Card -->
    <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300 border-l-4 border-blue-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Total Users</p>
                <p class="text-3xl font-bold text-gray-900 mb-2">{{ $stats['total_users'] }}</p>
                <div class="flex items-center text-sm">
                    <span class="text-blue-600 font-medium">+{{ $stats['this_month_users'] }}</span>
                    <span class="text-gray-500 ml-1">bulan ini</span>
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
                <p class="text-sm font-medium text-gray-600 mb-1">Total Tipe Kamar</p>
                <p class="text-3xl font-bold text-gray-900 mb-2">{{ $stats['total_type_kamar'] }}</p>
                <div class="flex items-center text-sm">
                    <span class="text-green-600 font-medium">{{ $stats['total_rooms'] }}</span>
                    <span class="text-gray-500 ml-1">total kamar</span>
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
                <p class="text-3xl font-bold text-gray-900 mb-2">{{ $stats['available_rooms'] }}</p>
                <div class="flex items-center text-sm">
                    <span class="text-yellow-600 font-medium">{{ $stats['occupied_rooms'] }}</span>
                    <span class="text-gray-500 ml-1">kamar dihuni</span>
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
                <p class="text-3xl font-bold text-gray-900 mb-2">{{ $stats['occupancy_rate'] }}%</p>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-gradient-to-r from-red-400 to-red-600 h-2 rounded-full" style="width: {{ $stats['occupancy_rate'] }}%"></div>
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
                <a href="{{ route('admin.users.create') }}" class="group relative overflow-hidden bg-gradient-to-r from-blue-500 to-blue-600 text-white p-6 rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 hover:scale-105 hover:shadow-xl block">
                    <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    <div class="flex items-center">
                        <div class="bg-blue-700 rounded-lg p-3 mr-4">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                            </svg>
                        </div>
                        <div class="text-left">
                            <div class="font-semibold text-lg">Tambah User</div>
                            <div class="text-blue-100 text-sm">Kelola pengguna sistem</div>
                        </div>
                    </div>
                </a>
                
                <a href="{{ route('admin.kamar.create') }}" class="group relative overflow-hidden bg-gradient-to-r from-green-500 to-green-600 text-white p-6 rounded-xl hover:from-green-600 hover:to-green-700 transition-all duration-300 hover:scale-105 hover:shadow-xl block">
                    <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    <div class="flex items-center">
                        <div class="bg-green-700 rounded-lg p-3 mr-4">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                            </svg>
                        </div>
                        <div class="text-left">
                            <div class="font-semibold text-lg">Tambah Kost</div>
                            <div class="text-green-100 text-sm">Daftarkan kost baru</div>
                        </div>
                    </div>
                </a>
                
                <a href="{{ route('admin.type-kamar.create') }}" class="group relative overflow-hidden bg-gradient-to-r from-yellow-500 to-yellow-600 text-white p-6 rounded-xl hover:from-yellow-600 hover:to-yellow-700 transition-all duration-300 hover:scale-105 hover:shadow-xl block">
                    <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    <div class="flex items-center">
                        <div class="bg-yellow-700 rounded-lg p-3 mr-4">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                            </svg>
                        </div>
                        <div class="text-left">
                            <div class="font-semibold text-lg">Tambah Tipe</div>
                            <div class="text-yellow-100 text-sm">Atur tipe kamar</div>
                        </div>
                    </div>
                </a>
                
                <a href="{{ route('admin.galeri.create') }}" class="group relative overflow-hidden bg-gradient-to-r from-purple-500 to-purple-600 text-white p-6 rounded-xl hover:from-purple-600 hover:to-purple-700 transition-all duration-300 hover:scale-105 hover:shadow-xl block">
                    <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    <div class="flex items-center">
                        <div class="bg-purple-700 rounded-lg p-3 mr-4">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                            </svg>
                        </div>
                        <div class="text-left">
                            <div class="font-semibold text-lg">Kelola Galeri</div>
                            <div class="text-purple-100 text-sm">Upload foto kost</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    
    <!-- System Info -->
    <div class="space-y-6">
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h5 class="text-lg font-bold text-gray-900 mb-4">Quick Stats</h5>
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Hari ini</span>
                    <span class="font-bold text-blue-600">{{ $stats['today_users'] }} Pendaftar</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Minggu ini</span>
                    <span class="font-bold text-green-600">{{ $stats['this_week_bookings'] }} Booking</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Bulan ini</span>
                    <span class="font-bold text-purple-600">Rp {{ number_format($stats['this_month_revenue'], 0, ',', '.') }}</span>
                </div>
            </div>
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
        const currentTimeElement = document.getElementById('current-time');
        if (currentTimeElement) {
            currentTimeElement.textContent = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit'
            });
        }
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