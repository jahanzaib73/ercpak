<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_teams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task_ownar_id')->default(0)->comment('Who create a task');
            $table->unsignedBigInteger('assigned_user_id')->default(0)->comment('Users those get task from other user');
            $table->unsignedBigInteger('assigned_by')->default(0)->comment('Users those assigned task');
            $table->unsignedBigInteger('task_id')->default(0);
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
        Schema::dropIfExists('task_teams');
    }
}
