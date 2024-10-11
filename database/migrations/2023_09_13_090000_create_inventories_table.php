<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('item_number')->nullable()->index();
            $table->string('item_code')->unique()->nullable()->index();
            $table->string('item_name')->nullable()->index();
            $table->text('description')->nullable();
            $table->string('image_name')->nullable();
            $table->string('image_url')->nullable();
            $table->string('barcode')->nullable();
            $table->unsignedBigInteger('item_type_id')->default(0);
            $table->unsignedBigInteger('make_id')->default(0);
            $table->unsignedBigInteger('category_id')->default(0);
            $table->unsignedBigInteger('unit_type_id')->default(0);
            $table->string('upc')->nullable();
            $table->decimal('unit_cost', 10, 2)->default(0.00);
            $table->unsignedBigInteger('qty')->default(0);
            $table->string('bin')->nullable();
            $table->tinyInteger('is_expiry_available')->default(0);
            $table->date('expiry_date')->nullable();
            $table->unsignedBigInteger('warehouse_id')->default(0);
            $table->unsignedBigInteger('location_id')->default(0);
            $table->tinyInteger('is_warranty_available')->default(0);
            $table->date('warranty_date')->nullable();
            $table->text('warranty_notes')->nullable();
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('user_id')->default(0);
            $table->tinyInteger('status')->default(0)->index();
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
        Schema::dropIfExists('inventories');
    }
}
