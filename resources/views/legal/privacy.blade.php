@extends('layouts.auth')

@section('title', 'Kebijakan Privasi - Kost Honest')

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
                                <path d="M12 2C17.52 2 22 6.48 22 12s-4.48 10-10 10S2 17.52 2 12 6.48 2 12 2zm0 18c4.42 0 8-3.58 8-8s-3.58-8-8-8-8 3.58-8 8 3.58 8 8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">Kebijakan Privasi</h1>
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
                            <strong>Kost Honest</strong> berkomitmen untuk melindungi privasi dan data pribadi pengguna. 
                            Kebijakan privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, menyimpan, 
                            dan melindungi informasi pribadi Anda saat menggunakan platform kami.
                        </p>
                        <p class="text-gray-700">
                            Dengan menggunakan layanan kami, Anda setuju dengan praktik yang dijelaskan 
                            dalam kebijakan privasi ini.
                        </p>
                    </section>

                    <!-- Informasi yang Dikumpulkan -->
                    <section class="mb-8">
                        <h2 class="text-2xl font-bold text-red-600 mb-4">2. Informasi yang Kami Kumpulkan</h2>
                        <div class="space-y-4 text-gray-700">
                            <div>
                                <h3 class="font-semibold text-lg mb-2">2.1 Informasi Pribadi</h3>
                                <ul class="list-disc list-inside ml-4 space-y-1">
                                    <li>Nama lengkap</li>
                                    <li>Alamat email</li>
                                    <li>Nomor telepon</li>
                                    <li>Alamat tempat tinggal</li>
                                    <li>Informasi identitas (KTP, SIM, dll.)</li>
                                    <li>Informasi pembayaran</li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg mb-2">2.2 Informasi Teknis</h3>
                                <ul class="list-disc list-inside ml-4 space-y-1">
                                    <li>Alamat IP</li>
                                    <li>Jenis browser dan perangkat</li>
                                    <li>Sistem operasi</li>
                                    <li>Log aktivitas platform</li>
                                    <li>Cookies dan teknologi serupa</li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg mb-2">2.3 Informasi Penggunaan</h3>
                                <ul class="list-disc list-inside ml-4 space-y-1">
                                    <li>Riwayat pencarian dan booking</li>
                                    <li>Preferensi pengguna</li>
                                    <li>Interaksi dengan platform</li>
                                    <li>Komunikasi dengan pengelola kost</li>
                                </ul>
                            </div>
                        </div>
                    </section>

                    <!-- Cara Pengumpulan -->
                    <section class="mb-8">
                        <h2 class="text-2xl font-bold text-red-600 mb-4">3. Cara Kami Mengumpulkan Informasi</h2>
                        <div class="space-y-4 text-gray-700">
                            <div>
                                <h3 class="font-semibold text-lg mb-2">3.1 Informasi yang Anda Berikan</h3>
                                <ul class="list-disc list-inside ml-4 space-y-1">
                                    <li>Saat mendaftar akun</li>
                                    <li>Saat melengkapi profil</li>
                                    <li>Saat melakukan booking</li>
                                    <li>Saat berkomunikasi dengan kami</li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg mb-2">3.2 Informasi yang Dikumpulkan Otomatis</h3>
                                <ul class="list-disc list-inside ml-4 space-y-1">
                                    <li>Melalui cookies dan teknologi tracking</li>
                                    <li>Log server dan analytics</li>
                                    <li>Interaksi dengan fitur platform</li>
                                </ul>
                            </div>
                        </div>
                    </section>

                    <!-- Penggunaan Informasi -->
                    <section class="mb-8">
                        <h2 class="text-2xl font-bold text-red-600 mb-4">4. Penggunaan Informasi</h2>
                        <div class="text-gray-700">
                            <p class="mb-4">Kami menggunakan informasi Anda untuk:</p>
                            <ul class="list-disc list-inside ml-4 space-y-2">
                                <li><strong>Menyediakan Layanan:</strong> Memproses booking, komunikasi, dan manajemen akun</li>
                                <li><strong>Keamanan:</strong> Verifikasi identitas dan mencegah aktivitas mencurigakan</li>
                                <li><strong>Peningkatan Layanan:</strong> Analisis penggunaan untuk mengembangkan fitur</li>
                                <li><strong>Komunikasi:</strong> Mengirim notifikasi, update, dan informasi penting</li>
                                <li><strong>Dukungan Pelanggan:</strong> Membantu menyelesaikan masalah dan pertanyaan</li>
                                <li><strong>Kepatuhan Hukum:</strong> Memenuhi kewajiban hukum dan regulasi</li>
                            </ul>
                        </div>
                    </section>

                    <!-- Berbagi Informasi -->
                    <section class="mb-8">
                        <h2 class="text-2xl font-bold text-red-600 mb-4">5. Berbagi Informasi</h2>
                        <div class="space-y-4 text-gray-700">
                            <div>
                                <h3 class="font-semibold text-lg mb-2">5.1 Dengan Pengelola Kost</h3>
                                <p class="mb-2">Kami membagikan informasi yang diperlukan kepada pengelola kost untuk:</p>
                                <ul class="list-disc list-inside ml-4 space-y-1">
                                    <li>Memproses booking dan pembayaran</li>
                                    <li>Komunikasi terkait sewa kamar</li>
                                    <li>Verifikasi identitas penghuni</li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg mb-2">5.2 Dengan Pihak Ketiga</h3>
                                <p class="mb-2">Kami hanya membagikan informasi dengan pihak ketiga dalam situasi:</p>
                                <ul class="list-disc list-inside ml-4 space-y-1">
                                    <li>Penyedia layanan pembayaran</li>
                                    <li>Layanan analitik dan teknologi</li>
                                    <li>Kewajiban hukum atau perintah pengadilan</li>
                                    <li>Dengan persetujuan eksplisit Anda</li>
                                </ul>
                            </div>
                            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded">
                                <p class="text-yellow-800 font-semibold">Penting:</p>
                                <p class="text-yellow-700">Kami TIDAK menjual atau menyewakan informasi pribadi Anda kepada pihak ketiga untuk tujuan pemasaran.</p>
                            </div>
                        </div>
                    </section>

                    <!-- Keamanan Data -->
                    <section class="mb-8">
                        <h2 class="text-2xl font-bold text-red-600 mb-4">6. Keamanan Data</h2>
                        <div class="space-y-4 text-gray-700">
                            <div>
                                <h3 class="font-semibold text-lg mb-2">6.1 Langkah Keamanan</h3>
                                <ul class="list-disc list-inside ml-4 space-y-1">
                                    <li>Enkripsi SSL untuk transmisi data</li>
                                    <li>Kontrol akses terbatas ke data pribadi</li>
                                    <li>Monitoring keamanan 24/7</li>
                                    <li>Backup data regular</li>
                                    <li>Pelatihan keamanan untuk staf</li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg mb-2">6.2 Penyimpanan Data</h3>
                                <ul class="list-disc list-inside ml-4 space-y-1">
                                    <li>Data disimpan di server yang aman</li>
                                    <li>Lokasi server berada di Indonesia</li>
                                    <li>Akses terbatas hanya untuk staf yang berwenang</li>
                                </ul>
                            </div>
                        </div>
                    </section>

                    <!-- Retensi Data -->
                    <section class="mb-8">
                        <h2 class="text-2xl font-bold text-red-600 mb-4">7. Retensi Data</h2>
                        <div class="text-gray-700">
                            <p class="mb-4">Kami menyimpan informasi pribadi Anda selama:</p>
                            <ul class="list-disc list-inside ml-4 space-y-2">
                                <li><strong>Akun Aktif:</strong> Selama akun Anda masih aktif</li>
                                <li><strong>Riwayat Transaksi:</strong> Minimal 5 tahun sesuai regulasi</li>
                                <li><strong>Data Komunikasi:</strong> 2 tahun setelah komunikasi terakhir</li>
                                <li><strong>Log Sistem:</strong> 1 tahun untuk tujuan keamanan</li>
                            </ul>
                            <p class="mt-4">
                                Setelah periode retensi, data akan dihapus secara permanen kecuali 
                                diwajibkan oleh hukum untuk disimpan lebih lama.
                            </p>
                        </div>
                    </section>

                    <!-- Hak Pengguna -->
                    <section class="mb-8">
                        <h2 class="text-2xl font-bold text-red-600 mb-4">8. Hak Pengguna</h2>
                        <div class="text-gray-700">
                            <p class="mb-4">Anda memiliki hak untuk:</p>
                            <ul class="list-disc list-inside ml-4 space-y-2">
                                <li><strong>Akses:</strong> Melihat data pribadi yang kami miliki</li>
                                <li><strong>Perbaikan:</strong> Memperbarui atau memperbaiki data yang tidak akurat</li>
                                <li><strong>Penghapusan:</strong> Meminta penghapusan data pribadi</li>
                                <li><strong>Portabilitas:</strong> Mendapatkan salinan data dalam format yang dapat dibaca</li>
                                <li><strong>Objection:</strong> Menolak penggunaan data untuk tujuan tertentu</li>
                                <li><strong>Withdraw Consent:</strong> Mencabut persetujuan yang sudah diberikan</li>
                            </ul>
                            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded mt-4">
                                <p class="text-blue-800 font-semibold">Cara Menggunakan Hak Anda:</p>
                                <p class="text-blue-700">Hubungi kami melalui email: privacy@kosthonest.com atau melalui pengaturan akun Anda.</p>
                            </div>
                        </div>
                    </section>

                    <!-- Cookies -->
                    <section class="mb-8">
                        <h2 class="text-2xl font-bold text-red-600 mb-4">9. Cookies dan Teknologi Tracking</h2>
                        <div class="space-y-4 text-gray-700">
                            <div>
                                <h3 class="font-semibold text-lg mb-2">9.1 Jenis Cookies</h3>
                                <ul class="list-disc list-inside ml-4 space-y-1">
                                    <li><strong>Essential Cookies:</strong> Diperlukan untuk fungsi dasar website</li>
                                    <li><strong>Performance Cookies:</strong> Membantu kami memahami penggunaan platform</li>
                                    <li><strong>Functional Cookies:</strong> Menyimpan preferensi Anda</li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg mb-2">9.2 Mengelola Cookies</h3>
                                <p>Anda dapat mengelola cookies melalui pengaturan browser Anda. Namun, menonaktifkan cookies dapat mempengaruhi fungsi platform.</p>
                            </div>
                        </div>
                    </section>

                    <!-- Perubahan Kebijakan -->
                    <section class="mb-8">
                        <h2 class="text-2xl font-bold text-red-600 mb-4">10. Perubahan Kebijakan Privasi</h2>
                        <p class="text-gray-700 mb-4">
                            Kami dapat memperbarui kebijakan privasi ini dari waktu ke waktu. Perubahan signifikan 
                            akan diberitahukan melalui email atau notifikasi di platform. Tanggal "Terakhir diperbarui" 
                            di bagian atas menunjukkan kapan kebijakan ini terakhir direvisi.
                        </p>
                    </section>

                    <!-- Kontak -->
                    <section class="mb-8">
                        <h2 class="text-2xl font-bold text-red-600 mb-4">11. Hubungi Kami</h2>
                        <p class="text-gray-700 mb-4">
                            Jika Anda memiliki pertanyaan tentang kebijakan privasi ini atau ingin menggunakan 
                            hak privasi Anda, silakan hubungi kami:
                        </p>
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-2">Data Protection Officer</h4>
                                    <ul class="space-y-1 text-gray-700">
                                        <li><strong>Email:</strong> privacy@kosthonest.com</li>
                                        <li><strong>Telepon:</strong> +62 xxx-xxxx-xxxx</li>
                                    </ul>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-2">Alamat Kantor</h4>
                                    <p class="text-gray-700">[Alamat Lengkap Kost Honest]</p>
                                    <p class="text-gray-700">Indonesia</p>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 mt-8 pt-6 border-t border-gray-200">
                    <a href="{{ route('register') }}" 
                       class="flex-1 bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors text-center">
                        Kembali ke Registrasi
                    </a>
                    <a href="{{ route('terms') }}" 
                       class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-6 rounded-lg transition-colors text-center">
                        Lihat Syarat & Ketentuan
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection