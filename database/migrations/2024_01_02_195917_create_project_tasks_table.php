<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('task_name')->nullable();
            $table->unsignedBigInteger('task_type_id')->nullable()->default(0);
            $table->date('task_date')->nullable();
            $table->date('task_started_date')->nullable();
            $table->date('task_completed_date')->nullable();
            $table->decimal('amount', 10, 2)->default(0.00);
            $table->unsignedBigInteger('currency_id')->nullable()->default(0);
            $table->text('task_description')->nullable();
            $table->text('task_description_arabic')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('featured_image_url')->nullable();
            $table->string('featured_image_type')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->unsignedBigInteger('user_id')->nullable()->default(0);
            $table->unsignedBigInteger('done_by')->nullable()->default(0);

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
        Schema::dropIfExists('project_tasks');
    }
}
