@extends('layouts.admin')

@section('title', 'Kelola Kost - Admin Dashboard')

@section('page-title', 'Kelola Kost')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-semibold text-gray-900">Daftar Kamar Kost</h3>
        <div class="flex space-x-2">
            <form method="GET" action="{{ route('admin.kamar.export.pdf') }}" id="exportForm" class="inline">
                <input type="hidden" name="search" value="{{ $search ?? '' }}">
                <input type="hidden" name="status_filter" value="{{ $statusFilter ?? '' }}">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span>Export PDF</span>
                </button>
            </form>
            <a href="{{ route('admin.kamar.create') }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-colors">
                Tambah Kamar
            </a>
        </div>
    </div>
    
    <!-- Search and Filter Section -->
    <div class="mb-6 bg-gray-50 p-4 rounded-lg">
        <form method="GET" action="{{ route('admin.kamar.index') }}" class="flex gap-4 items-center">
            <!-- Search Input -->
            <div class="flex-1">
                <input type="text" 
                       name="search" 
                       id="search"
                       value="{{ $search ?? '' }}"
                       placeholder="Cari berdasarkan nama kamar atau tipe..."
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
            </div>
            
            <!-- Status Filter -->
            <div class="w-40">
                <select name="status_filter" 
                        id="status_filter"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    <option value="">Semua Status</option>
                    <option value="all" {{ ($statusFilter ?? '') === 'all' ? 'selected' : '' }}>Semua Status</option>
                    <option value="Tersedia" {{ ($statusFilter ?? '') === 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="Booked" {{ ($statusFilter ?? '') === 'Booked' ? 'selected' : '' }}>Booked</option>
                    <option value="Dihuni" {{ ($statusFilter ?? '') === 'Dihuni' ? 'selected' : '' }}>Dihuni</option>
                </select>
            </div>
            
            <!-- Preserve per_page value -->
            <input type="hidden" name="per_page" value="{{ $perPage }}">
            
            <!-- Action Buttons -->
            <div class="flex space-x-2">
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition-colors flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <span>Cari</span>
                </button>
                <a href="{{ route('admin.kamar.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md transition-colors flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    <span>Reset</span>
                </a>
            </div>
        </form>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-gray-50">
                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Nama Kamar</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Tipe</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Harga</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Status</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($kamars as $kamar)
                <tr>
                    <td class="px-4 py-3 text-sm text-gray-900">{{ $kamar->nama_kamar }}</td>
                    <td class="px-4 py-3 text-sm text-gray-900">
                        {{ $kamar->typeKamar ? $kamar->typeKamar->nama : 'N/A' }}
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-900">
                        {{ $kamar->typeKamar ? 'Rp ' . number_format($kamar->typeKamar->harga, 0, ',', '.') : 'N/A' }}
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-900">
                        <span class="px-2 py-1 text-xs font-medium rounded-full
                            @if($kamar->status_kamar == 'Tersedia') bg-green-100 text-green-800
                            @elseif($kamar->status_kamar == 'Booked') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800
                            @endif">
                            {{ $kamar->status_kamar }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-900">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.kamar.show', $kamar->id) }}" 
                               class="text-blue-600 hover:text-blue-900 p-1 rounded hover:bg-blue-50" 
                               title="Lihat Detail">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </a>
                            <a href="{{ route('admin.kamar.edit', $kamar->id) }}" 
                               class="text-yellow-600 hover:text-yellow-900 p-1 rounded hover:bg-yellow-50" 
                               title="Edit Kamar">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                            <form action="{{ route('admin.kamar.destroy', $kamar->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" 
                                        class="text-red-600 hover:text-red-900 p-1 rounded hover:bg-red-50"
                                        title="Hapus Kamar"
                                        onclick="confirmDelete('Yakin ingin menghapus kamar {{ $kamar->nama_kamar }}?', () => { this.closest('form').submit(); })">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                        Belum ada data kamar
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6 border-t border-gray-200 pt-4">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div class="flex items-center space-x-4">
                <div class="text-sm text-gray-700">
                    Menampilkan <span class="font-medium">{{ $perPage }}</span> dari <span class="font-medium">{{ $kamars->total() }}</span> hasil
                </div>
                
                <!-- Per Page Selector -->
                <div class="flex items-center space-x-2">
                    <label class="text-sm text-gray-600">Per halaman:</label>
                    <select id="perPageSelect" 
                            class="px-3 py-1 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                        <option value="3" {{ $perPage == 3 ? 'selected' : '' }}>3</option>
                        <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                        <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                    </select>
                </div>
            </div>
            
            @if($kamars->hasPages())
            
            <div class="flex space-x-1">
                {{-- Previous Page Link --}}
                @if($kamars->onFirstPage())
                    <span class="px-3 py-2 text-sm text-gray-400 bg-gray-100 border border-gray-300 rounded-md cursor-not-allowed">
                        &laquo; Previous
                    </span>
                @else
                    <a href="{{ $kamars->previousPageUrl() }}" 
                       class="px-3 py-2 text-sm text-gray-600 bg-white border border-gray-300 rounded-md hover:bg-gray-50 hover:text-gray-800 transition-colors">
                        &laquo; Previous
                    </a>
                @endif

                {{-- Page Numbers with Smart Display --}}
                @php
                    $currentPage = $kamars->currentPage();
                    $lastPage = $kamars->lastPage();
                    $maxVisible = 5;
                    
                    if ($lastPage <= $maxVisible) {
                        $startPage = 1;
                        $endPage = $lastPage;
                    } else {
                        if ($currentPage <= 3) {
                            $startPage = 1;
                            $endPage = $maxVisible;
                        } elseif ($currentPage >= $lastPage - 2) {
                            $startPage = $lastPage - $maxVisible + 1;
                            $endPage = $lastPage;
                        } else {
                            $startPage = $currentPage - 2;
                            $endPage = $currentPage + 2;
                        }
                    }
                @endphp

                {{-- First page and ellipsis --}}
                @if($startPage > 1)
                    <a href="{{ $kamars->url(1) }}" 
                       class="px-3 py-2 text-sm text-gray-600 bg-white border border-gray-300 rounded-md hover:bg-gray-50 hover:text-gray-800 transition-colors">
                        1
                    </a>
                    @if($startPage > 2)
                        <span class="px-3 py-2 text-sm text-gray-500">...</span>
                    @endif
                @endif

                {{-- Visible page range --}}
                @for($page = $startPage; $page <= $endPage; $page++)
                    @if($page == $currentPage)
                        <span class="px-3 py-2 text-sm font-medium text-white bg-red-600 border border-red-600 rounded-md">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $kamars->url($page) }}" 
                           class="px-3 py-2 text-sm text-gray-600 bg-white border border-gray-300 rounded-md hover:bg-gray-50 hover:text-gray-800 transition-colors">
                            {{ $page }}
                        </a>
                    @endif
                @endfor

                {{-- Last page and ellipsis --}}
                @if($endPage < $lastPage)
                    @if($endPage < $lastPage - 1)
                        <span class="px-3 py-2 text-sm text-gray-500">...</span>
                    @endif
                    <a href="{{ $kamars->url($lastPage) }}" 
                       class="px-3 py-2 text-sm text-gray-600 bg-white border border-gray-300 rounded-md hover:bg-gray-50 hover:text-gray-800 transition-colors">
                        {{ $lastPage }}
                    </a>
                @endif

                {{-- Next Page Link --}}
                @if($kamars->hasMorePages())
                    <a href="{{ $kamars->nextPageUrl() }}" 
                       class="px-3 py-2 text-sm text-gray-600 bg-white border border-gray-300 rounded-md hover:bg-gray-50 hover:text-gray-800 transition-colors">
                        Next &raquo;
                    </a>
                @else
                    <span class="px-3 py-2 text-sm text-gray-400 bg-gray-100 border border-gray-300 rounded-md cursor-not-allowed">
                        Next &raquo;
                    </span>
                @endif
            </div>
            @else
            <div class="text-sm text-gray-500">
                Halaman 1 dari 1
            </div>
            @endif
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const perPageSelect = document.getElementById('perPageSelect');
    
    if (perPageSelect) {
        perPageSelect.addEventListener('change', function() {
            const selectedValue = this.value;
            const currentUrl = new URL(window.location.href);
            
            // Update the per_page parameter
            currentUrl.searchParams.set('per_page', selectedValue);
            // Reset to page 1 when changing per_page
            currentUrl.searchParams.delete('page');
            
            // Redirect to new URL
            window.location.href = currentUrl.toString();
        });
    }
    
    // Update export form when search or filter changes
    const searchInput = document.getElementById('search');
    const statusFilterSelect = document.getElementById('status_filter');
    const exportForm = document.getElementById('exportForm');
    
    if (searchInput && exportForm) {
        searchInput.addEventListener('input', function() {
            exportForm.querySelector('input[name="search"]').value = this.value;
        });
    }
    
    if (statusFilterSelect && exportForm) {
        statusFilterSelect.addEventListener('change', function() {
            exportForm.querySelector('input[name="status_filter"]').value = this.value;
        });
    }
});
</script>
@endsection