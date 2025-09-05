@extends('layouts.dashboard')

@section('title', 'Lengkapi Profil - Kost Honest')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50 to-indigo-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <div class="mx-auto h-12 w-12 text-red-600">
                <svg fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                </svg>
            </div>
            <h2 class="mt-6 text-3xl font-extrabold text-gray-900">Lengkapi Profil Anda</h2>
            <p class="mt-2 text-sm text-gray-600">
                Silakan lengkapi profil Anda untuk dapat mengakses dashboard dan fitur-fitur lainnya.
            </p>
        </div>

        <div class="bg-white shadow-xl rounded-lg px-6 py-8">
            @if(session('login_success'))
            <div class="bg-blue-50 border border-blue-200 rounded-md p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-blue-700">{{ session('login_success') }}</p>
                    </div>
                </div>
            </div>
            @endif

            @if(session('warning'))
            <div class="bg-yellow-50 border border-yellow-200 rounded-md p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-700">{{ session('warning') }}</p>
                    </div>
                </div>
            </div>
            @endif

            @if($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-md p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan:</h3>
                        <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif

            <form action="{{ route('profile.complete') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <!-- NIK -->
                <div>
                    <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                    <input type="text" 
                           id="nik" 
                           name="nik" 
                           maxlength="16" 
                           value="{{ old('nik') }}"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-red-500 focus:border-red-500 @error('nik') border-red-500 @enderror" 
                           placeholder="Masukkan 16 digit NIK">
                    @error('nik')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Address -->
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                    <textarea id="address" 
                              name="address" 
                              rows="3" 
                              class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-red-500 focus:border-red-500 @error('address') border-red-500 @enderror"
                              placeholder="Masukkan alamat lengkap Anda">{{ old('address') }}</textarea>
                    @error('address')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Gender -->
                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                    <select id="gender" 
                            name="gender" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 @error('gender') border-red-500 @enderror">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('gender')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- KTP File -->
                <div>
                    <label for="ktp_file" class="block text-sm font-medium text-gray-700">Upload Foto KTP</label>
                    @if($errors->has('ktp_file'))
                    <div class="mt-2 mb-3 bg-yellow-50 border border-yellow-200 rounded-md p-3">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700">
                                    <strong>Perhatian:</strong> File yang sudah Anda pilih akan hilang saat ada error validasi. 
                                    Silakan pilih ulang file KTP Anda.
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md @error('ktp_file') border-red-500 @enderror">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label for="ktp_file" class="relative cursor-pointer bg-white rounded-md font-medium text-red-600 hover:text-red-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-red-500">
                                    <span>Upload file</span>
                                    <input id="ktp_file" name="ktp_file" type="file" accept="image/*" class="sr-only">
                                </label>
                                <p class="pl-1">atau drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, JPEG maksimal 2MB</p>
                        </div>
                    </div>
                    @error('ktp_file')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="confirmLogout()"
                            class="inline-flex items-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Logout
                    </button>
                    <button type="submit" class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Simpan Profil
                    </button>
                </div>
            </form>

            <!-- Separate Logout Form -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</div>

<!-- Include Custom Alert and Modal Components -->
@include('components.alert')
@include('components.modal')

<script>
// Logout confirmation with custom modal
function confirmLogout() {
    showAlert({
        title: 'Konfirmasi Logout',
        message: 'Apakah Anda yakin ingin logout? Data yang belum disimpan akan hilang.',
        type: 'warning',
        confirmText: 'Logout',
        cancelText: 'Batal',
        onConfirm: function() {
            document.getElementById('logout-form').submit();
        }
    });
}

// Global functions for file upload actions
window.resetFileUpload = function() {
    const fileInput = document.getElementById('ktp_file');
    if (fileInput) {
        fileInput.value = '';
        fileInput.click();
    }
};

window.cancelFileUpload = function() {
    const fileInput = document.getElementById('ktp_file');
    const uploadArea = document.querySelector('.border-dashed');
    const textArea = uploadArea.querySelector('.space-y-1');
    
    // Clear the file input
    fileInput.value = '';
    
    // Reset to default state
    textArea.innerHTML = `
        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <div class="flex text-sm text-gray-600">
            <label for="ktp_file" class="relative cursor-pointer bg-white rounded-md font-medium text-red-600 hover:text-red-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-red-500">
                <span>Upload file</span>
                <input id="ktp_file" name="ktp_file" type="file" accept="image/*" class="sr-only">
            </label>
            <p class="pl-1">atau drag and drop</p>
        </div>
        <p class="text-xs text-gray-500">PNG, JPG, JPEG maksimal 2MB</p>
    `;
    
    // Reset border styling
    uploadArea.classList.remove('border-red-500', 'border-green-300');
    uploadArea.classList.add('border-gray-300');
    
    // Re-bind event listener
    bindFileUploadEvent();
};

// Function to bind file upload event
function bindFileUploadEvent() {
    const fileInput = document.getElementById('ktp_file');
    if (fileInput) {
        // Remove existing event listeners
        fileInput.removeEventListener('change', handleFileUpload);
        // Add new event listener
        fileInput.addEventListener('change', handleFileUpload);
    }
}

// File upload handler
function handleFileUpload(e) {
    const file = e.target.files[0];
    const uploadArea = e.target.closest('.border-dashed');
    const textArea = uploadArea.querySelector('.space-y-1');
    
    if (file) {
        const fileName = file.name;
        const fileSize = (file.size / 1024 / 1024).toFixed(2);
        const maxSize = 2; // 2MB
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        
        // Check file size
        if (file.size > maxSize * 1024 * 1024) {
            textArea.innerHTML = `
                <svg class="mx-auto h-12 w-12 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                <div class="text-sm text-red-600 mb-4">
                    <p class="font-medium">File terlalu besar!</p>
                    <p>Maksimal 2MB. File Anda: ${fileSize} MB</p>
                </div>
                <div class="flex justify-center space-x-3">
                    <button type="button" onclick="resetFileUpload()" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-md transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Pilih File Lain
                    </button>
                    <button type="button" onclick="cancelFileUpload()" class="inline-flex items-center px-4 py-2 bg-red-100 hover:bg-red-200 text-red-700 text-sm font-medium rounded-md transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Batal
                    </button>
                </div>
            `;
            uploadArea.classList.add('border-red-500');
            uploadArea.classList.remove('border-gray-300');
            return;
        }
        
        // Check file type
        if (!allowedTypes.includes(file.type)) {
            textArea.innerHTML = `
                <svg class="mx-auto h-12 w-12 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                <div class="text-sm text-red-600 mb-4">
                    <p class="font-medium">Format file tidak valid!</p>
                    <p>Hanya JPG, JPEG, atau PNG yang diizinkan</p>
                    <p class="text-xs mt-1">File Anda: ${file.type || 'Unknown'}</p>
                </div>
                <div class="flex justify-center space-x-3">
                    <button type="button" onclick="resetFileUpload()" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-md transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Pilih File Lain
                    </button>
                    <button type="button" onclick="cancelFileUpload()" class="inline-flex items-center px-4 py-2 bg-red-100 hover:bg-red-200 text-red-700 text-sm font-medium rounded-md transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Batal
                    </button>
                </div>
            `;
            uploadArea.classList.add('border-red-500');
            uploadArea.classList.remove('border-gray-300');
            return;
        }
        
        // File is valid
        textArea.innerHTML = `
            <svg class="mx-auto h-12 w-12 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div class="text-sm text-gray-900 mb-3">
                <p class="font-medium text-green-600">${fileName}</p>
                <p class="text-gray-500">${fileSize} MB - Siap diupload!</p>
            </div>
            <button type="button" onclick="cancelFileUpload()" class="inline-flex items-center px-3 py-1 bg-gray-100 hover:bg-gray-200 text-gray-600 text-xs rounded transition-colors">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Ganti File
            </button>
        `;
        uploadArea.classList.remove('border-red-500');
        uploadArea.classList.add('border-green-300');
    }
}

// NIK validation - only numbers
document.getElementById('nik').addEventListener('input', function(e) {
    this.value = this.value.replace(/[^0-9]/g, '');
});

// Initialize file upload binding on page load
bindFileUploadEvent();
</script>
@endsection