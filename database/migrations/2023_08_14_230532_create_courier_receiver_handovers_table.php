<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourierReceiverHandoversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courier_receiver_handovers', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable()->comment('e.g RECEIVER or HANDOVER');
            $table->unsignedBigInteger('user_id')->default(0);
            $table->unsignedBigInteger('courier_id')->default(0);
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
        Schema::dropIfExists('courier_receiver_handovers');
    }
}
