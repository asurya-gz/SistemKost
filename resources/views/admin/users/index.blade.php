@extends('layouts.admin')

@section('title', 'Kelola Users - Admin Dashboard')

@section('page-title', 'Kelola Users')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6 h-[90vh] flex flex-col">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-semibold text-gray-900">Daftar Users</h3>
        <div class="flex space-x-2">
            <form method="GET" action="{{ route('admin.users.export.pdf') }}" id="exportForm" class="inline">
                <input type="hidden" name="search" value="{{ $search ?? '' }}">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span>Export PDF</span>
                </button>
            </form>
            <a href="{{ route('admin.users.create') }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-colors">
                Tambah User
            </a>
        </div>
    </div>
    
    <!-- Search and Filter Section -->
    <div class="mb-6 bg-gray-50 p-4 rounded-lg">
        <form method="GET" action="{{ route('admin.users.index') }}" class="flex gap-4 items-center">
            <!-- Search Input -->
            <div class="flex-1">
                <input type="text" 
                       name="search" 
                       id="search"
                       value="{{ $search ?? '' }}"
                       placeholder="Cari berdasarkan nama atau email..."
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
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
                <a href="{{ route('admin.users.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md transition-colors flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    <span>Reset</span>
                </a>
            </div>
        </form>
    </div>
    
    <div class="flex-1 overflow-hidden flex flex-col">
        <div class="flex-1 overflow-x-auto">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Nama</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Email</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Role</th>
                        <th class="px-4 py-3 text-center text-sm font-medium text-gray-500">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($users as $user)
                    <tr>
                        <td class="px-4 py-3 text-sm text-gray-900">{{ $user->name }}</td>
                        <td class="px-4 py-3 text-sm text-gray-900">{{ $user->email }}</td>
                        <td class="px-4 py-3 text-sm text-gray-900">
                            <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-900">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('admin.users.show', $user->id) }}" 
                                   class="text-blue-600 hover:text-blue-900 p-1 rounded hover:bg-blue-50" 
                                   title="Lihat Detail">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>
                                <a href="{{ route('admin.users.edit', $user->id) }}" 
                                   class="text-yellow-600 hover:text-yellow-900 p-1 rounded hover:bg-yellow-50" 
                                   title="Edit User">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.users.reset-password', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="button" 
                                            class="text-green-600 hover:text-green-900 p-1 rounded hover:bg-green-50"
                                            title="Reset Password"
                                            onclick="showAlert({ title: 'Konfirmasi Reset Password', message: 'Yakin ingin mereset password user {{ $user->name }} ke default (honest123_)?', type: 'warning', confirmText: 'Reset', onConfirm: () => { this.closest('form').submit(); } })">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 12H9v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-1C2 13.896 2.896 13 4 13h2.343z"></path>
                                        </svg>
                                    </button>
                                </form>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" 
                                            class="text-red-600 hover:text-red-900 p-1 rounded hover:bg-red-50"
                                            title="Hapus User"
                                            onclick="confirmDelete('Yakin ingin menghapus user {{ $user->name }}?', () => { this.closest('form').submit(); })">
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
                        <td colspan="4" class="px-4 py-8 text-center text-gray-500">
                            Tidak ada pengguna ditemukan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination Links -->
        <div class="mt-6 border-t border-gray-200 pt-4">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div class="flex items-center space-x-4">
                    <div class="text-sm text-gray-700">
                        Menampilkan <span class="font-medium">{{ $perPage }}</span> dari <span class="font-medium">{{ $users->total() }}</span> hasil
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
                
                @if($users->hasPages())
                <div class="flex space-x-1">
                    {{-- Previous Page Link --}}
                    @if($users->onFirstPage())
                        <span class="px-3 py-2 text-sm text-gray-400 bg-gray-100 border border-gray-300 rounded-md cursor-not-allowed">
                            &laquo; Previous
                        </span>
                    @else
                        <a href="{{ $users->previousPageUrl() }}" 
                           class="px-3 py-2 text-sm text-gray-600 bg-white border border-gray-300 rounded-md hover:bg-gray-50 hover:text-gray-800 transition-colors">
                            &laquo; Previous
                        </a>
                    @endif

                    {{-- Page Numbers with Smart Display --}}
                    @php
                        $currentPage = $users->currentPage();
                        $lastPage = $users->lastPage();
                        $maxVisible = 5; // Maximum visible page numbers
                        
                        if ($lastPage <= $maxVisible) {
                            // If total pages <= 5, show all
                            $startPage = 1;
                            $endPage = $lastPage;
                        } else {
                            // Smart pagination logic
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
                        <a href="{{ $users->url(1) }}" 
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
                            <a href="{{ $users->url($page) }}" 
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
                        <a href="{{ $users->url($lastPage) }}" 
                           class="px-3 py-2 text-sm text-gray-600 bg-white border border-gray-300 rounded-md hover:bg-gray-50 hover:text-gray-800 transition-colors">
                            {{ $lastPage }}
                        </a>
                    @endif

                    {{-- Next Page Link --}}
                    @if($users->hasMorePages())
                        <a href="{{ $users->nextPageUrl() }}" 
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
    
    // Update export form when search changes
    const searchInput = document.getElementById('search');
    const exportForm = document.getElementById('exportForm');
    
    if (searchInput && exportForm) {
        searchInput.addEventListener('input', function() {
            exportForm.querySelector('input[name="search"]').value = this.value;
        });
    }
});
</script>
@endsection