<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrillsHiresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
         Schema::create('drill_hire', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('drill_id')->nullable()->unsigned();
            $table->foreign('drill_id')->references('id')->on('vimeos');
            $table->integer('hire_id')->nullable()->unsigned();
            $table->foreign('hire_id')->references('id')->on('hires');
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
       Schema::drop('drill_hire');
    }
}
