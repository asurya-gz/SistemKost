@extends('layouts.admin')

@section('title', 'Edit Tipe Kamar - Admin Dashboard')

@section('page-title', 'Edit Tipe Kamar')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-semibold text-gray-900">Edit Tipe Kamar</h3>
        <a href="{{ route('admin.type-kamar.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
            Kembali
        </a>
    </div>
    
    <form action="{{ route('admin.type-kamar.update', $typeKamar->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Tipe Kamar</label>
                    <input type="text" 
                           id="nama" 
                           name="nama" 
                           value="{{ old('nama', $typeKamar->nama) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                           required>
                    @error('nama')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea id="deskripsi" 
                              name="deskripsi" 
                              rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                              required>{{ old('deskripsi', $typeKamar->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="ukuran_kamar" class="block text-sm font-medium text-gray-700 mb-2">Ukuran Kamar</label>
                        <input type="text" 
                               id="ukuran_kamar" 
                               name="ukuran_kamar" 
                               value="{{ old('ukuran_kamar', $typeKamar->ukuran_kamar) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                               placeholder="contoh: 3x4 m"
                               required>
                        @error('ukuran_kamar')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="type_kasur" class="block text-sm font-medium text-gray-700 mb-2">Tipe Kasur</label>
                        <select id="type_kasur" 
                                name="type_kasur" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                required>
                            <option value="">Pilih Tipe Kasur</option>
                            <option value="Single Bed" {{ old('type_kasur', $typeKamar->type_kasur) == 'Single Bed' ? 'selected' : '' }}>Single Bed</option>
                            <option value="Double Bed" {{ old('type_kasur', $typeKamar->type_kasur) == 'Double Bed' ? 'selected' : '' }}>Double Bed</option>
                            <option value="Queen Bed" {{ old('type_kasur', $typeKamar->type_kasur) == 'Queen Bed' ? 'selected' : '' }}>Queen Bed</option>
                            <option value="King Bed" {{ old('type_kasur', $typeKamar->type_kasur) == 'King Bed' ? 'selected' : '' }}>King Bed</option>
                        </select>
                        @error('type_kasur')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div>
                    <label for="harga" class="block text-sm font-medium text-gray-700 mb-2">Harga per Bulan (Rp)</label>
                    <input type="number" 
                           id="harga" 
                           name="harga" 
                           value="{{ old('harga', $typeKamar->harga) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                           min="0"
                           step="1000"
                           required>
                    @error('harga')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">Gambar Kamar</label>
                    <input type="file" 
                           id="gambar" 
                           name="gambar[]" 
                           multiple
                           accept="image/*"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    <p class="mt-1 text-sm text-gray-500">Pilih beberapa gambar (opsional, kosongkan jika tidak ingin mengubah)</p>
                    @error('gambar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    
                    @if($typeKamar->gambarTypeKamar && count($typeKamar->gambarTypeKamar) > 0)
                    <div class="mt-2">
                        <p class="text-sm text-gray-600 mb-2">Gambar saat ini:</p>
                        <div class="grid grid-cols-3 gap-2">
                            @foreach($typeKamar->gambarTypeKamar as $gambar)
                            <img src="{{ $gambar->url }}" 
                                 alt="{{ $gambar->alt_text ?? 'Gambar Type Kamar' }}" 
                                 class="w-full h-16 object-cover rounded border">
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            
            <div class="space-y-4">
                <div>
                    <label for="fasilitas_kost" class="block text-sm font-medium text-gray-700 mb-2">Fasilitas Kost</label>
                    <textarea id="fasilitas_kost" 
                              name="fasilitas_kost" 
                              rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                              placeholder="Pisahkan setiap fasilitas dengan baris baru">{{ old('fasilitas_kost', is_array($typeKamar->fasilitas_kost) ? implode("\n", $typeKamar->fasilitas_kost) : '') }}</textarea>
                    <p class="mt-1 text-sm text-gray-500">Tulis satu fasilitas per baris</p>
                    @error('fasilitas_kost')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="fasilitas_kamar" class="block text-sm font-medium text-gray-700 mb-2">Fasilitas Kamar</label>
                    <textarea id="fasilitas_kamar" 
                              name="fasilitas_kamar" 
                              rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                              placeholder="Pisahkan setiap fasilitas dengan baris baru">{{ old('fasilitas_kamar', is_array($typeKamar->fasilitas_kamar) ? implode("\n", $typeKamar->fasilitas_kamar) : '') }}</textarea>
                    <p class="mt-1 text-sm text-gray-500">Tulis satu fasilitas per baris</p>
                    @error('fasilitas_kamar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        
        <div class="mt-6 pt-6 border-t border-gray-200">
            <div class="flex space-x-3">
                <button type="submit" 
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-colors flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update Tipe Kamar
                </button>
                <a href="{{ route('admin.type-kamar.show', $typeKamar->id) }}" 
                   class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
                    Batal
                </a>
            </div>
        </div>
    </form>
</div>
@endsection