<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubWarehousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_warehouses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('main_warehosue_id')->default(0);
            $table->unsignedBigInteger('main_location_id')->default(0);
            $table->unsignedBigInteger('new_warehosue_id')->default(0);
            $table->unsignedBigInteger('new_location_id')->default(0);
            $table->unsignedBigInteger('recommanded_by')->default(0);
            $table->unsignedBigInteger('approved_by')->default(0);
            $table->text('notes')->nullable();
            $table->date('date')->nullable();
            $table->unsignedBigInteger('user_id')->default(0);
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('sub_warehouses');
    }
}
