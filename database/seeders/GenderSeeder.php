<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genders = [
            ['gender' => 'Male'],
            ['gender' => 'Female']
        ];


        foreach ($genders as $gender) {
            $genderModel = Gender::firstOrNew($gender);
            if (!$genderModel->exists) {
                $genderModel->save();
            }
        }

    }
}
