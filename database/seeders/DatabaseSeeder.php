<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Membuat satu user spesifik untuk testing
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role' => 'user', // Anda juga bisa menentukan role-nya di sini
        ]);

        // Jika Anda butuh user admin spesifik
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);

        // 2. Membuat 13 user tambahan dengan data random (total akan menjadi 15)
        User::factory(13)->create();
    }
}