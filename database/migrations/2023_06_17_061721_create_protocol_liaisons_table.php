<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProtocolLiaisonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('protocol_liaisons', function (Blueprint $table) {
            $table->id();
            $table->string('official_name')->nullable();
            $table->string('official_designation')->nullable();
            $table->text('official_biography')->nullable();
            $table->string('official_email')->nullable();
            $table->text('official_address')->nullable();
            $table->string('official_google_map_lat')->nullable();
            $table->string('official_google_map_lng')->nullable();
            $table->unsignedBigInteger('department_id')->default(0)->nullable();


            $table->string('notable_name')->nullable();
            $table->string('notable_city')->nullable();
            $table->text('notable_biography')->nullable();
            $table->string('notable_email')->nullable();
            $table->text('notable_address')->nullable();
            $table->string('notable_google_map_lat')->nullable();
            $table->string('notable_google_map_lng')->nullable();


            $table->string('company_name')->nullable();
            $table->string('company_city')->nullable();
            $table->text('company_about')->nullable();
            $table->string('company_email')->nullable();
            $table->text('company_address')->nullable();
            $table->string('company_website')->nullable();
            $table->string('company_google_map_lat')->nullable();
            $table->string('company_google_map_lng')->nullable();


            $table->string('project_name')->nullable();
            $table->unsignedBigInteger('city_id')->default(0)->nullable();
            $table->unsignedBigInteger('location_id')->default(0)->nullable();
            $table->text('project_company_about')->nullable();
            $table->string('project_email')->nullable();
            $table->text('project_address')->nullable();
            $table->string('project_website')->nullable();
            $table->longText('project_description')->nullable();
            $table->string('project_google_map_lat')->nullable();
            $table->string('project_google_map_lng')->nullable();

            $table->string('property_name')->nullable();
            $table->string('property_city')->nullable();
            $table->text('property_company_about')->nullable();
            $table->text('property_address')->nullable();
            $table->longText('property_description')->nullable();
            $table->string('property_google_map_lat')->nullable();
            $table->string('property_google_map_lng')->nullable();

            $table->tinyInteger('status')->default(0);
            $table->unsignedBigInteger('user_id')->default(0)->nullable();
            $table->unsignedBigInteger('protocol_liaisontype_id')->default(0);


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
        Schema::dropIfExists('protocol_liaisons');
    }
}
