<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVimeoTable extends Migration
{
    public function up()
    {
         Schema::create('vimeos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('type')->nullable()->default("N/A");
            $table->boolean('active')->default(0);
            $table->boolean('public')->default(0);

            $table->string('url')->nullable();
            $table->string('vim_id')->nullable();
            $table->string('ticket_id')->nullable();
            $table->string('upload_link')->nullable();
            $table->string('redirect')->nullable();
            $table->string('download_link_sd')->nullable();
            $table->string('download_link_hd')->nullable();

            $table->integer('hire_id')->unsigned()->nullable();
            $table->foreign('hire_id')->references('id')->on('hires');
            $table->integer('event_id')->unsigned()->nullable();
            $table->foreign('event_id')->references('id')->on('events');
            $table->integer('playlist_id')->unsigned()->nullable();
            $table->foreign('playlist_id')->references('id')->on('playlists');

            $table->integer('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('pro_id')->unsigned()->index()->nullable();
            $table->foreign('pro_id')->references('id')->on('users');
            $table->integer('student_id')->unsigned()->index()->nullable();
            $table->foreign('student_id')->references('id')->on('users');

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
         DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::drop('vimeos');
    }
}
