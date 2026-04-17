<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\DB;

class KelasMahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil ID Kelas secara langsung (Ambil 2 kelas pertama)
        $semuaKelas = Kelas::limit(2)->get();
        
        if ($semuaKelas->isEmpty()) {
            $this->command->error("Data KELAS tidak ditemukan! Jalankan KelasSeeder dulu.");
            return;
        }

        $kelasSatu = $semuaKelas->first();
        $kelasDua = $semuaKelas->last();

        // Ambil Mahasiswa angkatan 2024 untuk Kelas Pertama
        $mhs24 = Mahasiswa::where('angkatan', '2024')->get();
        foreach ($mhs24 as $m) {
            // Kita pakai DB table insert agar lebih 'mentah' dan pasti masuk
            DB::table('kelas_mahasiswas')->updateOrInsert(
                ['kelas_id' => $kelasSatu->id, 'mahasiswa_id' => $m->id],
                ['created_at' => now(), 'updated_at' => now()]
            );
        }

        // Ambil Mahasiswa angkatan 2023 untuk Kelas Kedua
        $mhs23 = Mahasiswa::where('angkatan', '2023')->get();
        foreach ($mhs23 as $m) {
            DB::table('kelas_mahasiswas')->updateOrInsert(
                ['kelas_id' => $kelasDua->id, 'mahasiswa_id' => $m->id],
                ['created_at' => now(), 'updated_at' => now()]
            );
        }

        $this->command->info("Berhasil menghubungkan mahasiswa ke kelas!");
    }
}