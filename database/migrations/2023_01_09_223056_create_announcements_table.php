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
            $table->string('description');
            $table->foreign('id_mediafile')->references('id')->on('media_files');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_coordinate')->references('id')->on('coordinates');
            $table->foreign('id_type_announcement')->references('id')->on('type_announcements');
            $table->date('created_at');
            $table->date('modified_at');
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
