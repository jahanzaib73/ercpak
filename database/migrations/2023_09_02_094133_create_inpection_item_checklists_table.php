<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInpectionItemChecklistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inpection_item_checklists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inspection_checklist_id')->default(0);
            $table->unsignedBigInteger('inspection_id')->default(0);
            $table->string('status')->default(0);
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('inpection_item_checklists');
    }
}
