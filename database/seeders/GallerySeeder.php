<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gallery;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galleries = [
            [
                'url_foto' => 'https://images.unsplash.com/photo-1555854877-bab0e564b8d5?w=800&h=500&fit=crop&crop=center',
                'nama' => 'Tampak Depan Kost Honest',
                'deskripsi' => 'Bangunan modern dengan akses mudah dan lokasi strategis untuk kemudahan penghuni kost'
            ],
            [
                'url_foto' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=800&h=500&fit=crop&crop=center',
                'nama' => 'Kamar Tidur Nyaman',
                'deskripsi' => 'Kamar dengan tempat tidur yang nyaman, dilengkapi lemari dan meja belajar untuk kenyamanan penghuni'
            ],
            [
                'url_foto' => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=800&h=500&fit=crop&crop=center',
                'nama' => 'Dapur Bersama Modern',
                'deskripsi' => 'Dapur bersama yang modern dan bersih dengan peralatan masak lengkap untuk kebutuhan sehari-hari'
            ],
            [
                'url_foto' => 'https://images.unsplash.com/photo-1552321554-5fefe8c9ef14?w=800&h=500&fit=crop&crop=center',
                'nama' => 'Kamar Mandi Bersih',
                'deskripsi' => 'Fasilitas kamar mandi yang bersih dan terawat dengan air panas 24 jam untuk kenyamanan penghuni'
            ],
            [
                'url_foto' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=800&h=500&fit=crop&crop=center',
                'nama' => 'Area Santai',
                'deskripsi' => 'Ruang santai bersama yang nyaman untuk berkumpul dan bersosialisasi dengan sesama penghuni kost'
            ],
            [
                'url_foto' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&h=500&fit=crop&crop=center',
                'nama' => 'Area Parkir Luas',
                'deskripsi' => 'Area parkir yang luas dan aman untuk motor dan mobil penghuni dengan sistem keamanan 24 jam'
            ]
        ];

        foreach ($galleries as $gallery) {
            Gallery::create($gallery);
        }
    }
}