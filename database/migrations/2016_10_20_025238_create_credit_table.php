<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         DB::statement('SET FOREIGN_KEY_CHECKS = 0');
          Schema::create('credits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description')->nullable();
            $table->integer('quantity')->nullable()->default(1);
            $table->decimal('price',7,2)->nullable();
            $table->integer('requested')->nullable()->default(0);
            $table->integer('confirmed')->nullable()->default(0);
            $table->integer('active')->nullable()->default(1);
            $table->rememberToken();
            $table->timestamps();

            $table->integer('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('pro_id')->nullable()->unsigned();
            $table->foreign('pro_id')->references('id')->on('users');
            $table->integer('option_id')->nullable()->unsigned();
            $table->foreign('option_id')->references('id')->on('options');
            $table->integer('event_id')->nullable()->unsigned();
            $table->foreign('event_id')->references('id')->on('events');
            $table->integer('payment_id')->nullable()->unsigned();
            $table->foreign('payment_id')->references('id')->on('payments');
            $table->integer('cart_id')->nullable()->unsigned();
            $table->foreign('cart_id')->references('id')->on('carts');
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
         Schema::drop('credits');
    }
}
