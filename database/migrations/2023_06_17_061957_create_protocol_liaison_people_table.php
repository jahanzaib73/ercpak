<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProtocolLiaisonPeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('protocol_liaison_people', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('Designation')->nullable();
            $table->string('photo_name')->nullable();
            $table->string('photo_original_name')->nullable();
            $table->string('photo_url')->nullable();
            $table->string('contact_number')->nullable();
            $table->unsignedBigInteger('protocol_liaison_id')->default(0)->nullable();
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
        Schema::dropIfExists('protocol_liaison_people');
    }
}
