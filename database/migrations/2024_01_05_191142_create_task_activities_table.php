<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_activities', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->date('date')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->text('description')->nullable();
            $table->text('description_arabic')->nullable();
            $table->unsignedBigInteger('task_id')->nullable()->default(0);
            $table->unsignedBigInteger('location_id')->nullable()->default(0);
            $table->unsignedBigInteger('user_id')->nullable()->default(0);
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
        Schema::dropIfExists('task_activities');
    }
}
