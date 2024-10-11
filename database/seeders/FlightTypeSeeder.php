<?php

namespace Database\Seeders;

use App\Models\FlightType;
use Illuminate\Database\Seeder;

class FlightTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FlightType ::create([
            'name' => 'Flight Type 1'
        ]);

        FlightType ::create([
            'name' => 'Flight Type 2'
        ]);

        FlightType ::create([
            'name' => 'Flight Type 3'
        ]);

        FlightType ::create([
            'name' => 'Flight Type 4'
        ]);

        FlightType ::create([
            'name' => 'Flight Type 5'
        ]);
    }
}
