<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJustificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('justifications', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('status_id')->unsigned()->nullable();
            $table->foreign('status_id')->references('id')->on('status')->onDelete('SET NULL');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('arm_id')->unsigned()->nullable();
            $table->foreign('arm_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->integer('food_orders_id')->unsigned()->nullable();
            $table->foreign('food_orders_id')->references('id')->on('food_orders')->onDelete('SET NULL');
            $table->text('description');
            $table->text('justification_img_link')->nullable();
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
        Schema::dropIfExists('justifications');
    }
}
