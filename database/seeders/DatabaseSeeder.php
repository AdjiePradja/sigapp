<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->admin()->create([
            'name' => 'Admin HSE',
            'username' => 'admin',
            'password' => bcrypt('admin'),
        ]);

        User::factory()->create([
            'name' => 'Jamal',
            'username' => 'jamal',
            'dept' => 'Produksi',
            'password' => bcrypt('jamal'),
        ]);
    }
}
