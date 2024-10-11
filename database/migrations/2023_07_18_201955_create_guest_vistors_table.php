<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestVistorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guest_vistors', function (Blueprint $table) {
            $table->id();
            $table->string('vistor_name')->nullable();
            $table->string('vistor_contact')->nullable();
            $table->string('vistor_email')->nullable();
            $table->string('purpose_of_visit')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->dateTime('time_in')->nullable();
            $table->dateTime('time_out')->nullable();
            $table->text('notes')->nullable();
            $table->text('address')->nullable();
            $table->unsignedBigInteger('guest_id')->default(0)->nullable();
            $table->unsignedBigInteger('location_id')->default(0)->nullable();
            $table->unsignedBigInteger('department_id')->default(0)->nullable();
            $table->unsignedBigInteger('province_id')->default(0)->nullable();
            $table->unsignedBigInteger('city_id')->default(0)->nullable();
            $table->unsignedBigInteger('user_id')->default(0)->nullable();
            $table->unsignedBigInteger('host_id')->default(0)->nullable();
            $table->enum('type',['GUEST','VISTORS'])->default('GUEST');
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
        Schema::dropIfExists('guest_vistors');
    }
}
