<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $user->status = 'Activo';
        $user->fullname = 'Jhon Wick';
        $user->gender = 'Male';
        $user->photo = fake()->image(public_path('images/'), 140, 140, null, false);
        $user->phone = '3257852148';
        $user->address = 'Carrera 12 B # 45-21';
        $user->email = 'scubides58@soy.sena.edu.co';
        $user->password = bcrypt('admin');
        $user->save();
    }
}
