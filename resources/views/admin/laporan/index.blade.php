@extends('layouts.admin')

@section('title', 'Laporan - Admin Dashboard')

@section('page-title', 'Laporan')

@section('content')
<div class="space-y-6">
    <!-- Filter Laporan -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Filter Laporan</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Periode</label>
                <select class="w-full border border-gray-300 rounded-lg px-3 py-2">
                    <option>Bulan Ini</option>
                    <option>3 Bulan Terakhir</option>
                    <option>6 Bulan Terakhir</option>
                    <option>Tahun Ini</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Laporan</label>
                <select class="w-full border border-gray-300 rounded-lg px-3 py-2">
                    <option>Semua</option>
                    <option>Pendapatan</option>
                    <option>Booking</option>
                    <option>Occupancy</option>
                </select>
            </div>
            <div class="flex items-end">
                <button class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-colors">
                    Generate Laporan
                </button>
            </div>
        </div>
    </div>

    <!-- Ringkasan Laporan -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h4 class="text-sm font-medium text-gray-500 mb-2">Total Pendapatan</h4>
            <p class="text-2xl font-bold text-gray-900">Rp 0</p>
        </div>
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h4 class="text-sm font-medium text-gray-500 mb-2">Total Booking</h4>
            <p class="text-2xl font-bold text-gray-900">0</p>
        </div>
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h4 class="text-sm font-medium text-gray-500 mb-2">Occupancy Rate</h4>
            <p class="text-2xl font-bold text-gray-900">0%</p>
        </div>
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h4 class="text-sm font-medium text-gray-500 mb-2">Kamar Kosong</h4>
            <p class="text-2xl font-bold text-gray-900">0</p>
        </div>
    </div>

    <!-- Detail Laporan -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Detail Laporan</h3>
        <div class="text-center py-12 text-gray-500">
            Data laporan akan ditampilkan di sini
        </div>
    </div>
</div>
@endsection