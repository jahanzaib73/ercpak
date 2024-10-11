<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('logo_name')->nullable();
            $table->string('logo_url')->nullable();
            $table->string('office_picture_name')->nullable();
            $table->string('office_picture_url')->nullable();
            $table->unsignedBigInteger('government_id')->default(0)->nullable();
            $table->unsignedBigInteger('user_id')->default(0)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments');
    }
}
