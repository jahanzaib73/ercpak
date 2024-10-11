<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_order_items', function (Blueprint $table) {
            $table->id();
            $table->text('remarks')->nullable();
            $table->unsignedBigInteger('workorder_id')->default(0)->index();
            $table->unsignedBigInteger('item_id')->default(0)->index();
            $table->bigInteger('qty')->default(0)->index();
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
        Schema::dropIfExists('work_order_items');
    }
}
