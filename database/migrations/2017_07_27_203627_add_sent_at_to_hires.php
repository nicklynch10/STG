<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSentAtToHires extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::table('hires', function (Blueprint $table) {
        $table->boolean('declined')->default(0)->nullable();
        $table->text('declined_reason')->nullable();
        $table->boolean('issue')->default(0)->nullable();
        $table->text('issue_reason')->nullable();
        $table->boolean('reminder1_sent')->default(0)->nullable();
        $table->boolean('reminder2_sent')->default(0)->nullable();
        $table->boolean('reminder3_sent')->default(0)->nullable();
        $table->boolean('reminder4_sent')->default(0)->nullable();
        $table->dateTime('sent_at')->nullable();
        $table->dateTime('reminder1_at')->nullable();
        $table->dateTime('reminder2_at')->nullable();
        $table->dateTime('reminder3_at')->nullable();
        $table->dateTime('reminder4_at')->nullable();
        $table->dateTime('response_at')->nullable();
        $table->string('other1')->nullable();
        $table->string('other2')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
