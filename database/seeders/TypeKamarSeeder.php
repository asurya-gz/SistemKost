<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TypeKamar;

class TypeKamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeKamar::create([
            'nama' => 'Regular',
            'deskripsi' => 'Kamar kost nyaman dengan fasilitas lengkap yang cocok untuk mahasiswa dan pekerja. Dilengkapi dengan toilet dalam, AC, dan akses mudah ke fasilitas bersama.',
            'ukuran_kamar' => '3 x 5m',
            'type_kasur' => 'Single Bed',
            'harga' => 1300000,
            'gambar' => [
                'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=800&h=500&fit=crop&crop=center',
                'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=800&h=500&fit=crop&crop=center',
                'https://images.unsplash.com/photo-1571508601891-ca5e7a713859?w=800&h=500&fit=crop&crop=center'
            ],
            'fasilitas_kost' => [
                'Parkir Motor',
                'Toilet bersama (Jumlah: 1)',
                'CCTV',
                'Dapur, kulkas, dan meja makan bersama',
                'Tempat jemuran (ada di lantai paling atas)'
            ],
            'fasilitas_kamar' => [
                'Tempat tidur',
                'AC',
                'Meja + kursi',
                'Lemari',
                'Toilet dalam',
                'Ventilasi',
                'Jendela + korden'
            ]
        ]);
    }
}
