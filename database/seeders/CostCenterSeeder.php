<?php

namespace Database\Seeders;

use App\Models\CostCenter;
use Illuminate\Database\Seeder;

class CostCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CostCenter::create([
            'title' => 'test cost center',
            'status' => 1,
        ]);
    }
}
