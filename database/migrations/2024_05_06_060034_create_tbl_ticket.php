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
        Schema::create('tbl_ticket', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('english_name');
            $table->string('hindi_name');
            $table->text('english_description');
            $table->text('hindi_description');
            $table->string('english_rules_terms');
            $table->string('hindi_rules_terms');
            $table->string('english_ticket_cost')->nullable();
            $table->string('hindi_ticket_cost')->nullable();
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
        Schema::dropIfExists('tbl_ticket');
    }
};
