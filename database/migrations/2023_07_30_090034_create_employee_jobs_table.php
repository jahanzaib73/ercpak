<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('file_name')->nullable();
            $table->string('file_url')->nullable();
            $table->string('subject')->nullable();
            $table->text('detail')->nullable();
            $table->unsignedBigInteger('task_id')->nullable();
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
        Schema::dropIfExists('employee_jobs');
    }
}
