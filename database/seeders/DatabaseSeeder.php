<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Siswa User',
            'email' => 'mahasiswa@sistem.com',
            'role' => 'mahasiswa',
            'nim' => '1234567890',
            'status' => 'aktif',
            'password' => bcrypt('password')
        ]);

        User::factory()->create([
            'name' => 'Dosen User',
            'email' => 'dosen@sistem.com',
            'role' => 'dosen',
            'status' => 'aktif',
            'password' => bcrypt('password')
        ]);
    }
}
