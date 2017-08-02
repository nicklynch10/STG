<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('other_id')->nullable();
            $table->integer('hire_id')->unsigned()->nullable();
            $table->foreign('hire_id')->references('id')->on('hires');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('url');
            $table->string('type1')->nullable();
            $table->string('type2')->nullable();
            $table->string('type3')->nullable();
            $table->integer('playlist_id')->unsigned()->nullable();
            $table->foreign('playlist_id')->references('id')->on('playlists');
            $table->integer('playlist_order')->default(-1);
            $table->integer('public')->default(0);
            $table->string('cover')->nullable();
            $table->string('extension')->nullable();
            $table->string('fileName')->nullable();
            $table->integer('in_aws')->nullable()->default(0);
            $table->integer('converted')->nullable()->default(0);
            $table->integer('filesize')->nullable();

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
        Schema::drop('videos');
    }
}
