<?php

namespace Database\Seeders;

use App\Models\ProtocolLiaisonType;
use Illuminate\Database\Seeder;

class ProtocolLiaisonTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProtocolLiaisonType ::create([
            'name' => 'Official'
        ]);

        ProtocolLiaisonType ::create([
            'name' => 'Notable'
        ]);

        ProtocolLiaisonType ::create([
            'name' => 'Company'
        ]);

        ProtocolLiaisonType ::create([
            'name' => 'Project'
        ]);
    }
}
