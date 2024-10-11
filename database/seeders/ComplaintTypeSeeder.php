<?php

namespace Database\Seeders;

use App\Models\ComplaintType;
use Illuminate\Database\Seeder;

class ComplaintTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ComplaintType::create([
            'name' => 'Complaint Type 1'
        ]);


        ComplaintType::create([
            'name' => 'Complaint Type 2'
        ]);

        ComplaintType::create([
            'name' => 'Complaint Type 3'
        ]);

        ComplaintType::create([
            'name' => 'Complaint Type 4'
        ]);

        ComplaintType::create([
            'name' => 'Complaint Type 5'
        ]);
    }
}
