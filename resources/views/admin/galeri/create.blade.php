@extends('layouts.admin')

@section('title', 'Upload Foto - Admin Dashboard')

@section('page-title', 'Upload Foto')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-semibold text-gray-900">Upload Foto ke Galeri</h3>
        <a href="{{ route('admin.galeri.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
            Kembali
        </a>
    </div>
    
    <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="space-y-6">
                <div>
                    <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">Judul Foto *</label>
                    <input type="text" 
                           id="judul" 
                           name="judul" 
                           value="{{ old('judul') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                           placeholder="Masukkan nama foto"
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
                              placeholder="Deskripsi foto (opsional)">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Metode Upload *</label>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <input id="upload-file" name="upload_method" type="radio" value="file" class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300" {{ old('upload_method', 'file') === 'file' ? 'checked' : '' }}>
                            <label for="upload-file" class="ml-3 text-sm font-medium text-gray-700">Upload File Gambar</label>
                        </div>
                        <div class="flex items-center">
                            <input id="upload-url" name="upload_method" type="radio" value="url" class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300" {{ old('upload_method') === 'url' ? 'checked' : '' }}>
                            <label for="upload-url" class="ml-3 text-sm font-medium text-gray-700">Gunakan URL Gambar</label>
                        </div>
                    </div>
                    @error('upload_method')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div id="file-upload" class="upload-method">
                    <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">Upload Foto *</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 transition-colors">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label for="foto" class="relative cursor-pointer bg-white rounded-md font-medium text-red-600 hover:text-red-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-red-500">
                                    <span>Upload gambar</span>
                                    <input id="foto" name="foto" type="file" accept="image/*" class="sr-only" onchange="previewImage(event)">
                                </label>
                                <p class="pl-1">atau drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                        </div>
                    </div>
                    @error('foto')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div id="url-upload" class="upload-method hidden">
                    <label for="url_foto" class="block text-sm font-medium text-gray-700 mb-2">URL Foto *</label>
                    <input type="url" 
                           id="url_foto" 
                           name="url_foto" 
                           value="{{ old('url_foto') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                           placeholder="https://example.com/image.jpg"
                           onchange="previewUrl(this.value)">
                    <p class="mt-1 text-sm text-gray-500">Masukkan URL gambar dari internet</p>
                    @error('url_foto')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Preview Foto</label>
                <div id="preview-container" class="aspect-square overflow-hidden rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 flex items-center justify-center">
                    <div id="preview-placeholder" class="text-center">
                        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-gray-500">Preview foto akan muncul di sini</p>
                    </div>
                    <img id="image-preview" class="w-full h-full object-cover hidden" alt="Preview">
                </div>
            </div>
        </div>
        
        <div class="mt-8 pt-6 border-t border-gray-200">
            <div class="flex space-x-3">
                <button type="submit" 
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-colors flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    Upload Foto
                </button>
                <a href="{{ route('admin.galeri.index') }}" 
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
    
    // Initial toggle
    toggleUploadMethod();
});

function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            showPreview(e.target.result);
        };
        reader.readAsDataURL(file);
    }
}

function previewUrl(url) {
    if (url) {
        showPreview(url);
    } else {
        hidePreview();
    }
}

function showPreview(src) {
    const placeholder = document.getElementById('preview-placeholder');
    const preview = document.getElementById('image-preview');
    
    placeholder.classList.add('hidden');
    preview.src = src;
    preview.classList.remove('hidden');
}

function hidePreview() {
    const placeholder = document.getElementById('preview-placeholder');
    const preview = document.getElementById('image-preview');
    
    preview.classList.add('hidden');
    placeholder.classList.remove('hidden');
}
</script>
@endsection