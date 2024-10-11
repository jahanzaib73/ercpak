<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('exit_meetr_reading')->nullable();
            $table->dateTime('exit_datetime_out')->nullable();
            $table->string('return_meetr_reading')->nullable();
            $table->dateTime('return_datetime_out')->nullable();
            $table->longText('notes')->nullable();
            $table->unsignedBigInteger('vehicle_id')->default(0);
            $table->unsignedBigInteger('driver_id')->default(0);
            $table->unsignedBigInteger('official_id')->default(0);
            $table->unsignedBigInteger('origin_id')->default(0);
            $table->unsignedBigInteger('destination_id')->default(0);
            $table->unsignedBigInteger('work_order_id')->default(0);
            $table->unsignedBigInteger('purchase_order_id')->default(0);
            $table->unsignedBigInteger('fuel_slip_id')->default(0);
            $table->unsignedBigInteger('cost_center_id')->default(0);
            $table->unsignedBigInteger('user_id')->default(0);
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
        Schema::dropIfExists('trips');
    }
}
