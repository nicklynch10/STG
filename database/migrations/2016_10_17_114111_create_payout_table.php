<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayoutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
          Schema::create('payouts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('payout_batch_id')->nullable();
            $table->string('batch_status');
            $table->decimal('amount',7,2);
            $table->decimal('fee',7,2)->nullable();
            $table->string('time_created')->nullable();
            $table->string('receiver_email');
            $table->string('currency');
            $table->string('note')->nullable();
            $table->string('sender_item_id')->nullable();
            $table->string('transaction_id')->nullable();
            $table->text('errors')->nullable();
            $table->dateTime('createdtime');
            $table->rememberToken();
            $table->timestamps();

            $table->integer('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
         Schema::drop('payouts');
    }
}
