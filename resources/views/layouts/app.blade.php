<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Kost Honest - Hunian Nyaman dan Terpercaya')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo/logo.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-inter bg-white">
    <!-- Navigation -->
    <nav class="bg-white shadow-md fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3">
                        <!-- Logo Icon -->
                        <div class="rounded-lg p-2 shadow-lg">
                            <img src="{{ asset('images/logo/logo.png') }}" alt="Kost Honest Logo" class="w-8 h-8 object-contain">
                        </div>
                        <!-- Logo Text -->
                        <span class="text-2xl font-bold text-red-600">Kost Honest</span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('home') }}" class="text-gray-800 hover:text-red-600 font-medium transition duration-300">
                        Beranda
                    </a>
                    <a href="#gallery" class="text-gray-800 hover:text-red-600 font-medium transition duration-300">
                        Galeri
                    </a>
                    <a href="#type-kamar" class="text-gray-800 hover:text-red-600 font-medium transition duration-300">
                        Type Kamar
                    </a>
                    <a href="#fasilitas" class="text-gray-800 hover:text-red-600 font-medium transition duration-300">
                        Fasilitas
                    </a>
                    <a href="#tentang" class="text-gray-800 hover:text-red-600 font-medium transition duration-300">
                        Tentang
                    </a>
                    <a href="#kontak" class="text-gray-800 hover:text-red-600 font-medium transition duration-300">
                        Kontak
                    </a>
                    <a href="{{ route('login') }}" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 font-semibold transition duration-300 shadow-lg">
                        Login
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button type="button" class="mobile-menu-button text-gray-800 hover:text-red-600 focus:outline-none focus:text-red-600">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Navigation -->
            <div class="mobile-menu hidden md:hidden">
                <div class="px-2 pt-2 pb-3 space-y-1 bg-white border-t border-gray-200">
                    <a href="{{ route('home') }}" class="block px-3 py-2 text-gray-800 hover:text-red-600 font-medium">
                        Beranda
                    </a>
                    <a href="#gallery" class="block px-3 py-2 text-gray-800 hover:text-red-600 font-medium">
                        Galeri
                    </a>
                    <a href="#type-kamar" class="block px-3 py-2 text-gray-800 hover:text-red-600 font-medium">
                        Type Kamar
                    </a>
                    <a href="#fasilitas" class="block px-3 py-2 text-gray-800 hover:text-red-600 font-medium">
                        Fasilitas
                    </a>
                    <a href="#tentang" class="block px-3 py-2 text-gray-800 hover:text-red-600 font-medium">
                        Tentang
                    </a>
                    <a href="#kontak" class="block px-3 py-2 text-gray-800 hover:text-red-600 font-medium">
                        Kontak
                    </a>
                    <a href="{{ route('login') }}" class="block px-3 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-semibold mt-2 text-center shadow-lg transition duration-300">
                        Login
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-16">
        @yield('content')
    </main>




    <script>
        // Mobile menu toggle
        document.querySelector('.mobile-menu-button').addEventListener('click', function() {
            document.querySelector('.mobile-menu').classList.toggle('hidden');
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Carousel functionality
        document.addEventListener('DOMContentLoaded', function() {
            const track = document.querySelector('.carousel-track');
            const slides = document.querySelectorAll('.carousel-slide');
            const nextButton = document.querySelector('.carousel-next');
            const prevButton = document.querySelector('.carousel-prev');
            const dots = document.querySelectorAll('.carousel-dot');
            
            if (!track) return; // Exit if carousel doesn't exist
            
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
            nextButton.addEventListener('click', nextSlide);
            prevButton.addEventListener('click', prevSlide);

            // Dot navigation
            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    currentSlide = index;
                    updateCarousel();
                });
            });

            // Auto-slide every 5 seconds
            setInterval(nextSlide, 5000);
        });

    </script>
</body>
</html>