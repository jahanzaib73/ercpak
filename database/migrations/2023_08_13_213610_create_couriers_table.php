<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouriersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('couriers', function (Blueprint $table) {
            $table->id();
            $table->string('item_received')->nullable();
            $table->text('item_description')->nullable();
            $table->text('remarks')->nullable();
            $table->string('item_quantity')->nullable();
            $table->dateTime('date_time')->nullable();
            $table->unsignedBigInteger('sender_id')->default(0)->comment('Official Or Notable');
            $table->unsignedBigInteger('received_by')->default(0)->comment('From Users');
            $table->unsignedBigInteger('receiver')->default(0)->comment('From Users');
            $table->unsignedBigInteger('handover_to')->default(0)->comment('From Users');
            $table->unsignedBigInteger('user_id')->default(0)->comment('From Users');
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('couriers');
    }
}
