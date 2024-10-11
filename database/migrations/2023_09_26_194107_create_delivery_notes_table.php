<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_notes', function (Blueprint $table) {
            $table->id();
            $table->text('notes')->nullable();
            $table->date('date')->nullable();
            $table->unsignedBigInteger('purchase_order_id')->default(0);
            $table->unsignedBigInteger('dispatched_by')->default(0);
            $table->unsignedBigInteger('checked_by')->default(0);
            $table->unsignedBigInteger('received_by')->default(0);
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
        Schema::dropIfExists('delivery_notes');
    }
}
