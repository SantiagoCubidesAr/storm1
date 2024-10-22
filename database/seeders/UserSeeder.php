<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User;
        $user->id_status = 1;
        $user->fullname = 'Jhon Wick';
        $user->photo = fake()->image(public_path('images/'), 140, 140, null, false);
        $user->id_gender = 1;
        $user->phone = '3257852148';
        $user->address = 'Carrera 12 B # 45-21';
        $user->email = 'scubides58@soy.sena.edu.co';
        $user->password = bcrypt('admin');
        $user->save();

        $role = Role::where('name', 'Administrador')->first();
        $user->roles()->attach($role->id);
    }
}
