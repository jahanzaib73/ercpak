<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inspection_type')->default(0)->comment('o for vehicle inspection and 1 for asset inspection');
            $table->unsignedBigInteger('vehicle_id')->default(0);
            $table->unsignedBigInteger('cost_center_id')->nullable();
            $table->unsignedBigInteger('approved_by_id')->nullable();
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->string('meter_reading');
            $table->date('date')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->text('remarks')->nullable();
            $table->text('admin_approve_remarks')->nullable();
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
        Schema::dropIfExists('inspections');
    }
}
