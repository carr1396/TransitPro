<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableAddColumnStartEndLocationsAndRouteName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('routes', function (Blueprint $table) {
            $table->string('name');
            $table->integer('start_location');
            $table->integer('end_location');
            $table->boolean('active')->default(1);
            $table->integer('expectedDuration')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('routes', function (Blueprint $table) {
            $table->dropColumn(['active', 'name', 'start_location', 'end_location', 'expectedDuration']);
        });
    }
}
