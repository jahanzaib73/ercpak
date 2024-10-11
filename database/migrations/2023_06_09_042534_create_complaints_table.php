<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->text('complaint_number')->nullable();
            $table->string('complaint_name')->nullable();
            $table->string('complaint_against')->nullable();
            $table->string('mobile')->nullable();
            $table->text('complaint_detail')->nullable();
            $table->unsignedBigInteger('complaint_type_id')->default(0);
            $table->unsignedBigInteger('user_id')->default(0)->nullable();
            $table->date('complaint_date')->default(Carbon::now());
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('complaints');
    }
}
