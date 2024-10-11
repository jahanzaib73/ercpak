<?php

namespace Database\Seeders;

use App\Models\AircraftVessel;
use Illuminate\Database\Seeder;

class AirCraftVesselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AircraftVessel::create([
            'name' => 'Aircraft Type 1'
        ]);

        AircraftVessel::create([
            'name' => 'Aircraft Type 2'
        ]);

        AircraftVessel::create([
            'name' => 'Aircraft Type 3'
        ]);

        AircraftVessel::create([
            'name' => 'Aircraft Type 4'
        ]);

        AircraftVessel::create([
            'name' => 'Aircraft Type 5'
        ]);
    }
}
