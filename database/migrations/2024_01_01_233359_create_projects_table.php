<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_name')->nullable();
            $table->decimal('budget', 10, 2)->default(0)->nullable();
            $table->date('project_date')->nullable();
            $table->date('start_project_date')->nullable();
            $table->date('complete_project_date')->nullable();
            $table->text('notes')->nullable();
            $table->text('notes_arabic')->nullable();
            $table->string('featured_image')->nullable()->nullable();
            $table->string('featured_image_url')->nullable()->nullable();
            $table->string('featured_image_type')->nullable()->nullable();
            $table->tinyInteger('status')->default(0);
            $table->unsignedBigInteger('task_type_id')->default(0)->nullable();
            $table->unsignedBigInteger('currency_id')->default(0)->nullable();
            $table->unsignedBigInteger('user_id')->default(0)->nullable();
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
        Schema::dropIfExists('projects');
    }
}
