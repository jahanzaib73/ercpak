<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTaskIdColumnToDocumentControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('document_controls', function (Blueprint $table) {
            $table->unsignedBigInteger('task_id')->default(0)->after('body');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('document_controls', function (Blueprint $table) {
            $table->dropColumn('task_id');
        });
    }
}
