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
            'password' => bcrypt('admin123'),
            'nama' => 'Administrator',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);

        User::create([
            'username' => 'siswa1',
            'password' => bcrypt('siswa123'),
            'nama' => 'Siswa Demo',
            'email' => 'siswa1@example.com',
            'nis' => '20230001',
            'kelas' => '10',
            'role' => 'siswa',
        ]);
    }
}
