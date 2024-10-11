<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProtocolLiaisonImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('protocol_liaison_images', function (Blueprint $table) {
            $table->id();
            $table->string('file_name')->nullable();
            $table->string('orignal_file_name')->nullable();
            $table->string('file_type')->nullable();
            $table->string('file_url')->nullable();
            $table->string('module_type')->nullable()->commment('It shows that it is Official, Notable, Company,Project');
            $table->unsignedBigInteger('module_type_id')->default(0)->nullable()->comment('It shows that it is Official, Notable, Company,Project IDs');
            $table->string('attachment_type_name')->nullable();
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
        Schema::dropIfExists('protocol_liaison_images');
    }
}
