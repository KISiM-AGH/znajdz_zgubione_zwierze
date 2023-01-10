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
        Schema::create('comment_announcements', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->boolean('is_ban');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_announcement');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_announcement')->references('id')->on('announcements')->onDelete('cascade');
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
        Schema::dropIfExists('comment_announcements');
    }
};
