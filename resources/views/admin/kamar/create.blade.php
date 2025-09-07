@extends('layouts.admin')

@section('title', 'Tambah Kamar - Admin Dashboard')

@section('page-title', 'Tambah Kamar')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-semibold text-gray-900">Tambah Kamar Baru</h3>
        <a href="{{ route('admin.kamar.index') }}" 
           class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
            Kembali
        </a>
    </div>
    
    <form action="{{ route('admin.kamar.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Nama Kamar -->
            <div>
                <label for="nama_kamar" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Kamar <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="nama_kamar" 
                       name="nama_kamar" 
                       value="{{ old('nama_kamar') }}"
                       placeholder="Contoh: Kamar 101"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 @error('nama_kamar') border-red-500 @enderror"
                       required>
                @error('nama_kamar')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Tipe Kamar -->
            <div>
                <label for="type_kamar_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Tipe Kamar <span class="text-red-500">*</span>
                </label>
                <select id="type_kamar_id" 
                        name="type_kamar_id"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 @error('type_kamar_id') border-red-500 @enderror"
                        required>
                    <option value="">Pilih Tipe Kamar</option>
                    @foreach($typeKamars as $type)
                        <option value="{{ $type->id }}" {{ old('type_kamar_id') == $type->id ? 'selected' : '' }}>
                            {{ $type->nama }} - Rp {{ number_format($type->harga, 0, ',', '.') }}/bulan
                        </option>
                    @endforeach
                </select>
                @error('type_kamar_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Status Kamar -->
            <div>
                <label for="status_kamar" class="block text-sm font-medium text-gray-700 mb-2">
                    Status Kamar <span class="text-red-500">*</span>
                </label>
                <select id="status_kamar" 
                        name="status_kamar"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 @error('status_kamar') border-red-500 @enderror"
                        required>
                    <option value="">Pilih Status</option>
                    <option value="Tersedia" {{ old('status_kamar') == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="Dihuni" {{ old('status_kamar') == 'Dihuni' ? 'selected' : '' }}>Dihuni</option>
                    <option value="Maintenance" {{ old('status_kamar') == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                </select>
                @error('status_kamar')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Kebijakan Kamar (Optional) -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Kebijakan Kamar (Opsional)
            </label>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($kebijakanKamars as $kebijakan)
                    <div class="flex items-center">
                        <input type="checkbox" 
                               id="kebijakan_{{ $kebijakan->id }}" 
                               name="kebijakan_kamar_ids[]" 
                               value="{{ $kebijakan->id }}"
                               {{ in_array($kebijakan->id, old('kebijakan_kamar_ids', [])) ? 'checked' : '' }}
                               class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                        <label for="kebijakan_{{ $kebijakan->id }}" class="ml-2 text-sm text-gray-700">
                            {{ $kebijakan->deskripsi }}
                        </label>
                    </div>
                @endforeach
            </div>
            @error('kebijakan_kamar_ids')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end space-x-4 pt-6">
            <a href="{{ route('admin.kamar.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition-colors">
                Batal
            </a>
            <button type="submit" 
                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg transition-colors">
                Simpan Kamar
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto focus to nama_kamar input
    document.getElementById('nama_kamar').focus();
    
    // Form validation
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const namaKamar = document.getElementById('nama_kamar').value.trim();
        const typeKamar = document.getElementById('type_kamar_id').value;
        const statusKamar = document.getElementById('status_kamar').value;
        
        if (!namaKamar || !typeKamar || !statusKamar) {
            e.preventDefault();
            alert('Mohon lengkapi semua field yang wajib diisi!');
            return false;
        }
    });
});
</script>
@endsection