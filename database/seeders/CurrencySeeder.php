<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::create([
            'name' => 'AED'
        ]);

        Currency::create([
            'name' => 'USD'
        ]);

        Currency::create([
            'name' => 'PKR'
        ]);
    }
}
