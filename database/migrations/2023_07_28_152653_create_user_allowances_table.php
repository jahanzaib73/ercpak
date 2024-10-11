<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAllowancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_allowances', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->double('amount')->default(0.00);
            $table->unsignedBigInteger('user_id')->default(0);
            $table->unsignedBigInteger('allowance_owner_id')->default(0);
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
        Schema::dropIfExists('user_allowances');
    }
}
