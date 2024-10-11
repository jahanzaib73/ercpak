<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToGuestVistorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('guest_vistors', function (Blueprint $table) {
            $table->string('image_name')->nullable();
            $table->text('image_url')->nullable();
            $table->string('special_field')->nullable();
            $table->dateTime('date_time')->nullable();
            $table->enum('category',['OFFICIAL', 'NOTABLE', 'BUSINESS'])->default('OFFICIAL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('guest_vistors', function (Blueprint $table) {
            $table->dropColumn('image_name','image_url');
        });
    }
}
