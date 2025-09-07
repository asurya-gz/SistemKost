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

            <form action="{{ route('profile.complete') }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="profile-form">
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
                    <div class="mt-2 mb-3 bg-red-50 border border-red-200 rounded-md p-3">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan:</h3>
                                <p class="text-sm text-red-700">{{ $errors->first('ktp_file') }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="mt-1">
                        <input type="file" 
                               id="ktp_file" 
                               name="ktp_file" 
                               accept="image/jpeg,image/jpg,image/png" 
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 @error('ktp_file') border-red-500 @enderror"
                               required>
                        <p class="mt-1 text-xs text-gray-500">Format: JPG, JPEG, PNG. Maksimal 2MB</p>
                        <div id="file-info" class="mt-2 text-sm text-green-600 hidden"></div>
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
                    <button type="submit" class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" onclick="validateForm(event)">
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

// Simple file upload handler
function handleFileUpload() {
    const fileInput = document.getElementById('ktp_file');
    const fileInfo = document.getElementById('file-info');
    
    if (fileInput.files.length > 0) {
        const file = fileInput.files[0];
        const fileName = file.name;
        const fileSize = (file.size / 1024 / 1024).toFixed(2);
        const maxSize = 2; // 2MB
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        
        // Check file size
        if (file.size > maxSize * 1024 * 1024) {
            fileInfo.className = 'mt-2 text-sm text-red-600';
            fileInfo.textContent = `File terlalu besar! Maksimal 2MB. File Anda: ${fileSize} MB`;
            fileInfo.classList.remove('hidden');
            fileInput.value = ''; // Clear invalid file
            return;
        }
        
        // Check file type
        if (!allowedTypes.includes(file.type)) {
            fileInfo.className = 'mt-2 text-sm text-red-600';
            fileInfo.textContent = `Format file tidak valid! Hanya JPG, JPEG, atau PNG yang diizinkan.`;
            fileInfo.classList.remove('hidden');
            fileInput.value = ''; // Clear invalid file
            return;
        }
        
        // File is valid
        fileInfo.className = 'mt-2 text-sm text-green-600';
        fileInfo.textContent = `✓ ${fileName} (${fileSize} MB) - Siap diupload!`;
        fileInfo.classList.remove('hidden');
    } else {
        fileInfo.classList.add('hidden');
    }
}

// NIK validation - only numbers
document.getElementById('nik').addEventListener('input', function(e) {
    this.value = this.value.replace(/[^0-9]/g, '');
});

// Add file input event listener
document.getElementById('ktp_file').addEventListener('change', handleFileUpload);

// Form validation before submit
function validateForm(e) {
    const fileInput = document.getElementById('ktp_file');
    const nikInput = document.getElementById('nik');
    const addressInput = document.getElementById('address');
    const genderInput = document.getElementById('gender');
    
    console.log('Form validation:', {
        hasFile: fileInput.files.length > 0,
        fileName: fileInput.files[0]?.name || 'No file',
        nik: nikInput.value,
        address: addressInput.value,
        gender: genderInput.value
    });
    
    if (!fileInput.files.length) {
        e.preventDefault();
        alert('Harap pilih file KTP terlebih dahulu!');
        return false;
    }
    
    if (!nikInput.value || nikInput.value.length !== 16) {
        e.preventDefault();
        alert('NIK harus 16 digit!');
        return false;
    }
    
    if (!addressInput.value.trim()) {
        e.preventDefault();
        alert('Alamat harus diisi!');
        return false;
    }
    
    if (!genderInput.value) {
        e.preventDefault();
        alert('Pilih jenis kelamin!');
        return false;
    }
    
    console.log('Form validation passed, submitting...');
    return true;
}
</script>
@endsection