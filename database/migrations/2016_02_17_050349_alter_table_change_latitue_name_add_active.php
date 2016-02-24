<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableChangeLatitueNameAddActive extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('districts', function (Blueprint $table) {
          $table->renameColumn('latitue', 'latitude');
          $table->string('elevation')->nullable();
          $table->string('address')->nullable();
          $table->boolean('active')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('districts', function (Blueprint $table) {
          $table->renameColumn('latitude', 'latitue');
          $table->dropColumn(['active', 'elevation', 'address']);

        });
    }
}
