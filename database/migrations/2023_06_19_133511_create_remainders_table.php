<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemaindersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remainders', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->longText('detail')->nullable();

            $table->tinyInteger('is_expairy_date')->default(0)->nullable();
            $table->dateTime('expairy_date')->nullable();

            $table->unsignedBigInteger('remainder_type_id')->default(0)->nullable();
            $table->unsignedBigInteger('employee_id')->default(0)->nullable();
            $table->unsignedBigInteger('issuing_authority_id')->default(0)->nullable();
            $table->tinyInteger('status')->default(0)->nullable();
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
        Schema::dropIfExists('remainders');
    }
}
