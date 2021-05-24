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
            $table->integer('status');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('user_arm_id')->unsigned()->index();
            $table->foreign('user_arm_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('food_orders_id')->unsigned()->index();
            $table->foreign('food_orders_id')->references('id')->on('food_orders')->onDelete('cascade');
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
