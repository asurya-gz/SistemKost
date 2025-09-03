@extends('layouts.dashboard')

@section('title', $room['name'] . ' - Kost Honest')

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
                    <h1 class="text-3xl font-bold text-red-600">{{ $room['name'] }}</h1>
                    <p class="text-gray-600 mt-1">Detail kamar dan fasilitas lengkap</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Room Detail Hero -->
    <section class="py-8 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid lg:grid-cols-2 gap-12 items-start">
            <!-- Room Images Carousel -->
            <div class="relative">
                <div class="room-carousel-container overflow-hidden rounded-2xl shadow-2xl">
                    <div class="room-carousel-track flex transition-transform duration-500 ease-in-out">
                        @foreach($room['images'] as $index => $image)
                        <div class="room-carousel-slide min-w-full">
                            <img src="{{ $image }}" 
                                 alt="{{ $room['name'] }} - Image {{ $index + 1 }}" 
                                 class="w-full h-96 object-cover">
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
                <div class="flex justify-center mt-6 space-x-2">
                    @foreach($room['images'] as $index => $image)
                    <button class="room-carousel-dot w-3 h-3 {{ $index === 0 ? 'bg-red-600' : 'bg-gray-300 hover:bg-red-400' }} rounded-full transition duration-300" data-slide="{{ $index }}"></button>
                    @endforeach
                </div>
            </div>

            <!-- Room Information -->
            <div class="lg:pl-8">
                <!-- Room Title -->
                <div class="mb-8">
                    <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $room['name'] }}</h1>
                    <p class="text-lg text-gray-600 leading-relaxed">{{ $room['description'] }}</p>
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
                                <p class="font-semibold text-gray-900">{{ $room['size'] }}</p>
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
                                <p class="font-semibold text-gray-900">{{ $room['bed'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>
    </section>

    <!-- Room Facilities -->
    <section class="py-12 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
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
                    @foreach($room['fasilitas_kost'] ?? [] as $fasilitasKost)
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
                    @foreach($room['fasilitas_kamar'] ?? [] as $fasilitasKamar)
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
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Kebijakan Kamar</h2>
            <p class="text-xl text-gray-600">Aturan yang perlu dipatuhi untuk kenyamanan bersama</p>
        </div>

        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <div class="grid md:grid-cols-2 gap-6">
                    @foreach($kebijakan as $index => $item)
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center mr-4 mt-0.5 flex-shrink-0">
                            <span class="text-red-600 font-bold text-sm">{{ $index + 1 }}</span>
                        </div>
                        <div>
                            <p class="text-gray-900 text-sm leading-relaxed">{{ $item->deskripsi }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-12 bg-gradient-to-br from-red-600 to-red-800 text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold mb-4">Tertarik dengan {{ $room['name'] }}?</h2>
        <p class="text-xl mb-8 text-red-100">Dapatkan kamar impian Anda sekarang juga!</p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <button class="bg-white text-red-600 px-8 py-3 rounded-lg font-bold text-lg hover:bg-red-50 transition duration-300 shadow-lg">
                Booking Sekarang
            </button>
            <button class="border-2 border-white text-white px-8 py-3 rounded-lg font-bold text-lg hover:bg-white hover:text-red-600 transition duration-300">
                Hubungi Kami
            </button>
        </div>
        
        <div class="mt-8 text-center">
            <p class="text-red-200 mb-2">Harga mulai dari</p>
            <p class="text-4xl font-bold">Rp {{ number_format($room['price'], 0, ',', '.') }}</p>
            <p class="text-red-200">per bulan</p>
        </div>
    </section>
</div>

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
</script>
@endsection