<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\MasterRoleSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            MasterRoleSeeder::class,      // 1. Siapin list perannya (Admin, Dosen, Mhs)
            UserSeeder::class,            // 2. Siapin orangnya (Nempel ke Role)
            KelasSeeder::class,           // 3. Siapin ruangannya (Dosen nempel ke Kelas)
            KelasMahasiswaSeeder::class
        ]);

    }
}