<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableLocationsColumnsLatitudeLongDecimal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::table('locations', function (Blueprint $table) {
           DB::statement('ALTER TABLE locations MODIFY COLUMN longitude decimal(25,20) NOT NULL');
           DB::statement('ALTER TABLE locations MODIFY COLUMN latitude decimal(25,20) NOT NULL');
           DB::statement('ALTER TABLE districts MODIFY COLUMN squareArea decimal(10,5) NOT NULL');

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
           DB::statement('ALTER TABLE locations MODIFY COLUMN longitude int(11) NULL');
           DB::statement('ALTER TABLE locations MODIFY COLUMN latitude int(11) NULL');
           DB::statement('ALTER TABLE districts MODIFY COLUMN squareArea int(11) NOT NULL');
         });
     }
}
