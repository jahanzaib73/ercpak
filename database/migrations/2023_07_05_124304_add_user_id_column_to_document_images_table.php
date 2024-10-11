<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdColumnToDocumentImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('document_images', function (Blueprint $table) {
            $table->string('document_number')->default(0)->after('document_id');
            $table->unsignedBigInteger('user_id')->default(0)->after('document_id');
            $table->text('notes')->nullable()->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('document_images', function (Blueprint $table) {
            $table->dropColumn('user_id','notes','document_number');
        });
    }
}
