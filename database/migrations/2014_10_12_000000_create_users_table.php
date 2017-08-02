<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->text('bio')->nullable();
            $table->string('propic')->nullable();
            $table->string('cover')->nullable();
            $table->text('course_old')->nullable();
            $table->integer('course_id')->nullable()->unsigned();
            $table->foreign('course_id')->references('id')->on('academies');
            $table->string('handicap')->nullable();
            $table->string('age')->nullable();
            $table->string('reference_id')->nullable();
            $table->string('usage')->nullable()->default('0');
            $table->string('is_admin')->nullable()->default('0');
            $table->string('data')->nullable()->default('0');
            $table->string('alotted')->nullable()->default('100');
            //address info
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('address')->nullable();
            $table->string('country')->nullable()->default('USA');
            //pro stuff
            $table->integer('pro')->default(0);
            $table->integer('approved')->nullable()->default(0);
            $table->integer('requested')->nullable();
            $table->text('experience')->nullable();
            $table->text('why')->nullable();
            $table->string('file')->nullable();
            $table->integer('yoe')->nullable();
            $table->string('website')->nullable();
            $table->boolean('accepts_lessons')->nullable()->default(1);
            $table->boolean('accepts_swingtips')->nullable()->default(1);
            $table->decimal('swingtip_price',7,2)->nullable()->default(15);
            $table->string('software')->nullable();
            $table->decimal('balance',7,2)->default(0);
            $table->decimal('pending_balance',7,2)->default(0);
            $table->string('paypal_email')->nullable();
            $table->rememberToken();
            $table->timestamps();

            for($i=0;$i<20;$i++){
            $table->text('field'.$i)->nullable();
            }
            for($i=0;$i<20;$i++){
            $table->text('shortgame'.$i)->nullable();
            }
            for($i=0;$i<20;$i++){
            $table->text('general'.$i)->nullable();
            }
            for($i=0;$i<20;$i++){
            $table->text('specific'.$i)->nullable();
            }

            $table->boolean('account_setup')->nullable()->default(1);
            $table->boolean('address_setup')->nullable()->default(1);
            $table->boolean('questions_setup')->nullable()->default(0);
            $table->integer('fv_id')->nullable()->unsigned();
            $table->foreign('fv_id')->references('id')->on('vimeos');
            $table->integer('dtl_id')->nullable()->unsigned();
            $table->foreign('dtl_id')->references('id')->on('vimeos');

            ///statistics for users
            $table->decimal('swingtips_spent',7,2)->default(0);
            $table->decimal('swingtips_recieved',7,2)->default(0);
            $table->decimal('lessons_spent',7,2)->default(0);
            $table->decimal('lessons_recieved',7,2)->default(0);
            $table->decimal('camps_spent',7,2)->default(0);
            $table->decimal('camps_recieved',7,2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
