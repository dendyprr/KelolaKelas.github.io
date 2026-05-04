<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // --- 1. DATA DOSEN ---
        // Kita paksa ID 1 agar KelasSeeder pasti bisa nempel ke ID ini
        User::create([
            'id'            => 1,
            'role_id'       => 1, // Role Dosen
            'nama'          => 'Dandy Prasetyo Ramadhan',
            'email'         => 'dandy@dosen.com',
            'password'      => Hash::make('pov123'),
            'NIDN'          => '1234567890',
            'jenis_kelamin' => 'L',
        ]);

        // --- 2. DATA MAHASISWA 2024 ---
        $mhs24 = [
            ['nim' => '26001', 'nama' => 'Hani Sarwendah', 'jk' => 'L'],
            ['nim' => '26002', 'nama' => 'Siti Aminah', 'jk' => 'P'],
            ['nim' => '26003', 'nama' => 'Randi Pangalila', 'jk' => 'L'],
            ['nim' => '26004', 'nama' => 'Lestari Putri', 'jk' => 'P'],
            ['nim' => '26005', 'nama' => 'Dewo Sasmito', 'jk' => 'L'],
        ];

        // --- 3. DATA MAHASISWA 2023 ---
        $mhs23 = [
            ['nim' => '26001', 'nama' => 'Ahmad Fauzi', 'jk' => 'L'],
            ['nim' => '26002', 'nama' => 'Rina Nose', 'jk' => 'P'],
            ['nim' => '26003', 'nama' => 'Gading Marten', 'jk' => 'L'],
            ['nim' => '26004', 'nama' => 'Nagita Slavina', 'jk' => 'P'],
            ['nim' => '26005', 'nama' => 'Raffi Ahmad', 'jk' => 'L'],
        ];

        $allMhs = array_merge($mhs24, $mhs23);

        foreach ($allMhs as $data) {
            User::create([
                'role_id'       => 3, // Role Mahasiswa
                'nama'          => $data['nama'],
                'email'         => strtolower(str_replace(' ', '', $data['nama'])) . '@mhs.com',
                'password'      => Hash::make($data['nim']),
                'jenis_kelamin' => $data['jk'],
            ]);
        }
    }
}