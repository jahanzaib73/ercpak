<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTaskAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_task_attachments', function (Blueprint $table) {
            $table->id();
            $table->string('file_name')->nullable();
            $table->string('file_type')->nullable();
            $table->string('file_url')->nullable();
            $table->unsignedBigInteger('task_id')->default(0)->nullable();
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
        Schema::dropIfExists('project_task_attachments');
    }
}
