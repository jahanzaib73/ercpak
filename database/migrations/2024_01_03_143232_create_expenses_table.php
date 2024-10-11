<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('bill_number')->nullable();
            $table->unsignedBigInteger('vendor_id')->nullable()->default(0);
            $table->unsignedBigInteger('task_id')->nullable()->default(0);
            $table->date('date')->nullable();
            $table->decimal('amount', 10, 2)->default(0.00);
            $table->enum('pyment_status', ['Paid', 'Unpaid', 'Hold'])->default('Unpaid');
            $table->text('description')->nullable();
            $table->text('description_arabic')->nullable();
            $table->unsignedBigInteger('user_id')->nullable()->default(0);
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
        Schema::dropIfExists('expenses');
    }
}
