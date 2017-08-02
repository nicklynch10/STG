<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        // Schema::create('notifications', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->integer('user_id')->unsigned();
        //     $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        //     $table->integer('other_id')->unsigned();
        //     $table->foreign('other_id')->references('id')->on('users')->onDelete('cascade');

        //     //stuff for attached to n
        //     $table->integer('u_id')->nullable();//depreciated
        //     $table->integer('hire_id')->nullable()->unsigned();
        //     $table->foreign('hire_id')->references('id')->on('hires')->onDelete('cascade');
        //     $table->integer('response_id')->nullable()->unsigned();
        //     $table->foreign('response_id')->references('id')->on('hires')->onDelete('cascade');
        //     $table->integer('rating_id')->nullable()->unsigned();
        //     $table->foreign('rating_id')->references('id')->on('ratings')->onDelete('cascade');
        //     $table->integer('testimonial_id')->nullable()->unsigned();
        //     $table->foreign('testimonial_id')->references('id')->on('testimonials')->onDelete('cascade');
        //     $table->integer('playlist_id')->nullable()->unsigned();
        //     $table->foreign('playlist_id')->references('id')->on('playlists')->onDelete('cascade');
        //     $table->integer('event_id')->nullable()->unsigned();
        //     $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        //     $table->integer('event_response_id')->nullable()->unsigned();
        //     $table->foreign('event_response_id')->references('id')->on('events')->onDelete('cascade');
        //     //displaying info
        //     $table->integer('type')->default(0)->nullable();
        //     $table->text('message')->nullable();
        //     $table->integer('checked')->default(0)->nullable();
        //     $table->integer('completed')->default(0)->nullable();
        //     $table->string('title')->nullable();
        //     $table->string('link')->nullable();
        //     $table->rememberToken();
        //     $table->timestamps();
        // });
        //


        Schema::create('notifications', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('type');
            $table->morphs('notifiable');
            $table->longText('data');
            $table->timestamp('read_at')->nullable();
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
        Schema::drop('notifications');
    }
}
