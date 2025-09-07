@extends('layouts.admin')

@section('title', 'Konfirmasi Pembayaran - Admin Kost Honest')
@section('page-title', 'Konfirmasi Pembayaran')

@section('content')
<div class="bg-white rounded-lg shadow-sm border border-gray-200">
    <!-- Header -->
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-lg font-semibold text-gray-900">Konfirmasi Pembayaran</h2>
                <p class="text-gray-600 mt-1">Kelola konfirmasi pembayaran dari pengguna</p>
            </div>
        </div>
    </div>
    
    <!-- Search and Filter Section -->
    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
        <form method="GET" action="{{ route('admin.payment-confirmations.index') }}" class="flex gap-4 items-center">
            <!-- Search Input -->
            <div class="flex-1">
                <input type="text" 
                       name="search" 
                       id="search"
                       value="{{ $search ?? '' }}"
                       placeholder="Cari berdasarkan booking code, nama pengguna, atau kamar..."
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
                <a href="{{ route('admin.payment-confirmations.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md transition-colors flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    <span>Reset</span>
                </a>
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Booking</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengguna</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kamar</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Konfirmasi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bukti Transfer</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($confirmations as $confirmation)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div>
                            <div class="font-medium text-gray-900">{{ $confirmation->booking_code }}</div>
                            <div class="text-sm text-gray-500">{{ $confirmation->created_at->format('d M Y H:i') }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div>
                            <div class="font-medium text-gray-900">{{ $confirmation->user->name }}</div>
                            <div class="text-sm text-gray-500">{{ $confirmation->user->email }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div>
                            <div class="font-medium text-gray-900">{{ $confirmation->kamar->nama_kamar }}</div>
                            <div class="text-sm text-gray-500">{{ $confirmation->kamar->typeKamar->nama }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="font-medium text-green-600">Rp {{ number_format($confirmation->total_amount, 0, ',', '.') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $confirmation->confirmed_at->format('d M Y H:i') }}</div>
                        @if($confirmation->payment_notes)
                        <div class="text-xs text-gray-500">{{ Str::limit($confirmation->payment_notes, 30) }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($confirmation->transfer_proof)
                        <a href="{{ Storage::url($confirmation->transfer_proof) }}" target="_blank" 
                           class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            Lihat Bukti
                        </a>
                        @else
                        <span class="text-gray-400 text-sm">Tidak ada</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <div class="flex justify-center space-x-2">
                            <button onclick="approvePayment({{ $confirmation->id }})" 
                                    class="px-3 py-1 bg-green-600 text-white text-sm rounded hover:bg-green-700">
                                Setujui
                            </button>
                            <button onclick="rejectPayment({{ $confirmation->id }})" 
                                    class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700">
                                Tolak
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                        <div class="flex flex-col items-center">
                            <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <p class="text-lg font-medium text-gray-900">Tidak ada konfirmasi pembayaran</p>
                            <p class="text-gray-500">Belum ada pengguna yang mengkonfirmasi pembayaran</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="px-6 py-4 border-t border-gray-200">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div class="flex items-center space-x-4">
                <div class="text-sm text-gray-700">
                    Menampilkan <span class="font-medium">{{ $perPage }}</span> dari <span class="font-medium">{{ $confirmations->total() }}</span> hasil
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
            
            @if($confirmations->hasPages())
            
            <div class="flex space-x-1">
                {{-- Previous Page Link --}}
                @if($confirmations->onFirstPage())
                    <span class="px-3 py-2 text-sm text-gray-400 bg-gray-100 border border-gray-300 rounded-md cursor-not-allowed">
                        &laquo; Previous
                    </span>
                @else
                    <a href="{{ $confirmations->previousPageUrl() }}" 
                       class="px-3 py-2 text-sm text-gray-600 bg-white border border-gray-300 rounded-md hover:bg-gray-50 hover:text-gray-800 transition-colors">
                        &laquo; Previous
                    </a>
                @endif

                {{-- Page Numbers with Smart Display --}}
                @php
                    $currentPage = $confirmations->currentPage();
                    $lastPage = $confirmations->lastPage();
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
                    <a href="{{ $confirmations->url(1) }}" 
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
                        <a href="{{ $confirmations->url($page) }}" 
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
                    <a href="{{ $confirmations->url($lastPage) }}" 
                       class="px-3 py-2 text-sm text-gray-600 bg-white border border-gray-300 rounded-md hover:bg-gray-50 hover:text-gray-800 transition-colors">
                        {{ $lastPage }}
                    </a>
                @endif

                {{-- Next Page Link --}}
                @if($confirmations->hasMorePages())
                    <a href="{{ $confirmations->nextPageUrl() }}" 
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
});

function approvePayment(id) {
    if (confirm('Apakah Anda yakin ingin menyetujui pembayaran ini?')) {
        fetch(`/admin/payment-confirmations/${id}/approve`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Pembayaran berhasil disetujui!');
                location.reload();
            } else {
                alert(data.message || 'Terjadi kesalahan');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat memproses permintaan');
        });
    }
}

function rejectPayment(id) {
    const reason = prompt('Alasan penolakan (opsional):');
    if (reason !== null) {
        fetch(`/admin/payment-confirmations/${id}/reject`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ reason: reason })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Pembayaran ditolak. Pengguna dapat melakukan konfirmasi ulang.');
                location.reload();
            } else {
                alert(data.message || 'Terjadi kesalahan');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat memproses permintaan');
        });
    }
}
</script>
@endsection