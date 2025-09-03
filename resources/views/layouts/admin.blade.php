<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard - Kost Honest')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-inter bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="bg-white shadow-lg w-64 min-h-screen fixed left-0 top-0 z-50 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out" id="sidebar">
         <div class="flex items-center justify-center h-16 border-b border-gray-200 px-4">
    <div class="flex items-center space-x-3">
        <img src="{{ asset('images/logo/logo.png') }}" alt="Kost Honest Logo" class="h-10 w-10 object-contain">
        <h1 class="text-2xl font-bold text-red-600">Kost Honest</h1>
    </div>
</div>
            
            <nav class="mt-8">
                <div class="px-4 space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 
                        {{ request()->routeIs('admin.dashboard') ? 'bg-red-600 text-white shadow-lg border-l-4 border-red-800' : 'text-gray-700 hover:bg-red-50 hover:text-red-600 hover:translate-x-1' }}">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/>
                        </svg>
                        Dashboard
                    </a>
                    
                    <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 
                        {{ request()->routeIs('admin.users*') ? 'bg-red-600 text-white shadow-lg border-l-4 border-red-800' : 'text-gray-700 hover:bg-red-50 hover:text-red-600 hover:translate-x-1' }}">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Kelola Users
                    </a>
                    
                    <a href="{{ route('admin.kamar.index') }}" class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 
                        {{ request()->routeIs('admin.kamar*') ? 'bg-red-600 text-white shadow-lg border-l-4 border-red-800' : 'text-gray-700 hover:bg-red-50 hover:text-red-600 hover:translate-x-1' }}">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                        Kelola Kost
                    </a>
                    
                    <a href="{{ route('admin.type-kamar.index') }}" class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 
                        {{ request()->routeIs('admin.type-kamar*') ? 'bg-red-600 text-white shadow-lg border-l-4 border-red-800' : 'text-gray-700 hover:bg-red-50 hover:text-red-600 hover:translate-x-1' }}">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                        </svg>
                        Tipe Kamar
                    </a>
                    
                    <a href="{{ route('admin.galeri.index') }}" class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 
                        {{ request()->routeIs('admin.galeri*') ? 'bg-red-600 text-white shadow-lg border-l-4 border-red-800' : 'text-gray-700 hover:bg-red-50 hover:text-red-600 hover:translate-x-1' }}">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                        </svg>
                        Galeri
                    </a>
                    
                    <a href="{{ route('admin.booking.index') }}" class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 
                        {{ request()->routeIs('admin.booking*') ? 'bg-red-600 text-white shadow-lg border-l-4 border-red-800' : 'text-gray-700 hover:bg-red-50 hover:text-red-600 hover:translate-x-1' }}">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"/>
                        </svg>
                        Booking
                    </a>
                    
                    <a href="{{ route('admin.laporan.index') }}" class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 
                        {{ request()->routeIs('admin.laporan*') ? 'bg-red-600 text-white shadow-lg border-l-4 border-red-800' : 'text-gray-700 hover:bg-red-50 hover:text-red-600 hover:translate-x-1' }}">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 3h-4.18C14.4 1.84 13.3 1 12 1c-1.3 0-2.4.84-2.82 2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 0c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm2 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                        </svg>
                        Laporan
                    </a>
                </div>
                
                <div class="px-4 mt-8">
                    <div class="border-t border-gray-200 pt-4">
                        <form action="{{ route('logout') }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-red-50 hover:text-red-600 transition-colors duration-200 w-full text-left">
                                <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </nav>
        </div>
        
        <!-- Overlay for mobile -->
        <div class="fixed inset-0 bg-black opacity-50 z-40 lg:hidden hidden" id="sidebar-overlay"></div>
        
        <!-- Main Content Area -->
        <div class="flex-1 lg:ml-64">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm border-b border-gray-200 p-4">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <button class="lg:hidden mr-4 p-2 rounded-md hover:bg-gray-100" id="sidebar-toggle">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        <h2 class="text-xl lg:text-2xl font-bold text-gray-900">@yield('page-title', 'Dashboard')</h2>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="hidden sm:block text-sm text-gray-500">
                            {{ \Carbon\Carbon::now('Asia/Jakarta')->locale('id')->translatedFormat('l, d F Y') }}
                        </div>
                        <div class="flex items-center text-sm text-gray-700">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                            </svg>
                            <span class="font-medium">{{ auth()->user()->name }}</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 bg-gray-50 p-4 lg:p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Include Custom Alert and Modal Components -->
    @include('components.alert')
    @include('components.modal')

    <!-- Show Session Messages as Toasts -->
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showToast('{{ session('success') }}', 'success', 4000);
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showToast('{{ session('error') }}', 'error', 4000);
            });
        </script>
    @endif

    @if(session('warning'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showToast('{{ session('warning') }}', 'warning', 4000);
            });
        </script>
    @endif

    @if(session('info'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showToast('{{ session('info') }}', 'info', 4000);
            });
        </script>
    @endif
    
    <script>
        // Mobile sidebar toggle
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebar-overlay');
            
            if (sidebarToggle && sidebar && sidebarOverlay) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('-translate-x-full');
                    sidebarOverlay.classList.toggle('hidden');
                });
                
                sidebarOverlay.addEventListener('click', function() {
                    sidebar.classList.add('-translate-x-full');
                    sidebarOverlay.classList.add('hidden');
                });
            }
        });
    </script>

</body>
</html>