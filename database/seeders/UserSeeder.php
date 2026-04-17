<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Kelas;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $kelasPertama = Kelas::first();
        $kelasKedua = Kelas::skip(1)->first();

        $idKelas1 = $kelasPertama ? $kelasPertama->id : 1;
        $idKelas2 = $kelasKedua ? $kelasKedua->id : 2;

        // --- 1. DATA DOSEN ---
        User::create([
            'role_id'       => 1, 
            'nama'          => 'Dandy Prasetyo Ramadhan',
            'email'         => 'dandy@dosen.com',
            'password'      => Hash::make('password123'),
            'NIDN'          => '1234567890',
            'jenis_kelamin' => 'L', // Tambahkan di sini
        ]);

        // --- 2. DATA MAHASISWA 2024 ---
        $mhs24 = [
            ['nim' => '24001', 'nama' => 'Budi Setiadi', 'jk' => 'L'],
            ['nim' => '24002', 'nama' => 'Siti Aminah', 'jk' => 'P'],
            ['nim' => '24003', 'nama' => 'Randi Pangalila', 'jk' => 'L'],
            ['nim' => '24004', 'nama' => 'Lestari Putri', 'jk' => 'P'],
            ['nim' => '24005', 'nama' => 'Dewo Sasmito', 'jk' => 'L'],
        ];

        foreach ($mhs24 as $data) {
            $user = User::create([
                'role_id'       => 3,
                'nama'          => $data['nama'],
                'email'         => strtolower(str_replace(' ', '', $data['nama'])) . '@mhs.com',
                'password'      => Hash::make($data['nim']),
                'jenis_kelamin' => $data['jk'], // Pindah ke sini
            ]);

            Mahasiswa::create([
                'user_id'  => $user->id,
                'kelas_id' => $idKelas1,
                'nim'      => $data['nim'],
                'jurusan'  => 'Teknik Informatika',
                'angkatan' => '2024',
                // 'jenis_kelamin' di tabel mahasiswa sudah tidak perlu diisi (bisa dihapus di migration mahasiswa)
            ]);
        }

        // --- 3. DATA MAHASISWA 2023 ---
        $mhs23 = [
            ['nim' => '23001', 'nama' => 'Ahmad Fauzi', 'jk' => 'L'],
            ['nim' => '23002', 'nama' => 'Rina Nose', 'jk' => 'P'],
            ['nim' => '23003', 'nama' => 'Gading Marten', 'jk' => 'L'],
            ['nim' => '23004', 'nama' => 'Nagita Slavina', 'jk' => 'P'],
            ['nim' => '23005', 'nama' => 'Raffi Ahmad', 'jk' => 'L'],
        ];

        foreach ($mhs23 as $data) {
            $user = User::create([
                'role_id'       => 3,
                'nama'          => $data['nama'],
                'email'         => strtolower(str_replace(' ', '', $data['nama'])) . '@mhs.com',
                'password'      => Hash::make($data['nim']),
                'jenis_kelamin' => $data['jk'], // Pindah ke sini
            ]);

            Mahasiswa::create([
                'user_id'  => $user->id,
                'kelas_id' => $idKelas2,
                'nim'      => $data['nim'],
                'jurusan'  => 'Sistem Informasi',
                'angkatan' => '2023',
            ]);
        }
    }
}