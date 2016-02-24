<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            // $table->foreign('user_id')->references('id')->on('users')
            //     ->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('active')->default(1);
            $table->integer('vehicle_id');
            // $table->foreign('vehicle_id')->references('id')->on('vehicles')
            //     ->onUpdate('cascade')->onDelete('cascade');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->boolean('booked')->default(1);
            $table->boolean('pending')->default(1);
            $table->boolean('paid')->default(0);
            $table->integer('amount')->nullable();
            $table->string('address')->nullable();
            $table->string('address2')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone2')->nullable();
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
        Schema::drop('orders');
    }
}
