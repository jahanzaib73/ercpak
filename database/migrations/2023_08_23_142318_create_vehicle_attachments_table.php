<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_attachments', function (Blueprint $table) {
            $table->id();
            $table->string('file_name')->nullable();
            $table->string('file_url')->nullable();
            $table->string('file_extension')->nullable();
            $table->unsignedBigInteger('user_id')->default(0);
            $table->unsignedBigInteger('vehicle_id')->default(0);
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
        Schema::dropIfExists('vehicle_attachments');
    }
}
