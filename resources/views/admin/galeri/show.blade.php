@extends('layouts.admin')

@section('title', 'Detail Foto - Admin Dashboard')

@section('page-title', 'Detail Foto')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-semibold text-gray-900">Detail Foto Galeri</h3>
        <a href="{{ route('admin.galeri.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
            Kembali
        </a>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div>
            <div class="aspect-square overflow-hidden rounded-lg border border-gray-200">
                <img src="{{ str_starts_with($gallery->path, 'http') ? $gallery->path : asset('storage/' . $gallery->path) }}" 
                     alt="{{ $gallery->judul }}" 
                     class="w-full h-full object-cover"
                     onerror="this.src='{{ asset('images/placeholder.jpg') }}'; this.onerror=null;">
            </div>
        </div>
        
        <div class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Judul Foto</label>
                <div class="bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 font-medium">
                    {{ $gallery->judul }}
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <div class="bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 min-h-[100px]">
                    {{ $gallery->deskripsi ?: 'Tidak ada deskripsi' }}
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">URL Foto</label>
                <div class="bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm break-all">
                    {{ $gallery->path }}
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Dibuat</label>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm">
                        {{ $gallery->created_at->format('d M Y H:i') }}
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Diupdate</label>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm">
                        {{ $gallery->updated_at->format('d M Y H:i') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="mt-8 pt-6 border-t border-gray-200">
        <div class="flex space-x-3">
            <a href="{{ route('admin.galeri.edit', $gallery->id) }}" 
               class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg transition-colors flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit Foto
            </a>
            <form action="{{ route('admin.galeri.destroy', $gallery->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-colors flex items-center"
                        onclick="return confirm('Yakin ingin menghapus foto ini?')">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Hapus Foto
                </button>
            </form>
        </div>
    </div>
</div>
@endsection