<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameVehicleIdColumnToTripAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trip_attachments', function (Blueprint $table) {
            $table->renameColumn('vehicle_id','trip_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trip_attachments', function (Blueprint $table) {
            $table->renameColumn('trip_id','vehicle_id');
        });
    }
}
