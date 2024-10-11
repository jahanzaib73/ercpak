<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenamePurposeOfVisitColumnInGuestVistorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('guest_vistors', function (Blueprint $table) {
            $table->renameColumn('purpose_of_visit', 'purpose_of_visit_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('guest_vistors', function (Blueprint $table) {
            $table->renameColumn('purpose_of_visit_id', 'purpose_of_visit');
        });
    }
}
