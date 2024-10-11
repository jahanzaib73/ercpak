<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProjectFeatureImageColumnToProtocolLiaisonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('protocol_liaisons', function (Blueprint $table) {
            $table->string('project_feature_image_name')->nullable()->after('property_google_map_lng');
            $table->string('project_feature_image_url')->nullable()->after('project_feature_image_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('protocol_liaisons', function (Blueprint $table) {
            $table->dropColumn('project_feature_image_name','project_feature_image_url');
        });
    }
}
