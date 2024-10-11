<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSourceColumnsToProjectTaskAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_task_attachments', function (Blueprint $table) {
            $table->tinyInteger('source')->nullable()->default(0)->comment('use to decide whether attachments is for starting or initial');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_task_attachments', function (Blueprint $table) {
            //
        });
    }
}
