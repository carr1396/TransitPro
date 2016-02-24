<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableDistrictsChangeLatLongType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('districts', function (Blueprint $table) {
          DB::statement('ALTER TABLE districts MODIFY COLUMN longitude int(11) NOT NULL');
          DB::statement('ALTER TABLE districts MODIFY COLUMN latitude int(11) NOT NULL');
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
          DB::statement('ALTER TABLE districts MODIFY COLUMN longitude VARCHAR(255)');
          DB::statement('ALTER TABLE districts MODIFY COLUMN latitude VARCHAR(255)');
        });
    }
}
