<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visas', function (Blueprint $table) {
            $table->id();
            $table->string('photo');
            $table->string('name');
            $table->string('cnic');
            $table->string('passport');
            $table->string('attachment')->nullable();
            $table->unsignedBigInteger('guest_visitor_id'); // Foreign key to connect with GuestVisitor model
            $table->timestamps();
            // Add a unique constraint to ensure one CNIC entry per day
            $table->unique(['cnic', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visas');
    }
}
