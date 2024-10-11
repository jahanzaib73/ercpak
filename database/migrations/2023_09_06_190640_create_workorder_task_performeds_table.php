<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkorderTaskPerformedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workorder_task_performeds', function (Blueprint $table) {
            $table->id();
            $table->text('remarks')->nullable();
            $table->unsignedBigInteger('task_id')->default(0);
            $table->unsignedBigInteger('work_order_id')->default(0);
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
        Schema::dropIfExists('workorder_task_performeds');
    }
}
