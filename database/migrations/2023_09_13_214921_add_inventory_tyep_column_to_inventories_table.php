<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInventoryTyepColumnToInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventories', function (Blueprint $table) {
            $table->tinyInteger('inventroy_type')->nullable()->after('description')->comment('0 for inventory and 1 for asset');
            $table->unsignedBigInteger('property_id')->default(0)->after('description');
            $table->string('room_number')->nullable()->after('property_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventories', function (Blueprint $table) {
            $table->dropColumn('inventroy_type','property_id','room_number');
        });
    }
}
