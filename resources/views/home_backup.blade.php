@extends('layouts.app')

@section('title', 'Kost Honest - Hunian Nyaman dan Terpercaya')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-red-600 to-red-800 text-white min-h-screen flex items-center">
    <div class="absolute inset-0 bg-black opacity-20"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <!-- Content -->
            <div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6">
                    Hunian Kost 
                    <span class="text-yellow-300">Honest</span>
                </h1>
                <p class="text-xl md:text-2xl mb-8 text-gray-100">
                    Tempat tinggal yang nyaman, aman, dan terpercaya dengan fasilitas lengkap untuk kehidupan sehari-hari Anda.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#fasilitas" class="bg-yellow-400 text-gray-900 px-8 py-3 rounded-lg font-bold text-lg hover:bg-yellow-500 transition duration-300 text-center">
                        Lihat Fasilitas
                    </a>
                    <a href="#kontak" class="border-2 border-white text-white px-8 py-3 rounded-lg font-bold text-lg hover:bg-white hover:text-red-600 transition duration-300 text-center">
                        Hubungi Kami
                    </a>
                </div>
            </div>
            
            <!-- Hero Image/Visual -->
            <div class="flex justify-center">
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 max-w-md">
                    <div class="text-center">
                        <div class="bg-yellow-400 text-gray-900 rounded-full w-24 h-24 flex items-center justify-center text-4xl font-bold mx-auto mb-4">
                            🏠
                        </div>
                        <h3 class="text-2xl font-bold mb-4">Kost Premium</h3>
                        <p class="text-gray-100">Dilengkapi fasilitas modern untuk kenyamanan maksimal</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Type Kamar Section -->
