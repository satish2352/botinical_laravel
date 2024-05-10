<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('mobile_number')->unique();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->unsignedBigInteger('role_id')->nullable();
            $table->string('full_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('address')->nullable();
            $table->string('occupation')->nullable();
            $table->string('user_otp')->nullable();
            $table->string('ip_address')->nullable();
            $table->rememberToken();
            $table->boolean('is_active')->default(true);
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
};
