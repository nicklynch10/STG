<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('repeating_event_id')->unsigned()->index()->nullable();
            $table->foreign('repeating_event_id')->references('id')->on('repeating_events')->onDelete('cascade');
            $table->dateTime('start')->default(0);
            $table->dateTime('end')->default(0);
            $table->string('display_start')->default(0);
            $table->string('display_end')->default(0);
            $table->text('notes')->nullable();
            $table->string('title')->nullable();
            $table->string('color')->nullable();
            $table->integer('is_busy')->default(1);
            $table->integer('is_repeat')->default(0);
            $table->integer('is_public')->default(0);
            $table->integer('send_notification')->default(1);
            $table->integer('active')->default(1);
            $table->integer('is_camp')->default(0)->nullable();
            $table->integer('is_lesson')->default(0)->nullable();//everything below should be only if a lesson

            $table->integer('pro_id')->unsigned()->index()->nullable();
            $table->foreign('pro_id')->references('id')->on('users')->onDelete('cascade');
            $table->decimal('price',7,2)->nullable();
            $table->integer('set')->default(0);
            $table->integer('length')->default(1);
            $table->string('address')->nullable();//address and name of place to meet
            $table->string('location')->nullable();//address and name of place to meet
            $table->string('status')->default('pending')->nullable();
            $table->integer('confirmed')->default(0);
            $table->integer('denied')->default(0);
            $table->integer('option_id')->unsigned()->index()->nullable();
            $table->foreign('option_id')->references('id')->on('options')->onDelete('cascade');
            $table->integer('cart_id')->unsigned()->index()->nullable();
            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');

            $table->integer('is_alternative')->default(0);//everything below should be only if a lesson
            $table->integer('is_credit')->default(0);
            $table->integer('past_date')->default(0);
            $table->integer('cancelled')->default(0);
            $table->integer('deleted')->default(0);
            $table->integer('reminder_set')->default(0);
            $table->text('narrative')->nullable();
            $table->string('student_email')->nullable();
            $table->integer('student_emailed')->default(0);
            $table->rememberToken();
            $table->timestamps();


            $table->integer('camp_id')->unsigned()->index()->nullable();
            $table->foreign('camp_id')->references('id')->on('camps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('events');
    }
}
