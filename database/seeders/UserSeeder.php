<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Array nama-nama untuk seeder
        $names = [
            'Ahmad Ridwan', 'Siti Nurhaliza', 'Budi Santoso', 'Dewi Lestari', 'Eko Prasetyo',
            'Fitri Ramadhani', 'Gandi Wijaya', 'Hana Kartika', 'Indra Gunawan', 'Joko Widodo',
            'Kartini Sari', 'Lukman Hakim', 'Maya Anggraini', 'Nanda Pratama', 'Olla Ramlan',
            'Putra Mahendra', 'Qori Sandioriva', 'Rina Susanti', 'Sigit Rendang', 'Tari Jelita',
            'Umar Bakrie', 'Vina Panduwinata', 'Wahyu Hidayat', 'Xenia Gratia', 'Yuni Shara'
        ];

        foreach ($names as $index => $name) {
            User::create([
                'name' => $name,
                'email' => strtolower(str_replace(' ', '.', $name)) . '@kostpengguna.com',
                'role' => 'pengguna',
                'password' => Hash::make('honest123_'),
                'created_at' => now()->subDays(rand(1, 30)),
                'updated_at' => now()->subDays(rand(0, 5)),
            ]);
        }

        $this->command->info('25 pengguna berhasil dibuat.');
    }
}
