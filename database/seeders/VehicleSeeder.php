<?php

namespace Database\Seeders;

use App\Models\FuelType;
use App\Models\InspectionChecklist;
use App\Models\VehicleMake;
use App\Models\VehicleModel;
use App\Models\VehicleType;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VehicleMake::insert([
            [
                'name' => 'Vehicle Make 1',
                'status' => 1
            ],
            [
                'name' => 'Vehicle Make 2',
                'status' => 1
            ],
            [
                'name' => 'Vehicle Make 3',
                'status' => 1
            ],
            [
                'name' => 'Vehicle Make 4',
                'status' => 1
            ],
            [
                'name' => 'Vehicle Make 5',
                'status' => 1
            ],

        ]);

        VehicleModel::insert([
            [
                'name' => 'Vehicle Model 1',
                'status' => 1
            ],
            [
                'name' => 'Vehicle Model 2',
                'status' => 1
            ],
            [
                'name' => 'Vehicle Model 3',
                'status' => 1
            ],
            [
                'name' => 'Vehicle Model 4',
                'status' => 1
            ],
            [
                'name' => 'Vehicle Model 5',
                'status' => 1
            ],

        ]);

        VehicleType::insert([
            [
                'name' => 'Vehicle Type 1',
                'status' => 1
            ],
            [
                'name' => 'Vehicle Type 2',
                'status' => 1
            ],
            [
                'name' => 'Vehicle Type 3',
                'status' => 1
            ],
            [
                'name' => 'Vehicle Type 4',
                'status' => 1
            ],
            [
                'name' => 'Vehicle Type 5',
                'status' => 1
            ],

        ]);

        FuelType::insert([
            [
                'name' => 'Fuel Type 1',
                'status' => 1
            ],
            [
                'name' => 'Fuel Type 2',
                'status' => 1
            ],
            [
                'name' => 'Fuel Type 3',
                'status' => 1
            ],
            [
                'name' => 'Fuel Type 4',
                'status' => 1
            ],
            [
                'name' => 'Fuel Type 5',
                'status' => 1
            ],

        ]);

        InspectionChecklist::insert([
            [
                'name' => 'Checklist Item 1',
                'status' => 1
            ],
            [
                'name' => 'Checklist Item 2',
                'status' => 1
            ],
            [
                'name' => 'Checklist Item 3',
                'status' => 1
            ],
            [
                'name' => 'Checklist Item 4',
                'status' => 1
            ],
            [
                'name' => 'Checklist Item 5',
                'status' => 1
            ],

        ]);
    }
}
