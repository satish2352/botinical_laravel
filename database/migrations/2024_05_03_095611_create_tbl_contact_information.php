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
        Schema::create('tbl_contact_information', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('english_director_number');
            $table->string('hindi_director_number');
            $table->string('english_officer_number');
            $table->string('hindi_officer_number');
            $table->string('email');
            $table->text('english_address');
            $table->text('hindi_address');
            $table->string('is_deleted')->default(false);
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
        Schema::dropIfExists('tbl_contact_information');
    }
};
