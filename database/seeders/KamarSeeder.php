<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kamar;
use App\Models\TypeKamar;

class KamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the Regular type kamar ID
        $regularType = TypeKamar::where('nama', 'Regular')->first();
        
        if (!$regularType) {
            $this->command->error('Type kamar Regular not found. Please run TypeKamarSeeder first.');
            return;
        }

        $statuses = ['Tersedia', 'Booked', 'Dihuni'];
        
        // Generate sample rooms
        $rooms = [
            ['nama' => 'A1', 'status' => 'Tersedia'],
            ['nama' => 'A2', 'status' => 'Dihuni'],
            ['nama' => 'A3', 'status' => 'Tersedia'],
            ['nama' => 'A4', 'status' => 'Booked'],
            ['nama' => 'A5', 'status' => 'Tersedia'],
            ['nama' => 'B1', 'status' => 'Dihuni'],
            ['nama' => 'B2', 'status' => 'Tersedia'],
            ['nama' => 'B3', 'status' => 'Tersedia'],
            ['nama' => 'B4', 'status' => 'Dihuni'],
            ['nama' => 'B5', 'status' => 'Booked'],
            ['nama' => 'C1', 'status' => 'Tersedia'],
            ['nama' => 'C2', 'status' => 'Tersedia'],
            ['nama' => 'C3', 'status' => 'Dihuni'],
            ['nama' => 'C4', 'status' => 'Tersedia'],
            ['nama' => 'C5', 'status' => 'Booked'],
        ];

        // Sample kebijakan IDs (first 5 kebijakan for each room)
        $kebijakanIds = [1, 2, 3, 4, 5];

        foreach ($rooms as $room) {
            Kamar::create([
                'nama_kamar' => $room['nama'],
                'type_kamar_id' => $regularType->id,
                'status_kamar' => $room['status'],
                'kebijakan_kamar_ids' => $kebijakanIds
            ]);
        }
    }
}
