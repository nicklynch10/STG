<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
          Schema::create('ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('pro_id')->nullable()->unsigned();
            $table->foreign('pro_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('rating')->default(0)->nullable();
            $table->text('description')->nullable();
            $table->integer('type')->default(0)->nullable();
            $table->integer('hire_id')->nullable()->unsigned();
            $table->foreign('hire_id')->references('id')->on('hires')->onDelete('cascade');
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
         Schema::drop('ratings');
    }
}
