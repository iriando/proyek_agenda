<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'taufik',
            'email' => 'taufik.iriando@gmail.com',
            'password' => bcrypt('taufik112166'),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'dian',
            'email' => 'dian@gmail.com',
            'password' => bcrypt('dian12345'),
        ]);

        \App\Models\Agenda::create([
            'judul' => 'Agenda 1',
            'deskripsi' => 'ya begitulah',
            'zoomlink' => 'ini zoom link',
            'tanggal_pelaksanaan' => '2025-02-08',
            'status' => 1,
        ]);
    }
}
