<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'password' => bcrypt('password123'),
            'nama' => 'Administrator',
            'role' => 'admin',
        ]);

        User::create([
            'username' => 'user',
            'password' => bcrypt('user123'),
            'nama' => 'User Test',
            'role' => 'user',
        ]);
    }
}
