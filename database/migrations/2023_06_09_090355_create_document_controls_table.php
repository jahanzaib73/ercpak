<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_controls', function (Blueprint $table) {
            $table->id();
            $table->string('document_type')->nullable();
            $table->date('date')->nullable();
            $table->date('date_expiary')->nullable();
            $table->string('subject')->nullable();
            $table->string('document_number')->nullable();
            $table->string('document_bin')->nullable();
            $table->unsignedBigInteger('document_category_id')->default(0);
            $table->unsignedBigInteger('department_id')->default(0);
            $table->unsignedBigInteger('user_id')->default(0)->nullable();
            $table->unsignedBigInteger('location_id')->default(0);
            $table->longText('body')->nullable();
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('document_controls');
    }
}
