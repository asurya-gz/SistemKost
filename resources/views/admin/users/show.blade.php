@extends('layouts.admin')

@section('title', 'Detail User - Admin Dashboard')

@section('page-title', 'Detail User')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="mb-6">
        <h3 class="text-lg font-semibold text-gray-900">Detail User</h3>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Informasi Akun -->
        <div class="space-y-6">
            <h4 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">Informasi Akun</h4>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama User</label>
                <div class="bg-gray-50 border border-gray-200 rounded-lg px-3 py-2">
                    {{ $user->name }}
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <div class="bg-gray-50 border border-gray-200 rounded-lg px-3 py-2">
                    {{ $user->email }}
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                <div class="bg-gray-50 border border-gray-200 rounded-lg px-3 py-2">
                    <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                        {{ ucfirst($user->role) }}
                    </span>
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status Profil</label>
                <div class="bg-gray-50 border border-gray-200 rounded-lg px-3 py-2">
                    @if($user->profile && $user->profile->is_profile_completed)
                        <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                            ✓ Profil Lengkap
                        </span>
                    @else
                        <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">
                            ⚠ Profil Belum Lengkap
                        </span>
                    @endif
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Dibuat</label>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm">
                        {{ $user->created_at->format('d M Y H:i') }}
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Terakhir Diupdate</label>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm">
                        {{ $user->updated_at->format('d M Y H:i') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Informasi Profil -->
        <div class="space-y-6">
            <h4 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">Informasi Profil</h4>
            
            @if($user->profile)
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">NIK</label>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg px-3 py-2">
                        {{ $user->profile->nik ?: 'Belum diisi' }}
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg px-3 py-2">
                        @if($user->profile->gender)
                            <span class="px-2 py-1 text-xs font-medium {{ $user->profile->gender === 'L' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }} rounded-full">
                                {{ $user->profile->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </span>
                        @else
                            Belum diisi
                        @endif
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 min-h-[60px]">
                        {{ $user->profile->address ?: 'Belum diisi' }}
                    </div>
                </div>
                
                @if($user->profile->ktp_file)
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">File KTP</label>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg px-3 py-2">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">File KTP tersedia</span>
                            <a href="{{ asset('storage/' . $user->profile->ktp_file) }}" 
                               target="_blank"
                               class="text-blue-600 hover:text-blue-900 text-sm font-medium">
                                Lihat File
                            </a>
                        </div>
                    </div>
                </div>
                @endif
                
                @if($user->profile->created_at)
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Profil Dibuat</label>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm">
                        {{ $user->profile->created_at->format('d M Y H:i') }}
                    </div>
                </div>
                @endif
            @else
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <div class="flex">
                        <svg class="w-5 h-5 text-yellow-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-yellow-800">Profil Belum Dibuat</h3>
                            <p class="text-sm text-yellow-700 mt-1">User belum membuat profil. Profil akan dibuat otomatis saat user pertama kali login.</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    
    <div class="mt-6 pt-6 border-t border-gray-200">
    </div>
</div>
@endsection