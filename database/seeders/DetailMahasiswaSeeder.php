<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Kelas;

class DetailMahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Ambil ID Kelas secara spesifik dari database
        // Pastikan di KelasSeeder kamu datanya cocok (2025 Ganjil & 2026 Genap)
        $kelasGanjil2025 = Kelas::where('tahun_ajaran', '2025')
                                ->where('periode', 'Ganjil')
                                ->first();

        $kelasGenap2026 = Kelas::where('tahun_ajaran', '2026')
                               ->where('periode', 'Genap')
                               ->first();

        // 2. Ambil semua user yang rolenya mahasiswa (Role ID 3)
        $users = User::where('role_id', 3)->get();

        foreach ($users as $index => $user) {
            // Logika Pembagian:
            // Setengah user pertama masuk ke 2025 Ganjil
            // Setengah sisanya masuk ke 2026 Genap
            if ($index < 5) {
                Mahasiswa::create([
                    'user_id'  => $user->id,
                    'kelas_id' => $kelasGanjil2025->id ?? 1, // Fallback ke 1 jika null
                    'nim'      => '25' . str_pad($index + 1, 3, '0', STR_PAD_LEFT), // Hasil: 25001
                    'jurusan'  => 'Teknik Informatika',
                    'angkatan' => '2025',
                ]);
            } else {
                Mahasiswa::create([
                    'user_id'  => $user->id,
                    'kelas_id' => $kelasGenap2026->id ?? 2, // Fallback ke 2 jika null
                    'nim'      => '26' . str_pad($index + 1, 3, '0', STR_PAD_LEFT), // Hasil: 26006
                    'jurusan'  => 'Sistem Informasi',
                    'angkatan' => '2026',
                ]);
            }
        }
    }
}