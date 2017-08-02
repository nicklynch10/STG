<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
          Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('txnid')->nullable();
            $table->string('payment_status')->nullable();
            $table->decimal('payment_amount',7,2)->nullable();
            $table->string('itemid')->nullable();
            $table->dateTime('createdtime')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->string('pay_id')->nullable();
            $table->string('payer_id')->nullable();
            $table->string('get_link')->nullable();
            $table->string('pay_link')->nullable();
            $table->string('execute_link')->nullable();
            $table->integer('completed')->nullable()->default(0);
            $table->integer('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('email')->nullable();
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
         Schema::drop('payments');
    }
}
