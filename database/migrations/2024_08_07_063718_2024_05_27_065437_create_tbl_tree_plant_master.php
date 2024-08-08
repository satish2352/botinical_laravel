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
        Schema::create('tbl_tree_plant', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('english_name');
            $table->string('hindi_name');
            $table->string('english_botnical_name');
            $table->string('hindi_botnical_name');
            $table->string('english_common_name');
            $table->string('hindi_common_name');
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
        //
    }
};
