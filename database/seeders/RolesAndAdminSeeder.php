<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolesAndAdminSeeder extends Seeder
{
    public function run(): void
    {
        // Crear roles
        $adminRole  = Role::firstOrCreate(['name' => 'admin',  'guard_name' => 'web']);
        $editorRole = Role::firstOrCreate(['name' => 'editor', 'guard_name' => 'web']);

        // Crear usuario admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@landingadmin.com'],
            [
                'name'     => 'Administrador',
                'password' => bcrypt('Admin1234!'),
            ]
        );

        $admin->assignRole($adminRole);

        // Crear usuario editor de prueba
        $editor = User::firstOrCreate(
            ['email' => 'editor@landingadmin.com'],
            [
                'name'     => 'Editor',
                'password' => bcrypt('Editor1234!'),
            ]
        );

        $editor->assignRole($editorRole);

        $this->command->info('✅ Roles y usuarios creados correctamente');
    }
}