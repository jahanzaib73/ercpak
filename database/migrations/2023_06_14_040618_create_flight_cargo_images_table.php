<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightCargoImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flight_cargo_images', function (Blueprint $table) {
            $table->id();
            $table->string('file_name')->nullable();
            $table->string('orignal_file_name')->nullable();
            $table->string('file_type')->nullable();
            $table->string('file_url')->nullable();
            $table->string('module_type')->nullable()->commment('It shows that it is By Air, By Sea, By Road');
            $table->unsignedBigInteger('module_type_id')->default(0)->nullable()->comment('It shows that it is By Air, By Sea, By Road IDs');
            $table->string('attachment_type_name')->nullable()->comments('It shows that it is vehicles, cargo or other listing files');
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
        Schema::dropIfExists('flight_cargo_images');
    }
}
