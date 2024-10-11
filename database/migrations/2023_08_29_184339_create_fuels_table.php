<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuels', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date')->nullable();
            $table->string('vehicle_meter_reading')->nullable();
            $table->longText('notes')->nullable();
            $table->unsignedBigInteger('qty')->default(0);
            $table->unsignedBigInteger('price')->default(0);
            $table->unsignedBigInteger('trip_id')->default(0);
            $table->unsignedBigInteger('vehicle_id')->default(0);
            $table->unsignedBigInteger('driver_id')->default(0);
            $table->unsignedBigInteger('official_id')->default(0);
            $table->unsignedBigInteger('cost_center_id')->default(0);
            $table->unsignedBigInteger('fuel_tank_id')->default(0);
            $table->unsignedBigInteger('fuel_type_id')->default(0);
            $table->unsignedBigInteger('fuel_man_id')->default(0);
            $table->unsignedBigInteger('purchase_order_id')->default(0);
            $table->unsignedBigInteger('work_order_id')->default(0);
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
        Schema::dropIfExists('fuels');
    }
}
