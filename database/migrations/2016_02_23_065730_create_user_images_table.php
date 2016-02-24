<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserImagesTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('user_images', function (Blueprint $table) {
      $table->increments('id');
      $table->boolean('is_active')->default(false);
      $table->boolean('is_private')->default(false);
      $table->boolean('is_featured')->default(false);
      $table->string('name')->unique();
      $table->string('path');
      $table->string('extension', 10);
      $table->string('mobile_image_name')->unique();
      $table->string('mobile_image_path');
      $table->string('mobile_extension', 10);
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
    Schema::drop('user_images');
  }
}
