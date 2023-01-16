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
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('localization');
            $table->longText('description');
            $table->unsignedBigInteger('id_media_file');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_coordinate');
            $table->unsignedBigInteger('id_type_announcement');
            $table->foreign('id_media_file')->references('id')->on('media_files')->nullOnDelete();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_coordinate')->references('id')->on('coordinates')->onDelete('cascade');
            $table->foreign('id_type_announcement')->references('id')->on('type_announcements')->nullOnDelete();
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
        Schema::dropIfExists('announcements');
    }
};
