<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightCargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flight_cargos', function (Blueprint $table) {
            $table->id();
            $table->string('flight_number')->nullable();
            $table->string('flight_belongs_to')->nullable();
            $table->text('flight_notes')->nullable();
            $table->unsignedBigInteger('flight_type_id')->default(0)->nullable();
            $table->unsignedBigInteger('aircraft_vessel_id')->default(0)->nullable();

            $table->string('arrival_flight_origin')->nullable();
            $table->dateTime('arrival_flight_date_time')->nullable();
            $table->string('arrival_flight_destination')->nullable();
            $table->dateTime('arrival_flight_destination_date_time')->nullable();
            $table->tinyInteger('arrival_is_flight_passengers')->default(0);
            $table->integer('arrival_number_of_passengers')->default(0)->nullable();
            $table->tinyInteger('arrival_is_flight_cargo')->default(0);
            $table->integer('arrival_weight_of_flight_cargo')->default(0)->nullable();
            $table->tinyInteger('arrival_is_flight_faicons')->default(0);
            $table->integer('arrival_number_of_faicons')->default(0)->nullable();
            $table->tinyInteger('arrival_is_flight_vehicles')->default(0);
            $table->integer('arrival_number_of_flight_vehicle')->default(0)->nullable();
            $table->text('arrival_flight_notes')->nullable();

            $table->string('departure_flight_origin')->nullable();
            $table->dateTime('departure_flight_date_time')->nullable();
            $table->string('departure_flight_destination')->nullable();
            $table->dateTime('departure_flight_destination_date_time')->nullable();
            $table->tinyInteger('departure_is_flight_passengers')->default(0);
            $table->integer('departure_number_of_passengers')->default(0)->nullable();
            $table->tinyInteger('departure_is_flight_cargo')->default(0);
            $table->integer('departure_weight_of_flight_cargo')->default(0)->nullable();
            $table->tinyInteger('departure_is_flight_faicons')->default(0);
            $table->integer('departure_number_of_faicons')->default(0)->nullable();
            $table->tinyInteger('departure_is_flight_vehicles')->default(0);
            $table->integer('departure_number_of_flight_vehicle')->default(0)->nullable();
            $table->text('departure_flight_notes')->nullable();



            $table->string('sea_vessel_number')->nullable();
            $table->string('sea_vessel_type')->nullable();
            $table->text('sea_notes')->nullable();
            $table->string('sea_arrival_origin')->nullable();
            $table->dateTime('sea_arrival_date_time')->nullable();
            $table->string('sea_destination')->nullable();
            $table->dateTime('sea_destination_date_time')->nullable();
            $table->tinyInteger('is_sea_cargo_vehicles')->default(0);
            $table->integer('number_of_vehicle')->default(0)->nullable();
            $table->tinyInteger('is_sea_cargo')->default(0);
            $table->integer('weight_of_cargo')->default(0)->nullable();
            $table->tinyInteger('is_sea_cargo_other')->default(0);
            $table->text('sea_cargo_other_details')->nullable();
            $table->string('cargo_belongs_to')->nullable();
            $table->text('cargo_notes')->nullable();

            $table->string('road_arrival_origin')->nullable();
            $table->dateTime('road_arrival_date_time')->nullable();
            $table->string('road_destination')->nullable();
            $table->dateTime('road_destination_date_time')->nullable();
            $table->string('road_type_of_cargo')->nullable();
            $table->text('road_list_of_cargo')->nullable();
            $table->string('road_cargo_belongs_to')->nullable();
            $table->text('road_notes')->nullable();
            $table->string('road_driver_name')->nullable();
            $table->string('road_driver_number')->nullable();
            $table->string('road_vehicle_number_type')->nullable();

            $table->tinyInteger('status')->default(0);
            $table->string('cencelled_comment')->nullable();
            $table->date('cencelled_date')->nullable();
            $table->unsignedBigInteger('flight_cargo_type_id')->default(0)->nullable();
            $table->unsignedBigInteger('user_id')->default(0)->nullable();
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
        Schema::dropIfExists('flight_cargos');
    }
}
