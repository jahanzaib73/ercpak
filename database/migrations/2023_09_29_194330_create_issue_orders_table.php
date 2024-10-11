<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssueOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoice_id')->default(0);
            $table->unsignedBigInteger('item_id')->default(0);
            $table->unsignedBigInteger('po_id')->default(0);
            $table->unsignedBigInteger('wo_id')->default(0);
            $table->unsignedBigInteger('recommanded_by')->default(0);
            $table->unsignedBigInteger('approved_by')->default(0);
            $table->unsignedBigInteger('issued_qty')->default(0);
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
        Schema::dropIfExists('issue_orders');
    }
}
