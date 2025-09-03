@extends('layouts.admin')

@section('title', 'Tambah User - Admin Dashboard')

@section('page-title', 'Tambah User')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="mb-6">
        <h3 class="text-lg font-semibold text-gray-900">Tambah User Baru</h3>
    </div>
    
    <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
        <div class="flex">
            <svg class="w-5 h-5 text-blue-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-blue-800">Password Default</h3>
                <p class="text-sm text-blue-700 mt-1">User baru akan dibuat dengan password default: <strong>honest123_</strong></p>
                <p class="text-xs text-blue-600 mt-1">User dapat mengubah password melalui menu edit profil setelah login</p>
            </div>
        </div>
    </div>
    
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                       placeholder="Masukkan nama lengkap"
                       required>
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="{{ old('email') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                       placeholder="contoh@email.com"
                       required>
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="md:col-span-2">
                <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Role *</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-center p-4 border border-gray-300 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                        <input id="role-admin" 
                               name="role" 
                               type="radio" 
                               value="admin" 
                               class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300"
                               {{ old('role') === 'admin' ? 'checked' : '' }}>
                        <label for="role-admin" class="ml-3 cursor-pointer">
                            <div class="text-sm font-medium text-gray-900">Administrator</div>
                            <div class="text-xs text-gray-500">Akses penuh ke semua fitur admin</div>
                        </label>
                    </div>
                    <div class="flex items-center p-4 border border-gray-300 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                        <input id="role-pengguna" 
                               name="role" 
                               type="radio" 
                               value="pengguna" 
                               class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300"
                               {{ old('role', 'pengguna') === 'pengguna' ? 'checked' : '' }}>
                        <label for="role-pengguna" class="ml-3 cursor-pointer">
                            <div class="text-sm font-medium text-gray-900">Pengguna</div>
                            <div class="text-xs text-gray-500">Akses terbatas untuk pengguna biasa</div>
                        </label>
                    </div>
                </div>
                @error('role')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <div class="mt-8 pt-6 border-t border-gray-200">
            <div class="flex space-x-3">
                <button type="submit" 
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-colors flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah User
                </button>
                <a href="{{ route('admin.users.index') }}" 
                   class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
                    Batal
                </a>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add click handlers for radio button containers
    const radioContainers = document.querySelectorAll('.cursor-pointer');
    radioContainers.forEach(container => {
        container.addEventListener('click', function(e) {
            if (e.target.type !== 'radio') {
                const radio = container.querySelector('input[type="radio"]');
                radio.checked = true;
            }
        });
    });
});
</script>
@endsection