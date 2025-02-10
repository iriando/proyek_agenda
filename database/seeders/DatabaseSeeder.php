<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $userAdmin = User::factory()->create([
            'name' => 'taufik',
            'email' => 'taufik.iriando@gmail.com',
            'password' => bcrypt('taufik112166'),
        ]);

        \App\Models\Agenda::create([
            'judul' => 'Agenda 1',
            'deskripsi' => 'ya begitulah',
            'zoomlink' => 'ini zoom link',
            'tanggal_pelaksanaan' => '2025-02-08',
            'status' => 1,
        ]);

        \App\Models\Agenda::create([
            'judul' => 'Agenda 1',
            'deskripsi' => 'ya begitulah',
            'zoomlink' => 'ini zoom link',
            'tanggal_pelaksanaan' => '2025-02-08',
            'status' => 1,
        ]);

        $permissions = [
            'view users',
            'create users',
            'edit users',
            'delete users',
            'restore users',
            'force delete users'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        // Assign permission ke role admin
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $adminRole->givePermissionTo($permissions);
        $userAdmin->assignRole('admin');
    }
}
