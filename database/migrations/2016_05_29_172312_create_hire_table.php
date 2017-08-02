<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHireTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
         Schema::create('hires', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('pro_id')->nullable()->unsigned();
            $table->foreign('pro_id')->references('id')->on('users');
            $table->text('field1')->nullable();
            $table->text('field2')->nullable();
            $table->text('field3')->nullable();
            $table->text('field4')->nullable();
            $table->text('field5')->nullable();
            $table->text('field6')->nullable();
            $table->integer('video1')->nullable();
            $table->integer('video2')->nullable();
            $table->integer('video3')->nullable();
            $table->integer('video4')->nullable();
            $table->integer('video5')->nullable();
            $table->integer('video6')->nullable();
            $table->integer('sent')->default(0);
            $table->decimal('price',7,2)->default(0);
            $table->integer('replied')->default(0);
            $table->integer('failed')->default(0);
            $table->integer('viewed')->default(0);
            $table->integer('reminder_sent')->default(0);//pretty sure this is wrong!!!
            $table->integer('reminder_set')->default(0);

            $table->integer('dtl_id')->nullable()->unsigned();
            $table->foreign('dtl_id')->references('id')->on('vimeos');
            $table->integer('fv_id')->nullable()->unsigned();
            $table->foreign('fv_id')->references('id')->on('vimeos');
            $table->integer('vimeo_id')->nullable()->unsigned();
            $table->foreign('vimeo_id')->references('id')->on('vimeos');
            $table->boolean('vimeo_set')->default(0);
            $table->boolean('in_cart')->default(0);
            $table->rememberToken();
            $table->timestamps();

            for($i=0;$i<20;$i++){
            $table->text('specific'.$i)->nullable();
            }

            for($i=0;$i<20;$i++){
            $table->text('hireinfo'.$i)->nullable();
            }
             for($i=0;$i<20;$i++){
            $table->text('hireinfoquestion'.$i)->nullable();
            }

            $table->string('hireclub')->nullable();
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
        Schema::drop('hires');
    }
}
