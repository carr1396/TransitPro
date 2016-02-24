<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUserImagesAddColumnUserId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_images', function (Blueprint $table) {
            $table->integer('user_id');
            $table->string('attribution')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_images', function (Blueprint $table) {
            $table->dropColumn(['user_id', 'attribution']);
        });
    }
}
