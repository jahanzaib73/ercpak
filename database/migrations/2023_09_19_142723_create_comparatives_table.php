<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComparativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comparatives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_order_id')->default(0); //
            $table->unsignedBigInteger('vendor_id')->default(0); //
            $table->unsignedBigInteger('item_id')->default(0); //
            $table->decimal('sub_total', 10, 2)->default(0.0); //
            $table->decimal('cgst', 5, 2)->default(0.0); //
            $table->decimal('cgst_amount', 10, 2)->default(0.0); //
            $table->decimal('total_amount', 10, 2)->default(0.0); //
            $table->decimal('item_price', 10, 2)->default(0.0); //
            $table->unsignedBigInteger('approved_vendor_id')->default(0); //
            $table->date('date')->nullable(); //
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
        Schema::dropIfExists('comparatives');
    }
}
