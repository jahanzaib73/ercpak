<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/**
 * Run on Live Server
 * /migrate/live
 */
Route::get('/live', function(){
    try {

        Artisan::call('migrate', array('--path' => '/database/migrations/2023_09_13_090000_create_inventories_table.php'));
        Artisan::call('migrate', array('--path' => '/database/migrations/2023_09_13_091014_create_item_types_table.php'));
        Artisan::call('migrate', array('--path' => '/database/migrations/2023_09_13_091021_create_item_makes_table.php'));
        Artisan::call('migrate', array('--path' => '/database/migrations/2023_09_13_091029_create_item_categories_table.php'));
        Artisan::call('migrate', array('--path' => '/database/migrations/2023_09_13_091040_create_unit_types_table.php'));
        Artisan::call('migrate', array('--path' => '/database/migrations/2023_09_13_091052_create_warehouses_table.php'));
        Artisan::call('migrate', array('--path' => '/database/migrations/2023_09_13_214921_add_inventory_tyep_column_to_inventories_table.php'));
        Artisan::call('migrate', array('--path' => '/database/migrations/2023_09_14_092315_create_inventory_attachments_table.php'));
        Artisan::call('migrate', array('--path' => '/database/migrations/2023_09_18_091942_create_purchase_orders_table.php'));
        Artisan::call('migrate', array('--path' => '/database/migrations/2023_09_18_092531_create_purchase_order_wos_table.php'));
        Artisan::call('migrate', array('--path' => '/database/migrations/2023_09_18_092537_create_purchase_order_items_table.php'));
        Artisan::call('migrate', array('--path' => '/database/migrations/2023_09_19_142723_create_comparatives_table.php'));
        Artisan::call('migrate', array('--path' => '/database/migrations/2023_09_20_101228_add_parent_id_column_to_purchase_orders_table.php'));
        Artisan::call('migrate', array('--path' => '/database/migrations/2023_09_21_000735_add_qty_column_to_comparatives_table.php'));
        Artisan::call('migrate', array('--path' => '/database/migrations/2023_09_23_194246_add_received_column_to_comparatives_table.php'));
        Artisan::call('migrate', array('--path' => '/database/migrations/2023_09_26_194107_create_delivery_notes_table.php'));
        Artisan::call('migrate', array('--path' => '/database/migrations/2023_09_27_092509_add_delivery_note_qty_column_to_comparatives_table.php'));
        Artisan::call('migrate', array('--path' => '/database/migrations/2023_09_27_125520_create_invoices_table.php'));
        Artisan::call('migrate', array('--path' => '/database/migrations/2023_09_29_194330_create_issue_orders_table.php'));
        Artisan::call('migrate', array('--path' => '/database/migrations/2023_09_30_214918_create_sub_warehouses_table.php'));
        Artisan::call('migrate', array('--path' => '/database/migrations/2023_10_03_094640_create_wharehouse_shfitted_items_table.php'));
        Artisan::call('migrate', array('--path' => '/database/migrations/2023_10_10_090952_create_purchase_order_attachments_table.php'));
        Artisan::call('migrate', array('--path' => '/database/migrations/2023_10_13_090220_create_work_order_items_table.php'));
        Artisan::call('migrate', array('--path' => '/database/migrations/2023_10_13_201145_add_fuel_type_id_column_to_inventories_table.php'));

        return response()->json([
            'status' => true,
            'message' => 'Migrated Successfully on server.'
        ]);
    } catch (\Exception $ex) {
        return response()->json([
            'status' => false,
            'message' => $ex->getMessage()
        ],500);
    }
});

/**
 * /migrate/clear-permission-cache
 */
Route::get('/clear-permission-cache', function () {
    // Execute the Artisan command
    $exitCode = Artisan::call('cache:forget', ['key' => 'spatie.permission.cache']);

    if ($exitCode === 0) {
        return "Permission cache cleared successfully.";
    } else {
        return "An error occurred while clearing the permission cache.";
    }
});
