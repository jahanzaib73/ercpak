<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_management', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('request_type_id')->default(0)->nullable();
            $table->date('request_date')->nullable();
            $table->string('requestee_name')->nullable();
            $table->integer('age')->nullable()->default(0);
            $table->string('gender')->nullable();
            $table->unsignedBigInteger('country_id')->nullable()->default(0);
            $table->unsignedBigInteger('province_id')->nullable()->default(0);
            $table->unsignedBigInteger('city_id')->nullable()->default(0);
            $table->string('contact')->nullable();
            $table->string('email')->unique()->nullable();
            $table->decimal('funds_requested', 10, 2)->default(0.00);
            $table->unsignedBigInteger('currency_id')->default(0)->nullable();
            $table->text('notes')->nullable();
            $table->text('notesarabic')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('featured_image_url')->nullable();
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
        Schema::dropIfExists('request_management');
    }
}
