<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypeKamar;
use App\Models\KebijakanKamar;
use App\Models\Kamar;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        // Get all type kamar for filter
        $roomTypes = TypeKamar::all();
        $selectedType = $request->get('type', 'all');
        $selectedStatus = $request->get('status', 'all');
        
        // Build query
        $query = Kamar::with('typeKamar');
        
        // Filter by type
        if ($selectedType !== 'all') {
            $query->whereHas('typeKamar', function($q) use ($selectedType) {
                $q->where('nama', $selectedType);
            });
        }
        
        // Filter by status
        if ($selectedStatus !== 'all') {
            $query->where('status_kamar', $selectedStatus);
        }
        
        $rooms = $query->get();
        
        // Available statuses
        $roomStatuses = ['Tersedia', 'Booked', 'Dihuni'];
        
        return view('rooms.index', compact('rooms', 'roomTypes', 'selectedType', 'selectedStatus', 'roomStatuses'));
    }

    public function roomTypes()
    {
        $roomTypes = TypeKamar::with('gambarTypeKamar')->get();
        return view('rooms.types', compact('roomTypes'));
    }
    
    private function generateRoomsData()
    {
        $roomsData = [];
        $statuses = ['available', 'booked', 'occupied'];
        
        // Standard rooms (101-120)
        for ($i = 101; $i <= 120; $i++) {
            $roomsData[] = [
                'number' => $i,
                'type' => 'standard',
                'name' => 'Standard Room',
                'price' => 800000,
                'status' => $statuses[array_rand($statuses)],
                'image' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=400&h=300&fit=crop&crop=center',
                'size' => '3x3m',
                'bed' => 'Single Bed',
                'facilities' => ['WiFi', 'Kamar Mandi Dalam', 'Lemari', 'Meja Kerja']
            ];
        }
        
        // Deluxe rooms (201-215)
        for ($i = 201; $i <= 215; $i++) {
            $roomsData[] = [
                'number' => $i,
                'type' => 'deluxe',
                'name' => 'Deluxe Room',
                'price' => 1200000,
                'status' => $statuses[array_rand($statuses)],
                'image' => 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=400&h=300&fit=crop&crop=center',
                'size' => '3x4m',
                'bed' => 'Queen Bed',
                'facilities' => ['AC', 'WiFi Premium', 'Kamar Mandi Dalam', 'Balkon', 'Smart TV']
            ];
        }
        
        // VIP rooms (301-310)
        for ($i = 301; $i <= 310; $i++) {
            $roomsData[] = [
                'number' => $i,
                'type' => 'vip',
                'name' => 'VIP Room',
                'price' => 1800000,
                'status' => $statuses[array_rand($statuses)],
                'image' => 'https://images.unsplash.com/photo-1571508601891-ca5e7a713859?w=400&h=300&fit=crop&crop=center',
                'size' => '4x5m',
                'bed' => 'King Bed',
                'facilities' => ['AC Premium', 'Mini Kitchen', 'Kamar Mandi Mewah', 'Balkon Luas', 'Smart TV 50"', 'Kulkas Pribadi']
            ];
        }
        
        return $roomsData;
    }
    
    public function detail($kamarId)
    {
        $kamar = Kamar::with('typeKamar')->find($kamarId);
        
        if (!$kamar) {
            abort(404);
        }
        
        // Get kebijakan for this room
        $kebijakan = $kamar->getKebijakanKamar();
        
        return view('rooms.detailed', compact('kamar', 'kebijakan'));
    }
    
    private function getRoomTypeData($type)
    {
        $roomData = [
            'standard' => [
                'description' => 'Kamar nyaman dengan fasilitas dasar yang lengkap untuk kebutuhan sehari-hari.',
                'fasilitas_kost' => [
                    'WiFi gratis 24 jam',
                    'Listrik & air termasuk',
                    'Keamanan 24 jam',
                    'Area parkir motor',
                    'Dapur bersama',
                    'Ruang tamu bersama'
                ],
                'fasilitas_kamar' => [
                    'Kasur single + lemari',
                    'Kamar mandi dalam',
                    'Meja dan kursi belajar',
                    'Ventilasi yang baik',
                    'Kunci kamar pribadi',
                    'Jendela dengan cahaya alami'
                ],
                'images' => [
                    'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=800&h=500&fit=crop&crop=center',
                    'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=800&h=500&fit=crop&crop=center',
                    'https://images.unsplash.com/photo-1571508601891-ca5e7a713859?w=800&h=500&fit=crop&crop=center'
                ]
            ],
            'deluxe' => [
                'description' => 'Kamar luas dengan fasilitas premium dan pemandangan yang menarik.',
                'fasilitas_kost' => [
                    'WiFi premium 100 Mbps',
                    'Listrik & air unlimited',
                    'Keamanan 24 jam + CCTV',
                    'Area parkir motor & mobil',
                    'Laundry service',
                    'Cleaning service mingguan',
                    'Gym & area rekreasi'
                ],
                'fasilitas_kamar' => [
                    'Kasur queen size + lemari besar',
                    'AC + kamar mandi dalam',
                    'Meja kerja + kursi ergonomis',
                    'Akses balkon pribadi',
                    'Smart TV 32 inch',
                    'Mini kulkas',
                    'Safe box pribadi'
                ],
                'images' => [
                    'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=800&h=500&fit=crop&crop=center',
                    'https://images.unsplash.com/photo-1571508601891-ca5e7a713859?w=800&h=500&fit=crop&crop=center',
                    'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=800&h=500&fit=crop&crop=center'
                ]
            ],
            'vip' => [
                'description' => 'Kamar premium dengan fasilitas mewah dan service eksklusif.',
                'fasilitas_kost' => [
                    'WiFi dedicated 200 Mbps',
                    'Listrik & air unlimited premium',
                    'Keamanan 24 jam + akses kartu',
                    'Valet parking service',
                    'Concierge & room service',
                    'Laundry & dry cleaning',
                    'Gym, spa & rooftop pool',
                    'Business center'
                ],
                'fasilitas_kamar' => [
                    'Kasur king size + furniture premium',
                    'AC premium + kamar mandi mewah',
                    'Mini kitchen + kulkas besar',
                    'Smart TV 50 inch + sound system',
                    'Sofa set & coffee table',
                    'Balkon dengan view kota',
                    'Walk-in closet',
                    'Smart home automation'
                ],
                'images' => [
                    'https://images.unsplash.com/photo-1571508601891-ca5e7a713859?w=800&h=500&fit=crop&crop=center',
                    'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=800&h=500&fit=crop&crop=center',
                    'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=800&h=500&fit=crop&crop=center'
                ]
            ]
        ];
        
        return $roomData[$type] ?? [];
    }

    public function show($type)
    {
        // Try to find room type by name (case insensitive)
        $typeKamar = TypeKamar::with('gambarTypeKamar')->whereRaw('LOWER(nama) = ?', [strtolower($type)])->first();
        
        if (!$typeKamar) {
            abort(404);
        }

        // Get images from the relationship
        $images = $typeKamar->gambarTypeKamar->where('is_published', true)->map(function($gambar) {
            return $gambar->url;
        })->toArray();
        
        // If no images found, use fallback images
        if (empty($images)) {
            $images = [
                'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=800&h=500&fit=crop&crop=center',
                'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=800&h=500&fit=crop&crop=center',
                'https://images.unsplash.com/photo-1571508601891-ca5e7a713859?w=800&h=500&fit=crop&crop=center'
            ];
        }

        // Convert TypeKamar model to array format expected by the view
        $room = [
            'name' => $typeKamar->nama,
            'description' => $typeKamar->deskripsi,
            'size' => $typeKamar->ukuran_kamar,
            'bed' => $typeKamar->type_kasur,
            'price' => $typeKamar->harga,
            'fasilitas_kost' => $typeKamar->fasilitas_kost ?? [],
            'fasilitas_kamar' => $typeKamar->fasilitas_kamar ?? [],
            'images' => $images,
            'type' => strtolower($type)
        ];

        // Get kebijakan from database
        $kebijakan = KebijakanKamar::all();
        
        return view('rooms.detail', compact('room', 'kebijakan'));
    }
}
