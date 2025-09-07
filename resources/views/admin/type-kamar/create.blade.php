@extends('layouts.admin')

@section('title', 'Tambah Tipe Kamar - Admin Dashboard')

@section('page-title', 'Tambah Tipe Kamar')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-semibold text-gray-900">Tambah Tipe Kamar Baru</h3>
        <a href="{{ route('admin.type-kamar.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
            Kembali
        </a>
    </div>
    
    <form action="{{ route('admin.type-kamar.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Tipe Kamar <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="nama" 
                           name="nama" 
                           value="{{ old('nama') }}"
                           placeholder="Contoh: Kamar Standard, Kamar Deluxe"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                           required>
                    @error('nama')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi <span class="text-red-500">*</span>
                    </label>
                    <textarea id="deskripsi" 
                              name="deskripsi" 
                              rows="4"
                              placeholder="Deskripsikan fasilitas dan keunggulan tipe kamar ini..."
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                              required>{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="ukuran_kamar" class="block text-sm font-medium text-gray-700 mb-2">
                            Ukuran Kamar <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="ukuran_kamar" 
                               name="ukuran_kamar" 
                               value="{{ old('ukuran_kamar') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                               placeholder="contoh: 3x4 m"
                               required>
                        @error('ukuran_kamar')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="type_kasur" class="block text-sm font-medium text-gray-700 mb-2">
                            Tipe Kasur <span class="text-red-500">*</span>
                        </label>
                        <select id="type_kasur" 
                                name="type_kasur" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                required>
                            <option value="">Pilih Tipe Kasur</option>
                            <option value="Single Bed" {{ old('type_kasur') == 'Single Bed' ? 'selected' : '' }}>Single Bed</option>
                            <option value="Double Bed" {{ old('type_kasur') == 'Double Bed' ? 'selected' : '' }}>Double Bed</option>
                            <option value="Queen Bed" {{ old('type_kasur') == 'Queen Bed' ? 'selected' : '' }}>Queen Bed</option>
                            <option value="King Bed" {{ old('type_kasur') == 'King Bed' ? 'selected' : '' }}>King Bed</option>
                        </select>
                        @error('type_kasur')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div>
                    <label for="harga" class="block text-sm font-medium text-gray-700 mb-2">
                        Harga per Bulan (Rp) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" 
                           id="harga" 
                           name="harga" 
                           value="{{ old('harga') }}"
                           min="0"
                           step="1000"
                           placeholder="1500000"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                           required>
                    @error('harga')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div class="space-y-4">
                <!-- Upload Gambar -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Upload Gambar Kamar
                    </label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                        <input type="file" 
                               id="gambar" 
                               name="gambar[]" 
                               multiple
                               accept="image/*"
                               class="hidden">
                        <label for="gambar" class="cursor-pointer">
                            <div class="text-gray-500">
                                <svg class="mx-auto h-12 w-12" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <p class="mt-2">Click untuk upload gambar</p>
                                <p class="text-xs text-gray-400">PNG, JPG, GIF hingga 10MB</p>
                            </div>
                        </label>
                    </div>
                    @error('gambar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    @error('gambar.*')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Fasilitas Kost -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Fasilitas Kost
                    </label>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach($fasilitasKost as $fasilitas)
                            <div class="flex items-center">
                                <input type="checkbox" 
                                       id="fasilitas_kost_{{ $fasilitas->id }}" 
                                       name="fasilitas_kost[]" 
                                       value="{{ $fasilitas->id }}"
                                       {{ in_array($fasilitas->id, old('fasilitas_kost', [])) ? 'checked' : '' }}
                                       class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                                <label for="fasilitas_kost_{{ $fasilitas->id }}" class="ml-2 text-sm text-gray-700">
                                    {{ $fasilitas->nama }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Fasilitas Kamar -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Fasilitas Kamar
                    </label>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach($fasilitasKamar as $fasilitas)
                            <div class="flex items-center">
                                <input type="checkbox" 
                                       id="fasilitas_kamar_{{ $fasilitas->id }}" 
                                       name="fasilitas_kamar[]" 
                                       value="{{ $fasilitas->id }}"
                                       {{ in_array($fasilitas->id, old('fasilitas_kamar', [])) ? 'checked' : '' }}
                                       class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                                <label for="fasilitas_kamar_{{ $fasilitas->id }}" class="ml-2 text-sm text-gray-700">
                                    {{ $fasilitas->nama }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end space-x-4 pt-6 mt-6 border-t border-gray-200">
            <a href="{{ route('admin.type-kamar.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition-colors">
                Batal
            </a>
            <button type="submit" 
                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg transition-colors">
                Simpan Tipe Kamar
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto focus to nama input
    document.getElementById('nama').focus();
    
    // Preview gambar
    document.getElementById('gambar').addEventListener('change', function(e) {
        // Handle file preview logic here
        console.log('Files selected:', e.target.files.length);
    });
    
    // Format harga input
    const hargaInput = document.getElementById('harga');
    hargaInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        e.target.value = value;
    });
});
</script>
@endsection