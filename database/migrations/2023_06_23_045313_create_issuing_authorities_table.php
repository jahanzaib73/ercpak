<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssuingAuthoritiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issuing_authorities', function (Blueprint $table) {
            $table->id();
            $table->string('name_of_issuing_authorities')->nullable();
            $table->string('contact_person_name')->nullable();
            $table->string('contact_person_number')->nullable();
            $table->string('logo')->nullable();
            $table->string('logo_url')->nullable();
            $table->unsignedBigInteger('user_id')->default(0)->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('issuing_authorities');
    }
}
