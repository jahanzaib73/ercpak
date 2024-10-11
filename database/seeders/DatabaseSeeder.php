<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            ComplaintTypeSeeder::class,
            DepartmentSeeder::class,
            DocumentTypeSeeder::class,
            AirCraftVesselSeeder::class,
            FlightCargoTypeSeeder::class,
            FlightTypeSeeder::class,
            ProtocolLiaisonTypeSeeder::class,
            GovernmentSeeder::class,
            RemainderTypeSeeder::class,
            PermissionSeeder::class,
            CostCenterSeeder::class,
            InventorySeeder::class,
            VehicleSeeder::class,
            CurrencySeeder::class,
            ProjectTaskTypeSeeder::class,
            RequestTypeSeeder::class,
        ]);
    }
}
