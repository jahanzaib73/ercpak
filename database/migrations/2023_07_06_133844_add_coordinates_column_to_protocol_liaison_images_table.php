<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCoordinatesColumnToProtocolLiaisonImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('protocol_liaison_images', function (Blueprint $table) {
            $table->string('lat')->nullable()->after('attachment_type_name');
            $table->string('lng')->nullable()->after('lat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('protocol_liaison_images', function (Blueprint $table) {
            $table->dropColumn('lat','lng');
        });
    }
}
