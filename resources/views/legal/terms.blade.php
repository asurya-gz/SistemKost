@extends('layouts.auth')

@section('title', 'Syarat dan Ketentuan - Kost Honest')

@section('content')
<section class="min-h-screen py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-4">
                        <div class="bg-red-600 text-white rounded-xl p-3 shadow-lg">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-8 2h2v2h-2V5zm0 4h2v8h-2V9z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">Syarat dan Ketentuan</h1>
                            <p class="text-gray-600">Kost Honest Management System</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-500">Terakhir diperbarui:</p>
                        <p class="font-semibold text-gray-700">{{ date('d F Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <div class="prose prose-lg max-w-none">
                    <!-- Pendahuluan -->
                    <section class="mb-8">
                        <h2 class="text-2xl font-bold text-red-600 mb-4">1. Pendahuluan</h2>
                        <p class="text-gray-700 mb-4">
                            Selamat datang di <strong>Kost Honest</strong>. Dengan mengakses dan menggunakan platform ini, 
                            Anda setuju untuk terikat oleh syarat dan ketentuan berikut. Jika Anda tidak setuju dengan 
                            syarat dan ketentuan ini, mohon untuk tidak menggunakan layanan kami.
                        </p>
                        <p class="text-gray-700">
                            Platform Kost Honest adalah sistem manajemen digital yang memfasilitasi pengelolaan kost, 
                            booking kamar, dan komunikasi antara pengelola dan penghuni.
                        </p>
                    </section>

                    <!-- Definisi -->
                    <section class="mb-8">
                        <h2 class="text-2xl font-bold text-red-600 mb-4">2. Definisi</h2>
                        <ul class="list-disc list-inside text-gray-700 space-y-2">
                            <li><strong>"Platform"</strong> mengacu pada website dan aplikasi Kost Honest</li>
                            <li><strong>"Pengguna"</strong> adalah individu yang menggunakan platform ini</li>
                            <li><strong>"Pengelola"</strong> adalah pihak yang mengelola properti kost</li>
                            <li><strong>"Penghuni"</strong> adalah pihak yang menyewa kamar kost</li>
                            <li><strong>"Layanan"</strong> adalah semua fitur dan fungsi yang tersedia di platform</li>
                        </ul>
                    </section>

                    <!-- Registrasi dan Akun -->
                    <section class="mb-8">
                        <h2 class="text-2xl font-bold text-red-600 mb-4">3. Registrasi dan Akun Pengguna</h2>
                        <div class="space-y-4 text-gray-700">
                            <div>
                                <h3 class="font-semibold text-lg mb-2">3.1 Persyaratan Registrasi</h3>
                                <ul class="list-disc list-inside ml-4 space-y-1">
                                    <li>Pengguna harus berusia minimal 18 tahun atau memiliki izin dari orang tua/wali</li>
                                    <li>Informasi yang diberikan harus akurat, lengkap, dan terkini</li>
                                    <li>Satu orang hanya boleh memiliki satu akun</li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg mb-2">3.2 Keamanan Akun</h3>
                                <ul class="list-disc list-inside ml-4 space-y-1">
                                    <li>Pengguna bertanggung jawab menjaga kerahasiaan password</li>
                                    <li>Segera laporkan jika ada aktivitas mencurigakan di akun Anda</li>
                                    <li>Platform tidak bertanggung jawab atas kerugian akibat kelalaian pengguna</li>
                                </ul>
                            </div>
                        </div>
                    </section>

                    <!-- Penggunaan Platform -->
                    <section class="mb-8">
                        <h2 class="text-2xl font-bold text-red-600 mb-4">4. Penggunaan Platform</h2>
                        <div class="space-y-4 text-gray-700">
                            <div>
                                <h3 class="font-semibold text-lg mb-2">4.1 Penggunaan yang Diizinkan</h3>
                                <ul class="list-disc list-inside ml-4 space-y-1">
                                    <li>Mencari dan melihat informasi kamar kost</li>
                                    <li>Melakukan booking kamar sesuai prosedur</li>
                                    <li>Berkomunikasi dengan pengelola melalui fitur yang tersedia</li>
                                    <li>Mengelola profil dan data pribadi</li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg mb-2">4.2 Penggunaan yang Dilarang</h3>
                                <ul class="list-disc list-inside ml-4 space-y-1">
                                    <li>Menggunakan platform untuk tujuan ilegal</li>
                                    <li>Mengirimkan konten yang menyinggung, kasar, atau tidak pantas</li>
                                    <li>Merusak atau mengganggu sistem platform</li>
                                    <li>Menyalin atau mendistribusikan konten tanpa izin</li>
                                </ul>
                            </div>
                        </div>
                    </section>

                    <!-- Booking dan Pembayaran -->
                    <section class="mb-8">
                        <h2 class="text-2xl font-bold text-red-600 mb-4">5. Booking dan Pembayaran</h2>
                        <div class="space-y-4 text-gray-700">
                            <div>
                                <h3 class="font-semibold text-lg mb-2">5.1 Proses Booking</h3>
                                <ul class="list-disc list-inside ml-4 space-y-1">
                                    <li>Booking harus dilakukan sesuai prosedur yang ditetapkan</li>
                                    <li>Konfirmasi booking akan dikirim melalui sistem</li>
                                    <li>Pengguna wajib memberikan data yang benar dan lengkap</li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg mb-2">5.2 Pembayaran</h3>
                                <ul class="list-disc list-inside ml-4 space-y-1">
                                    <li>Pembayaran harus dilakukan sesuai metode yang tersedia</li>
                                    <li>Biaya administrasi dan deposit sesuai ketentuan pengelola</li>
                                    <li>Bukti pembayaran harus disimpan untuk keperluan verifikasi</li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg mb-2">5.3 Pembatalan</h3>
                                <ul class="list-disc list-inside ml-4 space-y-1">
                                    <li>Pembatalan dapat dilakukan sesuai kebijakan masing-masing pengelola</li>
                                    <li>Pengembalian dana mengikuti terms yang berlaku</li>
                                    <li>Platform tidak bertanggung jawab atas dispute pembayaran</li>
                                </ul>
                            </div>
                        </div>
                    </section>

                    <!-- Tanggung Jawab -->
                    <section class="mb-8">
                        <h2 class="text-2xl font-bold text-red-600 mb-4">6. Tanggung Jawab dan Batasan</h2>
                        <div class="space-y-4 text-gray-700">
                            <div>
                                <h3 class="font-semibold text-lg mb-2">6.1 Tanggung Jawab Platform</h3>
                                <ul class="list-disc list-inside ml-4 space-y-1">
                                    <li>Menyediakan platform yang stabil dan aman</li>
                                    <li>Melindungi data pribadi pengguna sesuai kebijakan privasi</li>
                                    <li>Memfasilitasi komunikasi antara pengelola dan penghuni</li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg mb-2">6.2 Batasan Tanggung Jawab</h3>
                                <ul class="list-disc list-inside ml-4 space-y-1">
                                    <li>Platform tidak bertanggung jawab atas kualitas properti kost</li>
                                    <li>Dispute antara pengelola dan penghuni menjadi tanggung jawab masing-masing pihak</li>
                                    <li>Platform tidak menjamin ketersediaan kamar yang ditampilkan</li>
                                </ul>
                            </div>
                        </div>
                    </section>

                    <!-- Perubahan -->
                    <section class="mb-8">
                        <h2 class="text-2xl font-bold text-red-600 mb-4">7. Perubahan Syarat dan Ketentuan</h2>
                        <p class="text-gray-700 mb-4">
                            Kost Honest berhak mengubah syarat dan ketentuan ini sewaktu-waktu. Perubahan akan 
                            diberitahukan melalui platform atau email. Penggunaan platform setelah perubahan 
                            dianggap sebagai persetujuan terhadap syarat dan ketentuan yang baru.
                        </p>
                    </section>

                    <!-- Kontak -->
                    <section class="mb-8">
                        <h2 class="text-2xl font-bold text-red-600 mb-4">8. Kontak</h2>
                        <p class="text-gray-700 mb-4">
                            Jika Anda memiliki pertanyaan tentang syarat dan ketentuan ini, silakan hubungi kami melalui:
                        </p>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <ul class="space-y-2 text-gray-700">
                                <li><strong>Email:</strong> support@kosthonest.com</li>
                                <li><strong>Telepon:</strong> +62 xxx-xxxx-xxxx</li>
                                <li><strong>Alamat:</strong> [Alamat Lengkap Kost Honest]</li>
                            </ul>
                        </div>
                    </section>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 mt-8 pt-6 border-t border-gray-200">
                    <a href="{{ route('register') }}" 
                       class="flex-1 bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors text-center">
                        Kembali ke Registrasi
                    </a>
                    <a href="{{ route('privacy') }}" 
                       class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-6 rounded-lg transition-colors text-center">
                        Lihat Kebijakan Privasi
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection