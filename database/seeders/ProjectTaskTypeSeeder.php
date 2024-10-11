<?php

namespace Database\Seeders;

use App\Models\ProjectTaskType;
use Illuminate\Database\Seeder;

class ProjectTaskTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectTaskType::create([
            'name' => 'Type 1'
        ]);

        ProjectTaskType::create([
            'name' => 'Type 2'
        ]);

        ProjectTaskType::create([
            'name' => 'Type 3'
        ]);
    }
}
