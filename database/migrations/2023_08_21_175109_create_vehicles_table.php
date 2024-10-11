<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_number')->nullable();
            $table->string('engine_number')->nullable();
            $table->string('chassis_number')->nullable();
            $table->string('color')->nullable();
            $table->string('year')->nullable();
            $table->string('base_meter_reading')->nullable();
            $table->string('current_meter_reading')->nullable();
            $table->string('last_meter_reading')->nullable();
            $table->string('image_url')->nullable();
            $table->longText('notes')->nullable();
            $table->unsignedBigInteger('vehicle_make_id')->default(0);
            $table->unsignedBigInteger('vehicle_model_id')->default(0);
            $table->unsignedBigInteger('vehicle_type_id')->default(0);
            $table->unsignedBigInteger('fuel_type_id')->default(0);
            $table->unsignedBigInteger('user_id')->default(0);
            $table->unsignedBigInteger('owner_id')->default(0);
            $table->unsignedBigInteger('department_id')->default(0);
            $table->unsignedBigInteger('location_id')->default(0);
            $table->unsignedTinyInteger('status')->default(0);
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
        Schema::dropIfExists('vehicles');
    }
}
