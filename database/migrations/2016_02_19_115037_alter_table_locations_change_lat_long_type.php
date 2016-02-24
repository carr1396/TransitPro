<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableLocationsChangeLatLongType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('locations', function (Blueprint $table) {
            DB::statement('ALTER TABLE locations MODIFY COLUMN longitude int(11)');
            DB::statement('ALTER TABLE locations MODIFY COLUMN latitude int(11)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('locations', function (Blueprint $table) {
            DB::statement('ALTER TABLE locations MODIFY COLUMN longitude VARCHAR(255)');
            DB::statement('ALTER TABLE locations MODIFY COLUMN latitude VARCHAR(255)');
        });
    }
}
