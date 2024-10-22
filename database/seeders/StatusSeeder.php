<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status = [
            ['status' => 'Active'],
            ['status' => 'inactive']
        ];


        foreach ($status as $status) {
            $statusModel = Status::firstOrNew($status);
            if (!$statusModel->exists) {
                $statusModel->save();
            }
        }
    }
}
