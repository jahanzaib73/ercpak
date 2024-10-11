<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyStatusColumnInGuestVisitorAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('guest_visitor_attachments', function (Blueprint $table) {
            // Change the 'status' column to string type
            $table->string('status')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('guest_visitor_attachments', function (Blueprint $table) {
            //
        });
    }
}
