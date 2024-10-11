<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('whats_app_number')->nullable();
            $table->string('wages_type')->nullable();
            $table->string('wages_type_value')->nullable();
            $table->string('cost_center')->nullable();
            $table->string('other_allowance')->nullable();
            $table->string('other_allowance_type')->nullable();
            $table->string('other_allowance_amount')->nullable();
            $table->string('employee_type')->nullable();
            $table->string('employee_sub_type')->nullable();
            $table->text('address')->nullable();
            $table->text('notes')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('profile_pic_name')->nullable();
            $table->string('profile_pic_url')->nullable();

            $table->unsignedBigInteger('role_id')->default(0);
            $table->unsignedBigInteger('designation_id')->default(0);
            $table->unsignedBigInteger('department_id')->default(0);
            $table->unsignedBigInteger('location_id')->default(0);
            $table->unsignedBigInteger('city_id')->default(0);
            $table->unsignedBigInteger('province_id')->default(0);
            $table->unsignedBigInteger('country_id')->default(0);
            $table->unsignedBigInteger('user_id')->default(0)->nullable();
            $table->unsignedBigInteger('reference_user_id')->default(0);

            $table->tinyInteger('is_activity_assignment')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
