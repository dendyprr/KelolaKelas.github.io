<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['id' => 1, 'nama' => 'Dosen'],
            ['id' => 2, 'nama' => 'Admin'],
            ['id' => 3, 'nama' => 'Mahasiswa'],
        ];

        // Menggunakan insert agar ID yang kita tentukan (1 & 2) tetap konsisten
        DB::table('master_role')->insert($roles);
    }
}