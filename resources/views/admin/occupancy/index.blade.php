@extends('layouts.admin')

@section('title', 'Monitoring Hunian - Admin Dashboard')

@section('page-title', 'Monitoring Hunian')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-semibold text-gray-900">Daftar Kamar & Penghuni</h3>
        <div class="flex space-x-2">
            <button onclick="location.reload()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                <span>Refresh</span>
            </button>
        </div>
    </div>
    
    <!-- Search and Filter Section -->
    <div class="mb-6 bg-gray-50 p-4 rounded-lg">
        <form method="GET" action="{{ route('admin.occupancy.index') }}" class="flex gap-4 items-center">
            <!-- Search Input -->
            <div class="flex-1">
                <input type="text" 
                       name="search" 
                       id="search"
                       value="{{ $search ?? '' }}"
                       placeholder="Cari berdasarkan nama kamar atau penghuni..."
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
            </div>
            
            <!-- Status Filter -->
            <div class="w-40">
                <select name="status_filter" 
                        id="status_filter"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    <option value="all" {{ ($statusFilter ?? 'all') === 'all' ? 'selected' : '' }}>Semua Status</option>
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
                <a href="{{ route('admin.occupancy.index') }}" 
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
                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Tipe Kamar</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Penghuni</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($rooms as $room)
                @php
                    $currentBooking = $room->bookings->first();
                @endphp
                <tr>
                    <td class="px-4 py-3 text-sm text-gray-900">{{ $room->nama_kamar }}</td>
                    <td class="px-4 py-3 text-sm text-gray-900">
                        {{ $room->typeKamar ? $room->typeKamar->nama : 'N/A' }}
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-900">
                        @if($currentBooking)
                            <a href="{{ route('admin.users.show', $currentBooking->user->id) }}" 
                               class="text-blue-600 hover:text-blue-900 hover:underline font-medium">
                                {{ $currentBooking->user->name }}
                            </a>
                            <div class="text-xs text-gray-500">{{ $currentBooking->user->email }}</div>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-4 py-8 text-center text-gray-500">
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
                    Menampilkan <span class="font-medium">{{ $perPage }}</span> dari <span class="font-medium">{{ $rooms->total() }}</span> hasil
                </div>
                
                <!-- Per Page Selector -->
                <div class="flex items-center space-x-2">
                    <label class="text-sm text-gray-600">Per halaman:</label>
                    <select id="perPageSelect" 
                            class="px-3 py-1 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                        <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                    </select>
                </div>
            </div>
            
            @if($rooms->hasPages())
            <div class="flex space-x-1">
                {{-- Previous Page Link --}}
                @if($rooms->onFirstPage())
                    <span class="px-3 py-2 text-sm text-gray-400 bg-gray-100 border border-gray-300 rounded-md cursor-not-allowed">
                        &laquo; Previous
                    </span>
                @else
                    <a href="{{ $rooms->previousPageUrl() }}" 
                       class="px-3 py-2 text-sm text-gray-600 bg-white border border-gray-300 rounded-md hover:bg-gray-50 hover:text-gray-800 transition-colors">
                        &laquo; Previous
                    </a>
                @endif

                {{-- Page Numbers --}}
                @php
                    $currentPage = $rooms->currentPage();
                    $lastPage = $rooms->lastPage();
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

                @if($startPage > 1)
                    <a href="{{ $rooms->url(1) }}" 
                       class="px-3 py-2 text-sm text-gray-600 bg-white border border-gray-300 rounded-md hover:bg-gray-50 hover:text-gray-800 transition-colors">
                        1
                    </a>
                    @if($startPage > 2)
                        <span class="px-3 py-2 text-sm text-gray-500">...</span>
                    @endif
                @endif

                @for($page = $startPage; $page <= $endPage; $page++)
                    @if($page == $currentPage)
                        <span class="px-3 py-2 text-sm font-medium text-white bg-red-600 border border-red-600 rounded-md">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $rooms->url($page) }}" 
                           class="px-3 py-2 text-sm text-gray-600 bg-white border border-gray-300 rounded-md hover:bg-gray-50 hover:text-gray-800 transition-colors">
                            {{ $page }}
                        </a>
                    @endif
                @endfor

                @if($endPage < $lastPage)
                    @if($endPage < $lastPage - 1)
                        <span class="px-3 py-2 text-sm text-gray-500">...</span>
                    @endif
                    <a href="{{ $rooms->url($lastPage) }}" 
                       class="px-3 py-2 text-sm text-gray-600 bg-white border border-gray-300 rounded-md hover:bg-gray-50 hover:text-gray-800 transition-colors">
                        {{ $lastPage }}
                    </a>
                @endif

                {{-- Next Page Link --}}
                @if($rooms->hasMorePages())
                    <a href="{{ $rooms->nextPageUrl() }}" 
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
            
            currentUrl.searchParams.set('per_page', selectedValue);
            currentUrl.searchParams.delete('page');
            
            window.location.href = currentUrl.toString();
        });
    }
});
</script>

@endsection