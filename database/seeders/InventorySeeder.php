<?php

namespace Database\Seeders;

use App\Models\ItemCategory;
use App\Models\ItemMake;
use App\Models\ItemType;
use App\Models\UnitType;
use App\Models\Vendor;
use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ItemType::insert([
            [
                'name' => 'Item Type 1'
            ],
            [
                'name' => 'Item Type 2'
            ],
            [
                'name' => 'Item Type 3'
            ],
            [
                'name' => 'Item Type 4'
            ],
            [
                'name' => 'Item Type 5'
            ],

        ]);

        ItemMake::insert([
            [
                'name' => 'Item Make 1'
            ],
            [
                'name' => 'Item Make 2'
            ],
            [
                'name' => 'Item Make 3'
            ],
            [
                'name' => 'Item Make 4'
            ],
            [
                'name' => 'Item Make 5'
            ],

        ]);

        ItemCategory::insert([
            [
                'name' => 'Item Category 1'
            ],
            [
                'name' => 'Item Category 2'
            ],
            [
                'name' => 'Item Category 3'
            ],
            [
                'name' => 'Item Category 4'
            ],
            [
                'name' => 'Item Category 5'
            ],

        ]);

        UnitType::insert([
            [
                'name' => 'Unit Type 1'
            ],
            [
                'name' => 'Unit Type 2'
            ],
            [
                'name' => 'Unit Type 3'
            ],
            [
                'name' => 'Unit Type 4'
            ],
            [
                'name' => 'Unit Type 5'
            ],

        ]);

        Warehouse::insert([
            [
                'name' => 'Warehouse 1'
            ],
            [
                'name' => 'Warehouse 2'
            ],
            [
                'name' => 'Warehouse 3'
            ],
            [
                'name' => 'Warehouse 4'
            ],
            [
                'name' => 'Warehouse 5'
            ],

        ]);

        Vendor::insert([
            [
                'name' => 'vendor 1',
                'phone' => '+923023395112',
                'status' => 1,
            ],
            [
                'name' => 'vendor 2',
                'phone' => '+923023395112',
                'status' => 1,
            ],
            [
                'name' => 'vendor 3',
                'phone' => '+923023395112',
                'status' => 1,
            ],
            [
                'name' => 'vendor 4',
                'phone' => '+923023395112',
                'status' => 1,
            ],
            [
                'name' => 'vendor 5',
                'phone' => '+923023395112',
                'status' => 1,
            ],

        ]);
    }
}
