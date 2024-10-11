<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToGuestVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('guest_vistors', function (Blueprint $table) {
            $table->string('company')->nullable(); // Replace 'existing_column' with a column name that already exists in the table, where you want to position 'company'
            $table->unsignedBigInteger('designation_id')->nullable();
            $table->unsignedBigInteger('sub_department_id')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('no_visa')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('guest_visitors', function (Blueprint $table) {
            //
        });
    }
}
