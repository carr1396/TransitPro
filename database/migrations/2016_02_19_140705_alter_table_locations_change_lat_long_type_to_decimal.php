<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableLocationsChangeLatLongTypeToDecimal extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      Schema::table('districts', function (Blueprint $table) {
        DB::statement('ALTER TABLE districts MODIFY COLUMN longitude decimal(25,20) NOT NULL');
        DB::statement('ALTER TABLE districts MODIFY COLUMN latitude decimal(25,20) NOT NULL');
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
        DB::statement('ALTER TABLE districts MODIFY COLUMN longitude int(11) NOT NULL');
        DB::statement('ALTER TABLE districts MODIFY COLUMN latitude int(11) NOT NULL');
      });
  }
}
