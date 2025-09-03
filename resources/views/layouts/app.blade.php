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

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Logo & Description -->
                <div>
                    <h3 class="text-2xl font-bold text-red-400 mb-4">Kost Honest</h3>
                    <p class="text-gray-300 mb-4">
                        Hunian kost yang nyaman, aman, dan terpercaya dengan fasilitas lengkap untuk kehidupan sehari-hari Anda.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#gallery" class="text-gray-300 hover:text-red-400 transition duration-300">Galeri</a></li>
                        <li><a href="#type-kamar" class="text-gray-300 hover:text-red-400 transition duration-300">Type Kamar</a></li>
                        <li><a href="#fasilitas" class="text-gray-300 hover:text-red-400 transition duration-300">Fasilitas</a></li>
                        <li><a href="#tentang" class="text-gray-300 hover:text-red-400 transition duration-300">Tentang Kami</a></li>
                        <li><a href="#kontak" class="text-gray-300 hover:text-red-400 transition duration-300">Kontak</a></li>
                        <li><a href="{{ route('login') }}" class="text-gray-300 hover:text-red-400 transition duration-300">Login</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Kontak Kami</h4>
                    <div class="space-y-2 text-gray-300">
                        <p>📞 081325851480</p>
                        <p>📍 WCQH+V9C, Pedalangan, Kec. Banyumanik, Kota Semarang, Jawa Tengah 50268</p>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center">
                <p class="text-gray-400">© {{ date('Y') }} Kost Honest. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Floating WhatsApp Button -->
    <div class="fixed bottom-6 right-6 z-50">
        <!-- Bubble Tooltip -->
        <div id="whatsapp-bubble" class="absolute bottom-20 right-0 mb-2 hidden">
            <div class="bg-white rounded-xl shadow-2xl border border-gray-200 p-4 max-w-sm relative">
                <div class="absolute bottom-0 right-6 w-0 h-0 border-l-[8px] border-l-transparent border-r-[8px] border-r-transparent border-t-[8px] border-t-white transform translate-y-full"></div>
                <div class="flex items-start space-x-3">
                    <div class="bg-green-100 rounded-full p-2 flex-shrink-0">
                        <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.097"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-gray-900 text-sm mb-1">Butuh Bantuan?</h4>
                        <p class="text-gray-600 text-sm">Ingin konsultasi langsung dengan kami? Klik untuk chat via WhatsApp!</p>
                    </div>
                    <button id="close-bubble" class="text-gray-400 hover:text-gray-600 flex-shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- WhatsApp Button -->
        <button id="whatsapp-btn" class="bg-green-500 hover:bg-green-600 text-white rounded-full p-4 shadow-2xl transform hover:scale-110 transition-all duration-300 group">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.097"/>
            </svg>
            <!-- Pulse animation -->
            <span class="absolute top-0 left-0 h-full w-full rounded-full bg-green-400 opacity-75 animate-ping"></span>
        </button>
    </div>

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

        // WhatsApp Floating Button Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const whatsappBtn = document.getElementById('whatsapp-btn');
            const whatsappBubble = document.getElementById('whatsapp-bubble');
            const closeBubble = document.getElementById('close-bubble');
            let bubbleTimer;
            let bubbleShown = false;

            // Show bubble after 3 seconds on page load
            setTimeout(function() {
                if (!bubbleShown) {
                    showBubble();
                }
            }, 3000);

            // Show bubble on hover
            whatsappBtn.addEventListener('mouseenter', function() {
                clearTimeout(bubbleTimer);
                showBubble();
            });

            // Hide bubble on mouse leave with delay
            whatsappBtn.addEventListener('mouseleave', function() {
                bubbleTimer = setTimeout(hideBubble, 2000);
            });

            // Keep bubble visible when hovering over it
            whatsappBubble.addEventListener('mouseenter', function() {
                clearTimeout(bubbleTimer);
            });

            whatsappBubble.addEventListener('mouseleave', function() {
                bubbleTimer = setTimeout(hideBubble, 1000);
            });

            // Close bubble when clicking X
            closeBubble.addEventListener('click', function() {
                hideBubble();
                bubbleShown = true; // Don't show auto bubble again
            });

            // WhatsApp redirect
            whatsappBtn.addEventListener('click', function() {
                const phoneNumber = '628123456789'; // Ganti dengan nomor WhatsApp yang sebenarnya
                const message = encodeURIComponent('Halo! Saya tertarik dengan kost Honest. Bisakah saya mendapatkan informasi lebih lanjut?');
                const whatsappUrl = `https://wa.me/${phoneNumber}?text=${message}`;
                window.open(whatsappUrl, '_blank');
            });

            function showBubble() {
                whatsappBubble.classList.remove('hidden');
                whatsappBubble.classList.add('animate-pulse');
                setTimeout(function() {
                    whatsappBubble.classList.remove('animate-pulse');
                }, 1000);
            }

            function hideBubble() {
                whatsappBubble.classList.add('hidden');
            }
        });
    </script>
</body>
</html>