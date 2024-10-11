<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingHostParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_host_participants', function (Blueprint $table) {
            $table->id();
            $table->string('member_type')->nullable()->comment('It will be Host or Participant');
            $table->unsignedBigInteger('member_id')->default(0)->nullable()->comment('It will be Offical or Notable Ids');
            $table->string('official_notable_type')->nullable()->comment('It will be official or Notable');
            $table->unsignedBigInteger('meeting_id')->default(0)->nullable();
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
        Schema::dropIfExists('meeting_host_participants');
    }
}
