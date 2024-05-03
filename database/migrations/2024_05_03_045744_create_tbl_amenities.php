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
        Schema::create('tbl_amenities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('amenities_category_id');
            $table->string('english_name');
            $table->string('hindi_name');
            $table->text('english_description');
            $table->text('hindi_description');
            $table->string('image');
            $table->string('english_audio_link');
            $table->string('hindi_audio_link');
            $table->string('english_video_upload');
            $table->string('hindi_video_upload');
            $table->string('latitude');
            $table->string('longitude');
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
        Schema::dropIfExists('tbl_amenities');
    }
};
