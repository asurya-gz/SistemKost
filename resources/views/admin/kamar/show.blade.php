@extends('layouts.admin')

@section('title', 'Detail Kamar - Admin Dashboard')

@section('page-title', 'Detail Kamar')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-semibold text-gray-900">Detail Kamar {{ $kamar->nama_kamar }}</h3>
        <div class="flex space-x-2">
            <a href="{{ route('admin.kamar.edit', $kamar->id) }}" 
               class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg transition-colors">
                Edit Kamar
            </a>
            <a href="{{ route('admin.kamar.index') }}" 
               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
                Kembali
            </a>
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Informasi Dasar -->
        <div class="space-y-4">
            <div class="bg-gray-50 rounded-lg p-4">
                <h4 class="text-md font-semibold text-gray-800 mb-3">Informasi Kamar</h4>
                
                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Nama Kamar</label>
                        <p class="text-lg font-semibold text-gray-900">{{ $kamar->nama_kamar }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Tipe Kamar</label>
                        <p class="text-gray-900">{{ $kamar->typeKamar ? $kamar->typeKamar->nama : 'Belum ditentukan' }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Status</label>
                        <span class="inline-block px-3 py-1 text-sm font-medium rounded-full
                            @if($kamar->status_kamar == 'Tersedia') bg-green-100 text-green-800
                            @elseif($kamar->status_kamar == 'Booked') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800
                            @endif">
                            {{ $kamar->status_kamar }}
                        </span>
                    </div>
                    
                    @if($kamar->typeKamar)
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Harga per Bulan</label>
                        <p class="text-xl font-bold text-red-600">Rp {{ number_format($kamar->typeKamar->harga, 0, ',', '.') }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Detail Tipe Kamar -->
        @if($kamar->typeKamar)
        <div class="space-y-4">
            <div class="bg-gray-50 rounded-lg p-4">
                <h4 class="text-md font-semibold text-gray-800 mb-3">Detail Tipe Kamar</h4>
                
                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Deskripsi</label>
                        <p class="text-gray-900">{{ $kamar->typeKamar->deskripsi ?? '-' }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Ukuran Kamar</label>
                        <p class="text-gray-900">{{ $kamar->typeKamar->ukuran_kamar ?? '-' }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Tipe Kasur</label>
                        <p class="text-gray-900">{{ $kamar->typeKamar->type_kasur ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Kebijakan Kamar -->
    @if($kebijakanKamar && $kebijakanKamar->count() > 0)
    <div class="mt-6">
        <div class="bg-gray-50 rounded-lg p-4">
            <h4 class="text-md font-semibold text-gray-800 mb-3">Kebijakan Kamar</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                @foreach($kebijakanKamar as $kebijakan)
                <div class="flex items-start mb-2">
                    <svg class="w-4 h-4 text-green-600 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-sm text-gray-700">{{ $kebijakan->deskripsi }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Fasilitas -->
    @if($kamar->typeKamar && ($kamar->typeKamar->fasilitasKamarRel->count() > 0 || $kamar->typeKamar->fasilitasKostRel->count() > 0))
    <div class="mt-6">
        <div class="bg-gray-50 rounded-lg p-4">
            <h4 class="text-md font-semibold text-gray-800 mb-3">Fasilitas</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @if($kamar->typeKamar->fasilitasKamarRel->count() > 0)
                <div>
                    <h5 class="font-medium text-gray-700 mb-2">Fasilitas Kamar</h5>
                    <div class="space-y-1">
                        @foreach($kamar->typeKamar->fasilitasKamarRel as $fasilitas)
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-sm text-gray-700">{{ $fasilitas->nama }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                
                @if($kamar->typeKamar->fasilitasKostRel->count() > 0)
                <div>
                    <h5 class="font-medium text-gray-700 mb-2">Fasilitas Kost</h5>
                    <div class="space-y-1">
                        @foreach($kamar->typeKamar->fasilitasKostRel as $fasilitas)
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-purple-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-sm text-gray-700">{{ $fasilitas->nama }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endif

    <!-- Timestamps -->
    <div class="mt-6 pt-4 border-t border-gray-200">
        <div class="flex justify-between text-sm text-gray-500">
            <span>Dibuat: {{ $kamar->created_at->format('d F Y H:i') }}</span>
            <span>Diupdate: {{ $kamar->updated_at->format('d F Y H:i') }}</span>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 z-50 hidden items-center justify-center" onclick="closeImageModal()">
    <div class="max-w-4xl max-h-4xl p-4" onclick="event.stopPropagation()">
        <img id="modalImage" src="" alt="Foto kamar" class="max-w-full max-h-full rounded-lg">
    </div>
    <button onclick="closeImageModal()" class="absolute top-4 right-4 text-white hover:text-gray-300">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
</div>

<script>
function handleImageError(img, index) {
    console.error('Image failed to load:', img.src);
    
    // Hide loading indicator
    const loadingIndicator = document.querySelector('.loading-indicator[data-index="' + index + '"]');
    if (loadingIndicator) {
        loadingIndicator.style.display = 'none';
    }
    
    // Create placeholder SVG
    const placeholderSvg = `<svg width="400" height="300" viewBox="0 0 400 300" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect width="400" height="300" fill="#F8F9FA"/>
        <rect x="150" y="110" width="100" height="80" rx="8" fill="#E9ECEF" stroke="#DEE2E6" stroke-width="2"/>
        <circle cx="170" cy="130" r="8" fill="#ADB5BD"/>
        <polygon points="160,150 180,135 200,145 220,125 220,170 160,170" fill="#ADB5BD"/>
        <text x="200" y="210" fill="#6C757D" font-family="Arial" font-size="14" font-weight="500" text-anchor="middle">Foto Kamar</text>
        <text x="200" y="230" fill="#ADB5BD" font-family="Arial" font-size="12" text-anchor="middle">Tidak dapat dimuat</text>
    </svg>`;
    
    img.src = 'data:image/svg+xml;base64,' + btoa(placeholderSvg);
    img.onerror = null;
    img.onload = null;
    img.style.opacity = '1';
    img.style.cursor = 'default';
    img.onclick = null; // Remove click handler
}

function handleImageLoad(img) {
    console.log('Image loaded successfully:', img.src);
    
    // Hide loading indicator
    const index = img.getAttribute('data-index');
    const loadingIndicator = document.querySelector('.loading-indicator[data-index="' + index + '"]');
    if (loadingIndicator) {
        loadingIndicator.style.display = 'none';
    }
    
    // Show image with fade in
    img.style.opacity = '1';
}

function openImageModal(imageSrc) {
    // Skip if no valid image source
    if (!imageSrc || imageSrc === '#') {
        return;
    }
    
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    modalImage.src = imageSrc;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.classList.add('overflow-hidden');
}

function closeImageModal() {
    const modal = document.getElementById('imageModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.classList.remove('overflow-hidden');
}

// Close modal with Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeImageModal();
    }
});

// Simple image loading
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing images...');
    
    const images = document.querySelectorAll('img[data-index]');
    console.log('Found', images.length, 'images to load');
    
    images.forEach((img) => {
        console.log('Loading image:', img.src);
        
        // If image is already loaded (cached), show it immediately
        if (img.complete) {
            handleImageLoad(img);
        }
        
        // Set timeout to show placeholder if loading takes too long
        const timeoutId = setTimeout(function() {
            if (img.style.opacity !== '1') {
                console.log('Image timeout, showing placeholder');
                handleImageError(img, img.getAttribute('data-index'));
            }
        }, 3000);
        
        // Clear timeout when image loads/errors
        img.addEventListener('load', function() {
            clearTimeout(timeoutId);
        }, { once: true });
        
        img.addEventListener('error', function() {
            clearTimeout(timeoutId);
        }, { once: true });
    });
});
</script>
@endsection