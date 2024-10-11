<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create([
            'name' => 'First Department'
        ]);

        Department::create([
            'name' => 'Second Department'
        ]);

        Department::create([
            'name' => 'Third Department'
        ]);

        Department::create([
            'name' => 'Fourth Department'
        ]);

        Department::create([
            'name' => 'Fifth Department'
        ]);
    }
}
