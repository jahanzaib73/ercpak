<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWharehouseShfittedItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wharehouse_shfitted_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id')->default(0);
            $table->unsignedBigInteger('item_assigned_qty')->default(0);
            $table->text('item_remarks')->nullable();
            $table->unsignedBigInteger('subwarehouse_id')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wharehouse_shfitted_items');
    }
}
