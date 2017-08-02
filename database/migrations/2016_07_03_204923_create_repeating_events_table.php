<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepeatingEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
         Schema::create('repeating_events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->dateTime('start')->default(0);
            $table->dateTime('end')->default(0);
            $table->string('interval')->nullable();
            $table->integer('daily')->default(0);
            $table->integer('weekly')->default(0);
            $table->integer('monthly')->default(0);
            $table->integer('offset')->default(1);
            $table->string('days')->nullable();
            $table->integer('amount')->default(0);
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
        Schema::drop('repeating_events');
    }
}
