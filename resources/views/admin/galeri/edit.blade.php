@extends('layouts.admin')

@section('title', 'Edit Foto - Admin Dashboard')

@section('page-title', 'Edit Foto')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-semibold text-gray-900">Edit Foto Galeri</h3>
        <a href="{{ route('admin.galeri.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
            Kembali
        </a>
    </div>
    
    <form action="{{ route('admin.galeri.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="space-y-6">
                <div>
                    <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">Judul Foto</label>
                    <input type="text" 
                           id="judul" 
                           name="judul" 
                           value="{{ old('judul', $gallery->judul) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                           required>
                    @error('judul')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea id="deskripsi" 
                              name="deskripsi" 
                              rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                              placeholder="Deskripsi foto (opsional)">{{ old('deskripsi', $gallery->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Metode Upload</label>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <input id="upload-file" name="upload_method" type="radio" value="file" class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300" checked>
                            <label for="upload-file" class="ml-3 text-sm font-medium text-gray-700">Upload File Gambar</label>
                        </div>
                        <div class="flex items-center">
                            <input id="upload-url" name="upload_method" type="radio" value="url" class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300">
                            <label for="upload-url" class="ml-3 text-sm font-medium text-gray-700">Gunakan URL Gambar</label>
                        </div>
                    </div>
                </div>
                
                <div id="file-upload" class="upload-method">
                    <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">Upload Foto Baru</label>
                    <input type="file" 
                           id="foto" 
                           name="foto" 
                           accept="image/*"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    <p class="mt-1 text-sm text-gray-500">Format: JPG, PNG, GIF. Maksimal 2MB. Kosongkan jika tidak ingin mengubah foto.</p>
                    @error('foto')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div id="url-upload" class="upload-method hidden">
                    <label for="url_foto" class="block text-sm font-medium text-gray-700 mb-2">URL Foto</label>
                    <input type="url" 
                           id="url_foto" 
                           name="url_foto" 
                           value="{{ old('url_foto', str_starts_with($gallery->path, 'http') ? $gallery->path : '') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                           placeholder="https://example.com/image.jpg">
                    <p class="mt-1 text-sm text-gray-500">Masukkan URL gambar dari internet</p>
                    @error('url_foto')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Preview Foto Saat Ini</label>
                <div class="aspect-square overflow-hidden rounded-lg border border-gray-200 bg-gray-50">
                    <img src="{{ str_starts_with($gallery->path, 'http') ? $gallery->path : asset('storage/' . $gallery->path) }}" 
                         alt="{{ $gallery->nama }}" 
                         class="w-full h-full object-cover"
                         onerror="this.src='{{ asset('images/placeholder.jpg') }}'; this.onerror=null;">
                </div>
                <p class="mt-2 text-sm text-gray-500">Foto yang sedang digunakan</p>
            </div>
        </div>
        
        <div class="mt-8 pt-6 border-t border-gray-200">
            <div class="flex space-x-3">
                <button type="submit" 
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-colors flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update Foto
                </button>
                <a href="{{ route('admin.galeri.show', $gallery->id) }}" 
                   class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
                    Batal
                </a>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileRadio = document.getElementById('upload-file');
    const urlRadio = document.getElementById('upload-url');
    const fileUpload = document.getElementById('file-upload');
    const urlUpload = document.getElementById('url-upload');
    
    function toggleUploadMethod() {
        if (fileRadio.checked) {
            fileUpload.classList.remove('hidden');
            urlUpload.classList.add('hidden');
        } else {
            fileUpload.classList.add('hidden');
            urlUpload.classList.remove('hidden');
        }
    }
    
    fileRadio.addEventListener('change', toggleUploadMethod);
    urlRadio.addEventListener('change', toggleUploadMethod);
    
    // Set initial state based on current data
    if ('{{ str_starts_with($gallery->path, "http") }}') {
        urlRadio.checked = true;
        toggleUploadMethod();
    }
});
</script>
@endsection