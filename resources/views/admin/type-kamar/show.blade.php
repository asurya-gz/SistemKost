@extends('layouts.admin')

@section('title', 'Detail Tipe Kamar - Admin Dashboard')

@section('page-title', 'Detail Tipe Kamar')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-semibold text-gray-900">Detail Tipe Kamar</h3>
        <a href="{{ route('admin.type-kamar.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
            Kembali
        </a>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Tipe Kamar</label>
                <div class="bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 font-medium">
                    {{ $typeKamar->nama }}
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <div class="bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 min-h-[80px]">
                    {{ $typeKamar->deskripsi }}
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Ukuran Kamar</label>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg px-3 py-2">
                        {{ $typeKamar->ukuran_kamar }}
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Kasur</label>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg px-3 py-2">
                        {{ $typeKamar->type_kasur }}
                    </div>
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Harga per Bulan</label>
                <div class="bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 font-semibold text-green-600 text-lg">
                    Rp {{ number_format($typeKamar->harga, 0, ',', '.') }}
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Dibuat</label>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm">
                        {{ $typeKamar->created_at->format('d M Y H:i') }}
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Diupdate</label>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm">
                        {{ $typeKamar->updated_at->format('d M Y H:i') }}
                    </div>
                </div>
            </div>
        </div>
        
        <div class="space-y-6">
            @if($typeKamar->gambarTypeKamar && count($typeKamar->gambarTypeKamar) > 0)
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Gambar</label>
                <div class="grid grid-cols-2 gap-2">
                    @foreach($typeKamar->gambarTypeKamar as $gambar)
                    <img src="{{ $gambar->url }}" 
                         alt="{{ $gambar->alt_text ?? 'Gambar Type Kamar' }}" 
                         class="w-full h-24 object-cover rounded-lg border border-gray-200">
                    @endforeach
                </div>
            </div>
            @endif
            
            @if($typeKamar->fasilitasKostRel && count($typeKamar->fasilitasKostRel) > 0)
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Fasilitas Kost</label>
                <div class="bg-gray-50 border border-gray-200 rounded-lg px-4 py-3">
                    <ul class="space-y-2">
                        @foreach($typeKamar->fasilitasKostRel as $fasilitas)
                        <li class="flex items-center text-sm text-gray-700">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-3 flex-shrink-0"></span>
                            <span class="font-medium">{{ $fasilitas->nama }}</span>
                            @if($fasilitas->deskripsi)
                            <span class="text-gray-500 ml-2">- {{ $fasilitas->deskripsi }}</span>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
            
            @if($typeKamar->fasilitasKamarRel && count($typeKamar->fasilitasKamarRel) > 0)
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Fasilitas Kamar</label>
                <div class="bg-gray-50 border border-gray-200 rounded-lg px-4 py-3">
                    <ul class="space-y-2">
                        @foreach($typeKamar->fasilitasKamarRel as $fasilitas)
                        <li class="flex items-center text-sm text-gray-700">
                            <span class="w-2 h-2 bg-blue-500 rounded-full mr-3 flex-shrink-0"></span>
                            <span class="font-medium">{{ $fasilitas->nama }}</span>
                            @if($fasilitas->deskripsi)
                            <span class="text-gray-500 ml-2">- {{ $fasilitas->deskripsi }}</span>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
        </div>
    </div>
    
    <div class="mt-6 pt-6 border-t border-gray-200">
        <div class="flex space-x-3">
            <a href="{{ route('admin.type-kamar.edit', $typeKamar->id) }}" 
               class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg transition-colors flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit Tipe Kamar
            </a>
        </div>
    </div>
</div>
@endsection