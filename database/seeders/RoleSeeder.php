<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Administrador'],
            ['name' => 'Conductor'],
            ['name' => 'Estudiante'],
            ['name' => 'Tutor'],
        ];

        foreach ($roles as $role) {
            $roleModel = Role::firstOrNew($role);
            if (!$roleModel->exists) {
                $roleModel->save();
            }
        }
    }
}
