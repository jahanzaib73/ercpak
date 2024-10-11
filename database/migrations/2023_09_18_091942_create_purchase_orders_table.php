<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->unsignedBigInteger('location_id')->default(0);
            $table->unsignedBigInteger('request_by_id')->default(0);
            $table->unsignedBigInteger('vendor_id')->default(0);
            $table->unsignedBigInteger('warehouse_id')->default(0);
            $table->string('terms')->nullable();
            $table->string('ship_via')->nullable();
            $table->text('notes')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->unsignedBigInteger('user_id')->default(0);
            $table->unsignedBigInteger('approved_by')->default(0);
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
        Schema::dropIfExists('purchase_orders');
    }
}
