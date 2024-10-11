<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeliveryNoteQtyColumnToComparativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comparatives', function (Blueprint $table) {
            $table->unsignedBigInteger('delivery_note_qty')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comparatives', function (Blueprint $table) {
            $table->dropColumn('delivery_note_qty');
        });
    }
}
