<?php

namespace Database\Seeders;

use App\Models\Government;
use Illuminate\Database\Seeder;

class GovernmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Government ::create([
            'name' => 'Federal'
        ]);

        Government ::create([
            'name' => 'Punjab'
        ]);

        Government ::create([
            'name' => 'Sindh'
        ]);

        Government ::create([
            'name' => 'Baluchistan'
        ]);

        Government ::create([
            'name' => 'Kpk'
        ]);
    }
}
