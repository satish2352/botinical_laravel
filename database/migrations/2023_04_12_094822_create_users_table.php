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
            $table->bigIncrements('id');
            $table->string('email')->unique();
            // $table->string('u_uname');
            $table->string('password');
            $table->unsignedBigInteger('role_id');
            $table->string('full_name');
            $table->string('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('mobile_number');
            $table->string('occupation');
            $table->string('address');
            // $table->string('state');
            // $table->string('city');
            // $table->string('pincode');
            $table->string('ip_address');
            $table->string('user_profile')->default('null');
            $table->rememberToken();
            $table->string('user_otp')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
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