<?php

namespace Database\Seeders;

use App\Models\RequestType;
use Illuminate\Database\Seeder;

class RequestTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RequestType::create(['name' => 'Request Type 1']);
        RequestType::create(['name' => 'Request Type 2']);
        RequestType::create(['name' => 'Request Type 3']);
    }
}
