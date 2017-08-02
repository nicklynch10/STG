<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcademyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
            Schema::create('academies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('bio')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('propic')->nullable()->default("imgs/golf_sunset.png");
            $table->string('cover')->nullable()->default("imgs/golf_sunset.png");
            $table->string('yoe')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('address')->nullable();
            $table->string('country')->nullable()->default('USA');
            $table->integer('approved')->nullable()->default(0);
            $table->string('type')->nullable();
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
         Schema::drop('academies');
    }
}
