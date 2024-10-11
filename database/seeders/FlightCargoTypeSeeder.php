<?php

namespace Database\Seeders;

use App\Models\FlightCargoType;
use Illuminate\Database\Seeder;

class FlightCargoTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FlightCargoType ::create([
            'name' => 'By Air'
        ]);

        FlightCargoType ::create([
            'name' => 'By Sea'
        ]);

        FlightCargoType ::create([
            'name' => 'By Road'
        ]);
    }
}
