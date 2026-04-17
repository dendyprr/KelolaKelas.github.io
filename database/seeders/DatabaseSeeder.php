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
            MasterRoleSeeder::class,
            KelasSeeder::class,
            UserSeeder::class,
            KelasMahasiswaSeeder::class
        ]);

    }
}