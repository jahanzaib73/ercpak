<?php

namespace Database\Seeders;

use App\Models\RemainderType;
use Illuminate\Database\Seeder;

class RemainderTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RemainderType::create([
            'name' => 'Document Expiry'
        ]);
        RemainderType::create([
            'name' => 'Reminder'
        ]);
        RemainderType::create([
            'name' => 'Bills'
        ]);

    }
}
