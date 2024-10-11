<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_attachments', function (Blueprint $table) {
            $table->id();
            $table->string('file_name')->nullable();
            $table->string('file_url')->nullable();
            $table->string('file_extension')->nullable();
            $table->string('subject')->nullable();
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('user_id')->default(0);
            $table->unsignedBigInteger('task_id')->default(0);
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
        Schema::dropIfExists('task_attachments');
    }
}
