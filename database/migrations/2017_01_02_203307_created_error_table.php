<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatedErrorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         DB::statement('SET FOREIGN_KEY_CHECKS = 0');
          Schema::create('errors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description')->nullable();
            $table->text('other')->nullable();
            $table->string('type')->nullable();
            $table->integer('type_id')->nullable();
            $table->boolean('active')->nullable()->default(1);
            $table->boolean('resolved')->nullable()->default(0);
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
         Schema::drop('errors');
    }
}
