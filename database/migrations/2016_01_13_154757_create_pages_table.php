<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
          $table->increments('id');
          $table->string('title');
          $table->string('name')->nullable();
          $table->string('uri')->unique();
          $table->text('content');
          $table->boolean('hidden')->default(0);
          $table->integer('parent_id')->nullable();
          $table->integer('lft')->nullable();
          $table->integer('rgt')->nullable();
          $table->integer('depth')->nullable();
          $table->string('template')->nullable();
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
        Schema::drop('pages');
    }
}
