<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
         Schema::create('carts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->integer('active')->default(1);
            $table->integer('purchased')->default(0);
            $table->integer('option_id')->unsigned()->index()->nullable();
            $table->foreign('option_id')->references('id')->on('options')->onDelete('cascade');
            $table->integer('pro_id')->unsigned()->index();
            $table->foreign('pro_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('remaining')->default(0);//this will be for how many remaining lessons are left from that option
            $table->integer('hire_id')->unsigned()->index()->nullable();
            $table->foreign('hire_id')->references('id')->on('hires')->onDelete('cascade');
            $table->integer('playlist_id')->unsigned()->index()->nullable();
            $table->foreign('playlist_id')->references('id')->on('playlists')->onDelete('cascade');

            $table->integer('payment_id')->unsigned()->index()->nullable();
            $table->foreign('payment_id')->references('id')->on('payments');
            $table->integer('paid')->nullable()->default(0);

            $table->integer('camp_id')->unsigned()->index()->nullable();
            $table->foreign('camp_id')->references('id')->on('camps');


            $table->decimal('price',7,2)->nullable();
            $table->double('percentfee',15,8)->default(0)->nullable();
            $table->double('flatfee',15,8)->default(0)->nullable();
            $table->double('squaredfee',15,8)->default(0)->nullable();
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
        Schema::drop('carts');
    }
}
