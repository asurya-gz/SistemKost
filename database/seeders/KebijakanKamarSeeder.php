<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KebijakanKamar;

class KebijakanKamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kebijakan = [
            'Pembayaran sewa dilakukan setiap bulan dimuka, maksimal tanggal 5 setiap bulan',
            'Check-in mulai pukul 08.00 WIB dan check-out maksimal pukul 12.00 WIB',
            'Tidak diperkenankan membawa tamu menginap tanpa izin pengelola',
            'Dilarang keras membawa minuman beralkohol dan obat-obatan terlarang',
            'Jam malam untuk tamu maksimal pukul 22.00 WIB',
            'Wajib menjaga kebersihan kamar dan area bersama',
            'Kerusakan fasilitas kamar menjadi tanggung jawab penghuni',
            'Dilarang merokok di dalam kamar dan area bersama',
            'Penggunaan listrik berlebihan akan dikenakan biaya tambahan',
            'Deposit keamanan sebesar Rp 500.000 (dapat dikembalikan)',
            'Pemberitahuan keluar kost minimal 1 bulan sebelumnya',
            'Dilarang menggunakan alat masak di dalam kamar'
        ];

        foreach ($kebijakan as $deskripsi) {
            KebijakanKamar::create([
                'deskripsi' => $deskripsi
            ]);
        }
    }
}