<section id="type-kamar" class="py-20 bg-gray-50">
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
                    <!-- Slide 1 -->
                    <div class="carousel-slide min-w-full relative">
                        <img src="https://images.unsplash.com/photo-1555854877-bab0e564b8d5?w=800&h=500&fit=crop&crop=center" 
                             alt="Tampak Depan Kost" 
                             class="w-full h-96 object-cover">
                        <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/70 to-transparent p-6">
                            <h3 class="text-white text-xl font-bold mb-2">Tampak Depan Kost Honest</h3>
                            <p class="text-white/90 text-sm">Bangunan modern dengan akses mudah</p>
                        </div>
                    </div>
                    
                    <!-- Slide 2 -->
                    <div class="carousel-slide min-w-full relative">
                        <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=800&h=500&fit=crop&crop=center" 
                             alt="Kamar Tidur" 
                             class="w-full h-96 object-cover">
                        <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/70 to-transparent p-6">
                            <h3 class="text-white text-xl font-bold mb-2">Kamar Tidur Nyaman</h3>
                            <p class="text-white/90 text-sm">Tempat istirahat yang tenang dan bersih</p>
                        </div>
                    </div>
                    
                    <!-- Slide 3 -->
                    <div class="carousel-slide min-w-full relative">
                        <img src="https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=800&h=500&fit=crop&crop=center" 
                             alt="Dapur Bersama" 
                             class="w-full h-96 object-cover">
                        <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/70 to-transparent p-6">
                            <h3 class="text-white text-xl font-bold mb-2">Dapur Bersama Modern</h3>
                            <p class="text-white/90 text-sm">Peralatan masak lengkap untuk kebutuhan sehari-hari</p>
                        </div>
                    </div>
                    
                    <!-- Slide 4 -->
                    <div class="carousel-slide min-w-full relative">
                        <img src="https://images.unsplash.com/photo-1620626011761-996317b8d101?w=800&h=500&fit=crop&crop=center" 
                             alt="Kamar Mandi" 
                             class="w-full h-96 object-cover">
                        <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/70 to-transparent p-6">
                            <h3 class="text-white text-xl font-bold mb-2">Kamar Mandi Bersih</h3>
                            <p class="text-white/90 text-sm">Fasilitas air panas dan ventilasi baik</p>
                        </div>
                    </div>
                    
                    <!-- Slide 5 -->
                    <div class="carousel-slide min-w-full relative">
                        <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=800&h=500&fit=crop&crop=center" 
                             alt="Area Santai" 
                             class="w-full h-96 object-cover">
                        <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/70 to-transparent p-6">
                            <h3 class="text-white text-xl font-bold mb-2">Area Santai</h3>
                            <p class="text-white/90 text-sm">Tempat berkumpul dan bersantai bersama</p>
                        </div>
                    </div>
                    
                    <!-- Slide 6 -->
                    <div class="carousel-slide min-w-full relative">
                        <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&h=500&fit=crop&crop=center" 
                             alt="Area Parkir" 
                             class="w-full h-96 object-cover">
                        <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/70 to-transparent p-6">
                            <h3 class="text-white text-xl font-bold mb-2">Area Parkir Luas</h3>
                            <p class="text-white/90 text-sm">Parkir motor dan mobil yang aman</p>
                        </div>
                    </div>
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
                <button class="carousel-dot w-3 h-3 bg-red-600 rounded-full transition duration-300" data-slide="0"></button>
                <button class="carousel-dot w-3 h-3 bg-gray-300 rounded-full hover:bg-red-400 transition duration-300" data-slide="1"></button>
                <button class="carousel-dot w-3 h-3 bg-gray-300 rounded-full hover:bg-red-400 transition duration-300" data-slide="2"></button>
                <button class="carousel-dot w-3 h-3 bg-gray-300 rounded-full hover:bg-red-400 transition duration-300" data-slide="3"></button>
                <button class="carousel-dot w-3 h-3 bg-gray-300 rounded-full hover:bg-red-400 transition duration-300" data-slide="4"></button>
                <button class="carousel-dot w-3 h-3 bg-gray-300 rounded-full hover:bg-red-400 transition duration-300" data-slide="5"></button>
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
            <!-- Type Kamar 1 - Standard -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                <!-- Room Image Placeholder -->
                <div class="h-64 bg-gradient-to-br from-red-100 to-red-200 flex items-center justify-center">
                    <div class="text-center">
                        <div class="text-6xl mb-4">🛏️</div>
                        <p class="text-red-700 font-semibold">Kamar Standard</p>
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-2xl font-bold text-gray-900">Standard Room</h3>
                        <div class="text-right">
                            <div class="text-2xl font-bold text-red-600">Rp 800K</div>
                            <div class="text-sm text-gray-500">/bulan</div>
                        </div>
                    </div>
                    
                    <p class="text-gray-600 mb-6">
                        Kamar nyaman dengan fasilitas dasar yang lengkap untuk kebutuhan sehari-hari.
                    </p>
                    
                    <!-- Facilities -->
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center text-sm">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span>Kasur single + lemari</span>
                        </div>
                        <div class="flex items-center text-sm">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span>Kamar mandi dalam</span>
                        </div>
                        <div class="flex items-center text-sm">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span>WiFi gratis</span>
                        </div>
                        <div class="flex items-center text-sm">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span>Listrik & air termasuk</span>
                        </div>
                    </div>
                    
                    <a href="{{ route('room.detail', 'standard') }}" class="block w-full bg-red-600 text-white py-3 px-4 rounded-lg hover:bg-red-700 font-semibold transition duration-300 text-center">
                        Lihat Detail Kamar
                    </a>
                </div>
            </div>
            
            <!-- Type Kamar 2 - Deluxe -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300 border-2 border-red-200">
                <!-- Popular Badge -->
                <div class="relative">
                    <div class="h-64 bg-gradient-to-br from-red-200 to-red-300 flex items-center justify-center">
                        <div class="text-center">
                            <div class="text-6xl mb-4">🏨</div>
                            <p class="text-red-700 font-semibold">Kamar Deluxe</p>
                        </div>
                    </div>
                    <div class="absolute top-4 right-4 bg-red-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        Terpopuler
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-2xl font-bold text-gray-900">Deluxe Room</h3>
                        <div class="text-right">
                            <div class="text-2xl font-bold text-red-600">Rp 1.2M</div>
                            <div class="text-sm text-gray-500">/bulan</div>
                        </div>
                    </div>
                    
                    <p class="text-gray-600 mb-6">
                        Kamar luas dengan fasilitas premium dan pemandangan yang menarik.
                    </p>
                    
                    <!-- Facilities -->
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center text-sm">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span>Kasur queen size + lemari besar</span>
                        </div>
                        <div class="flex items-center text-sm">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span>AC + kamar mandi dalam</span>
                        </div>
                        <div class="flex items-center text-sm">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span>WiFi premium + meja kerja</span>
                        </div>
                        <div class="flex items-center text-sm">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span>Semua fasilitas termasuk</span>
                        </div>
                        <div class="flex items-center text-sm">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span>Akses balkon pribadi</span>
                        </div>
                    </div>
                    
                    <a href="{{ route('room.detail', 'deluxe') }}" class="block w-full bg-red-600 text-white py-3 px-4 rounded-lg hover:bg-red-700 font-semibold transition duration-300 text-center">
                        Lihat Detail Kamar
                    </a>
                </div>
            </div>
            
            <!-- Type Kamar 3 - VIP -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                <!-- Room Image Placeholder -->
                <div class="h-64 bg-gradient-to-br from-yellow-100 to-yellow-200 flex items-center justify-center">
                    <div class="text-center">
                        <div class="text-6xl mb-4">👑</div>
                        <p class="text-yellow-700 font-semibold">Kamar VIP</p>
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-2xl font-bold text-gray-900">VIP Room</h3>
                        <div class="text-right">
                            <div class="text-2xl font-bold text-red-600">Rp 1.8M</div>
                            <div class="text-sm text-gray-500">/bulan</div>
                        </div>
                    </div>
                    
                    <p class="text-gray-600 mb-6">
                        Kamar premium dengan fasilitas mewah dan service eksklusif.
                    </p>
                    
                    <!-- Facilities -->
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center text-sm">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span>Kasur king size + furniture premium</span>
                        </div>
                        <div class="flex items-center text-sm">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span>AC + kamar mandi mewah</span>
                        </div>
                        <div class="flex items-center text-sm">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span>Mini kitchen + kulkas pribadi</span>
                        </div>
                        <div class="flex items-center text-sm">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span>Laundry service gratis</span>
                        </div>
                        <div class="flex items-center text-sm">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span>Priority access & concierge</span>
                        </div>
                    </div>
                    
                    <a href="{{ route('room.detail', 'vip') }}" class="block w-full bg-red-600 text-white py-3 px-4 rounded-lg hover:bg-red-700 font-semibold transition duration-300 text-center">
                        Lihat Detail Kamar
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Comparison Table -->
        <div class="mt-16">
            <h3 class="text-2xl font-bold text-center text-gray-900 mb-8">Perbandingan Type Kamar</h3>
            <div class="overflow-x-auto">
                <table class="w-full bg-white rounded-lg shadow-lg overflow-hidden">
                    <thead class="bg-red-600 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left">Fasilitas</th>
                            <th class="px-6 py-4 text-center">Standard</th>
                            <th class="px-6 py-4 text-center">Deluxe</th>
                            <th class="px-6 py-4 text-center">VIP</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 font-medium">Ukuran Kamar</td>
                            <td class="px-6 py-4 text-center">3x3m</td>
                            <td class="px-6 py-4 text-center">3x4m</td>
                            <td class="px-6 py-4 text-center">4x5m</td>
                        </tr>
                        <tr class="bg-gray-50">
                            <td class="px-6 py-4 font-medium">Kasur</td>
                            <td class="px-6 py-4 text-center">Single</td>
                            <td class="px-6 py-4 text-center">Queen</td>
                            <td class="px-6 py-4 text-center">King</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 font-medium">AC</td>
                            <td class="px-6 py-4 text-center">❌</td>
                            <td class="px-6 py-4 text-center">✅</td>
                            <td class="px-6 py-4 text-center">✅</td>
                        </tr>
                        <tr class="bg-gray-50">
                            <td class="px-6 py-4 font-medium">Kamar Mandi Dalam</td>
                            <td class="px-6 py-4 text-center">✅</td>
                            <td class="px-6 py-4 text-center">✅</td>
                            <td class="px-6 py-4 text-center">✅</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 font-medium">Mini Kitchen</td>
                            <td class="px-6 py-4 text-center">❌</td>
                            <td class="px-6 py-4 text-center">❌</td>
                            <td class="px-6 py-4 text-center">✅</td>
                        </tr>
                        <tr class="bg-gray-50">
                            <td class="px-6 py-4 font-medium">Balkon</td>
                            <td class="px-6 py-4 text-center">❌</td>
                            <td class="px-6 py-4 text-center">✅</td>
                            <td class="px-6 py-4 text-center">✅</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 font-medium">Harga/bulan</td>
                            <td class="px-6 py-4 text-center font-bold text-red-600">Rp 800K</td>
                            <td class="px-6 py-4 text-center font-bold text-red-600">Rp 1.2M</td>
                            <td class="px-6 py-4 text-center font-bold text-red-600">Rp 1.8M</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- Tentang Section -->
<section id="tentang" class="py-20 bg-white">
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

<!-- Kontak Section -->
<section id="kontak" class="py-20 bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Hubungi Kami</h2>
            <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                Siap untuk menjadi bagian dari Kost Honest? Hubungi kami sekarang untuk informasi lebih lanjut
            </p>
        </div>
        
        <div class="grid md:grid-cols-2 gap-12">
            <!-- Contact Info -->
            <div>
                <h3 class="text-2xl font-bold mb-8">Informasi Kontak</h3>
                <div class="space-y-6">
                    <div class="flex items-center">
                        <div class="bg-red-600 rounded-full w-12 h-12 flex items-center justify-center text-xl mr-4">
                            📧
                        </div>
                        <div>
                            <h4 class="font-semibold">Email</h4>
                            <p class="text-gray-300">info@kosthonest.com</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="bg-red-600 rounded-full w-12 h-12 flex items-center justify-center text-xl mr-4">
                            📞
                        </div>
                        <div>
                            <h4 class="font-semibold">Telepon</h4>
                            <p class="text-gray-300">(021) 1234-5678</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="bg-red-600 rounded-full w-12 h-12 flex items-center justify-center text-xl mr-4">
                            📍
                        </div>
                        <div>
                            <h4 class="font-semibold">Alamat</h4>
                            <p class="text-gray-300">Jl. Contoh No. 123<br>Jakarta Selatan, DKI Jakarta</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="bg-red-600 rounded-full w-12 h-12 flex items-center justify-center text-xl mr-4">
                            🕐
                        </div>
                        <div>
                            <h4 class="font-semibold">Jam Operasional</h4>
                            <p class="text-gray-300">Senin - Minggu: 08:00 - 20:00</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- CTA -->
            <div class="bg-gradient-to-br from-red-600 to-red-800 rounded-2xl p-8">
                <h3 class="text-2xl font-bold mb-6">Mulai Pengalaman Kost Terbaik</h3>
                <p class="text-gray-100 mb-8">
                    Bergabunglah dengan ratusan penghuni yang telah merasakan kenyamanan tinggal di Kost Honest.
                </p>
                <div class="space-y-4">
                    <a href="{{ route('login') }}" class="block w-full bg-yellow-400 text-gray-900 text-center px-6 py-3 rounded-lg font-bold hover:bg-yellow-500 transition duration-300">
                        Login Sekarang
                    </a>
                    <a href="#" class="block w-full border-2 border-white text-white text-center px-6 py-3 rounded-lg font-bold hover:bg-white hover:text-red-600 transition duration-300">
                        WhatsApp Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection