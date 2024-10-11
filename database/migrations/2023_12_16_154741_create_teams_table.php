<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('team_name');
            $table->string('team_name_urdu');
            $table->string('team_color');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('country_id');
            $table->string('team_symbol')->nullable();
            $table->string('team_symbol_url')->nullable();
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
        Schema::dropIfExists('teams');
    }
}
