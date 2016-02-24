<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableDriverVehicleAddUniqueKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('driver_vehicle', function (Blueprint $table) {
            $table->unique( array('driver_id','vehicle_id') );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('driver_vehicle', function (Blueprint $table) {
            $table->dropUnique('driver_vehicle_driver_id_vehicle_id_unique');
        });
    }
}
