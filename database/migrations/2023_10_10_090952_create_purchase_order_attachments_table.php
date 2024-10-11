<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrderAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order_attachments', function (Blueprint $table) {
            $table->id();
            $table->string('file_name')->nullable();
            $table->string('file_url')->nullable();
            $table->string('file_extension')->nullable();
            $table->unsignedBigInteger('user_id')->default(0);
            $table->unsignedBigInteger('purchase_order_id')->default(0);
            $table->tinyInteger('purchase_order_status')->nullable();
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
        Schema::dropIfExists('purchase_order_attachments');
    }
}
