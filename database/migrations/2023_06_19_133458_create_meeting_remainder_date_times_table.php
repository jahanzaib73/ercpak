<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingRemainderDateTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_remainder_date_times', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_time')->nullable();
            $table->string('module_name')->nullable()->comment('It will be Meeting or Remainder');
            $table->unsignedBigInteger('module_id')->default(0)->nullable()->comment('It will be Meeting id or Remainder table id');
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
        Schema::dropIfExists('meeting_remainder_date_times');
    }
}
