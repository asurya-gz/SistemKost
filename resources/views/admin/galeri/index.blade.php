@extends('layouts.admin')

@section('title', 'Galeri - Admin Dashboard')

@section('page-title', 'Galeri')

@push('styles')
<style>
    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-semibold text-gray-900">Galeri Kost</h3>
        <a href="{{ route('admin.galeri.create') }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-colors">
            Upload Foto
        </a>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($galleries as $gallery)
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden group hover:shadow-lg transition-all duration-300 flex flex-col h-full">
            <!-- Image Container -->
            <div class="relative h-48 bg-gray-100 overflow-hidden">
                @if($gallery->path)
                    <img src="{{ $gallery->url }}" 
                         alt="{{ $gallery->alt_text }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                    <!-- Fallback placeholder -->
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white" style="display: none;">
                        <div class="text-center">
                            <svg class="w-12 h-12 mx-auto mb-2 text-white opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-sm opacity-90">{{ Str::limit($gallery->judul, 20) }}</p>
                        </div>
                    </div>
                @else
                    <div class="w-full h-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white">
                        <div class="text-center">
                            <svg class="w-12 h-12 mx-auto mb-2 text-white opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-sm opacity-90">{{ Str::limit($gallery->judul, 20) }}</p>
                        </div>
                    </div>
                @endif
            </div>
            
            <!-- Content Container with flex-grow to push actions to bottom -->
            <div class="p-4 flex flex-col flex-grow">
                <div class="flex-grow">
                    <h4 class="font-semibold text-gray-900 mb-2 text-base leading-tight line-clamp-1">{{ $gallery->judul }}</h4>
                    @if($gallery->deskripsi)
                    <p class="text-sm text-gray-600 mb-3 leading-relaxed line-clamp-3">
                        {{ $gallery->deskripsi }}
                    </p>
                    @else
                    <p class="text-sm text-gray-400 mb-3 italic">Tidak ada deskripsi</p>
                    @endif
                </div>
                
                <!-- Actions Container - always at bottom -->
                <div class="flex justify-between items-center pt-3 border-t border-gray-100">
                    <div class="flex space-x-1">
                        <a href="{{ route('admin.galeri.show', $gallery->id) }}" 
                           class="inline-flex items-center justify-center w-8 h-8 text-blue-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition-all duration-200" 
                           title="Lihat Detail">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </a>
                        <a href="{{ route('admin.galeri.edit', $gallery->id) }}" 
                           class="inline-flex items-center justify-center w-8 h-8 text-amber-600 hover:text-amber-700 hover:bg-amber-50 rounded-lg transition-all duration-200" 
                           title="Edit Foto">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </a>
                        <form action="{{ route('admin.galeri.destroy', $gallery->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="inline-flex items-center justify-center w-8 h-8 text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg transition-all duration-200"
                                    title="Hapus Foto"
                                    onclick="return confirm('Yakin ingin menghapus foto ini?')">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                    <div class="text-xs text-gray-500 bg-gray-50 px-2 py-1 rounded-md">
                        {{ $gallery->created_at->format('d M Y') }}
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12 text-gray-500">
            <svg class="w-12 h-12 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <p class="text-lg font-medium mb-2">Belum ada foto di galeri</p>
            <p class="text-sm">Upload foto pertama untuk memulai galeri kost Anda</p>
        </div>
        @endforelse
    </div>
</div>
@endsection