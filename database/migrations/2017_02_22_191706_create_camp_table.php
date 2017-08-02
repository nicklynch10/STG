<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('camps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('minutes')->default(30)->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->integer('active')->default(1);
            $table->integer('quantity')->nullable()->default(1);
            $table->integer('monthly')->nullable();
            $table->decimal('price',7,2)->nullable();
            $table->integer('people')->nullable()->default(1);
            $table->string('display_start')->default(0);
            $table->dateTime('start')->default(0);
            $table->string('start_time')->default(0);
            $table->string('start_date')->default(0);
            $table->integer('max')->nullable()->default(1);
            $table->integer('enrolled')->nullable()->default(0);
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
        Schema::drop('camps');
    }
}
