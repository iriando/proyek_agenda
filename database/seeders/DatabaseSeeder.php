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

        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $pemateriRole = Role::firstOrCreate(['name' => 'pemateri', 'guard_name' => 'web']);
        $pesertaRole = Role::firstOrCreate(['name' => 'peserta', 'guard_name' => 'web']);

        $userAdmin = User::create([
            'name' => 'taufik',
            'nip' => '199308012022031001',
            'email' => 'taufik.iriando@gmail.com',
            'password' => bcrypt('taufik112166'),
        ]);

        $pemateri = User::create([
            'name' => 'dian',
            'nip' => '199008012022032001',
            'email' => 'dian@gmail.com',
            'password' => bcrypt('12345'),
        ]);

        $peserta = User::create([
            'name' => 'hendra',
            'nip' => '198702012018011001',
            'email' => 'hendra@gmail.com',
            'password' => bcrypt('12345678'),
        ]);



        \App\Models\Agenda::create([
            'judul' => 'Agenda 1',
            'deskripsi' => 'ya begitulah',
            'zoomlink' => 'ini zoom link',
            'tanggal_pelaksanaan' => '2025-02-08',
        ]);

        $permissions = [
            'view users',
            'create users',
            'edit users',
            'delete users',
            'restore users',
            'force delete users',
            'view roles',
            'create roles',
            'edit roles',
            'delete roles',
            'restore roles',
            'force delete roles',
            'view permission',
            'create permission',
            'edit permission',
            'delete permission',
            'restore permission',
            'force delete permission',
            'view agenda',
            'create agenda',
            'edit agenda',
            'delete agenda',
            'restore agenda',
            'force delete agenda',
            'view materi',
            'create materi',
            'edit materi',
            'delete materi',
            'restore materi',
            'force delete materi',
            'view survey',
            'create survey',
            'edit survey',
            'delete survey',
            'restore survey',
            'force delete survey',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        $permissions2 = [
            'view agenda',
            'delete agenda',
            'view materi',
            'create materi',
            'edit materi',
            'delete materi',
            'restore materi',
            'force delete materi',
            'view survey',
            'create survey',
            'edit survey',
            'delete survey',
            'restore survey',
            'force delete survey',
        ];

        $permissions3 = [
            'view agenda',
            'view materi',
        ];

        // Assign permission ke role admin
        $adminRole->givePermissionTo($permissions);
        $pemateriRole->givePermissionTo($permissions2);
        $pesertaRole->givePermissionTo($permissions3);
        $userAdmin->assignRole('admin');
        $pemateri->assignRole('pemateri');
        $peserta->assignRole('peserta');
    }
}
