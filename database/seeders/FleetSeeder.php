<?php

namespace Database\Seeders;

use App\Models\FuelType;
use App\Models\VehicleMake;
use App\Models\VehicleModel;
use App\Models\VehicleType;
use Illuminate\Database\Seeder;

class FleetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VehicleMake::insert(
           [
            [
                'name' => 'CIVIC',
                'status' => 1
                ],
                [
                'name' => 'Honda',
                'status' => 1
                ],
                [
                'name' => 'Fortuner',
                'status' => 1
                ],
                [
                'name' => 'Elentra',
                'status' => 1
                ]
           ]
        );

        VehicleType::insert(
            [
                [
                    'name' => 'Bus',
                    'status' => 1
                    ],
                    [
                    'name' => 'Truck',
                    'status' => 1
                    ],
                    [
                    'name' => 'CAR',
                    'status' => 1
                    ],
                    [
                    'name' => 'HighRoof',
                    'status' => 1
                    ]
            ]
        );

        $years = range(1990, 2023);
        foreach($years as $year){
            VehicleModel::insert(
                [
                'name' => $year,
                'status' => 1
                ]
            );
        }

        FuelType::insert(
            [
                [
                    'name' => 'Dessel',
                    'status' => 1
                    ],
                    [
                    'name' => 'Petrol',
                    'status' => 1
                    ],
                    [
                    'name' => 'Super',
                    'status' => 1
                    ]
            ]
        );

    }
}
