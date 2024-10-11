<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('request_by')->default(0);
            $table->unsignedBigInteger('issue_by')->default(0);
            $table->unsignedBigInteger('warehouse_id')->default(0);
            $table->unsignedBigInteger('location_id')->default(0);
            $table->unsignedBigInteger('cost_center_id')->default(0);
            $table->tinyInteger('is_purchase_order')->default(0);
            $table->unsignedBigInteger('purchase_order_id')->default(0);
            $table->tinyInteger('is_work_order')->default(0);
            $table->unsignedBigInteger('work_order_id')->default(0);
            $table->unsignedBigInteger('invoice_id')->default(0);
            $table->text('special_notes')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
