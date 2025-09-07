<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ManageGambar;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galleries = [
            [
                'type' => 'galeri',
                'nama_file' => 'tampak-depan-kost.jpg',
                'path' => 'https://images.unsplash.com/photo-1555854877-bab0e564b8d5?w=800&h=500&fit=crop&crop=center',
                'judul' => 'Tampak Depan Kost Honest',
                'alt_text' => 'Tampak depan bangunan kost honest',
                'deskripsi' => 'Bangunan modern dengan akses mudah dan lokasi strategis untuk kemudahan penghuni kost',
                'is_published' => true,
                'urutan' => 1
            ],
            [
                'type' => 'galeri',
                'nama_file' => 'kamar-tidur-nyaman.jpg',
                'path' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=800&h=500&fit=crop&crop=center',
                'judul' => 'Kamar Tidur Nyaman',
                'alt_text' => 'Interior kamar tidur yang nyaman',
                'deskripsi' => 'Kamar dengan tempat tidur yang nyaman, dilengkapi lemari dan meja belajar untuk kenyamanan penghuni',
                'is_published' => true,
                'urutan' => 2
            ],
            [
                'type' => 'galeri',
                'nama_file' => 'dapur-bersama-modern.jpg',
                'path' => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=800&h=500&fit=crop&crop=center',
                'judul' => 'Dapur Bersama Modern',
                'alt_text' => 'Dapur bersama yang modern dan lengkap',
                'deskripsi' => 'Dapur bersama yang modern dan bersih dengan peralatan masak lengkap untuk kebutuhan sehari-hari',
                'is_published' => true,
                'urutan' => 3
            ],
            [
                'type' => 'galeri',
                'nama_file' => 'kamar-mandi-bersih.jpg',
                'path' => 'https://images.unsplash.com/photo-1552321554-5fefe8c9ef14?w=800&h=500&fit=crop&crop=center',
                'judul' => 'Kamar Mandi Bersih',
                'alt_text' => 'Kamar mandi yang bersih dan terawat',
                'deskripsi' => 'Fasilitas kamar mandi yang bersih dan terawat dengan air panas 24 jam untuk kenyamanan penghuni',
                'is_published' => true,
                'urutan' => 4
            ],
            [
                'type' => 'galeri',
                'nama_file' => 'area-santai.jpg',
                'path' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=800&h=500&fit=crop&crop=center',
                'judul' => 'Area Santai',
                'alt_text' => 'Area santai bersama penghuni',
                'deskripsi' => 'Ruang santai bersama yang nyaman untuk berkumpul dan bersosialisasi dengan sesama penghuni kost',
                'is_published' => true,
                'urutan' => 5
            ],
            [
                'type' => 'galeri',
                'nama_file' => 'area-parkir-luas.jpg',
                'path' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&h=500&fit=crop&crop=center',
                'judul' => 'Area Parkir Luas',
                'alt_text' => 'Area parkir yang luas dan aman',
                'deskripsi' => 'Area parkir yang luas dan aman untuk motor dan mobil penghuni dengan sistem keamanan 24 jam',
                'is_published' => true,
                'urutan' => 6
            ]
        ];

        foreach ($galleries as $gallery) {
            ManageGambar::create($gallery);
        }

        echo count($galleries) . " galeri gambar berhasil dibuat.\n";
    }
}