@extends('layouts.admin')

@section('title', 'Edit Kamar - Admin Dashboard')

@section('page-title', 'Edit Kamar')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-semibold text-gray-900">Edit Kamar {{ $kamar->nama_kamar }}</h3>
        <a href="{{ route('admin.kamar.index') }}" 
           class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
            Kembali
        </a>
    </div>
    
    <form action="{{ route('admin.kamar.update', $kamar->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Nama Kamar -->
            <div>
                <label for="nama_kamar" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Kamar <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="nama_kamar" 
                       name="nama_kamar" 
                       value="{{ old('nama_kamar', $kamar->nama_kamar) }}"
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
                        <option value="{{ $type->id }}" 
                                {{ old('type_kamar_id', $kamar->type_kamar_id) == $type->id ? 'selected' : '' }}>
                            {{ $type->nama }} - Rp {{ number_format($type->harga, 0, ',', '.') }}
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
                    <option value="Tersedia" {{ old('status_kamar', $kamar->status_kamar) == 'Tersedia' ? 'selected' : '' }}>
                        Tersedia
                    </option>
                    <option value="Booked" {{ old('status_kamar', $kamar->status_kamar) == 'Booked' ? 'selected' : '' }}>
                        Booked
                    </option>
                    <option value="Dihuni" {{ old('status_kamar', $kamar->status_kamar) == 'Dihuni' ? 'selected' : '' }}>
                        Dihuni
                    </option>
                </select>
                @error('status_kamar')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <!-- Kebijakan Kamar -->
        @if($kebijakanKamars && $kebijakanKamars->count() > 0)
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-3">
                Kebijakan Kamar
            </label>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                @foreach($kebijakanKamars as $kebijakan)
                <label class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer">
                    <input type="checkbox" 
                           name="kebijakan_kamar_ids[]" 
                           value="{{ $kebijakan->id }}"
                           {{ in_array($kebijakan->id, old('kebijakan_kamar_ids', $kamar->kebijakan_kamar_ids ?? [])) ? 'checked' : '' }}
                           class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500 focus:ring-2">
                    <span class="ml-2 text-sm text-gray-700">{{ $kebijakan->deskripsi }}</span>
                </label>
                @endforeach
            </div>
            @error('kebijakan_kamar_ids')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        @endif
        
        <!-- Submit Buttons -->
        <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
            <a href="{{ route('admin.kamar.index') }}" 
               class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                Batal
            </a>
            <button type="submit" 
                    class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                Update Kamar
            </button>
        </div>
    </form>
</div>
@endsection