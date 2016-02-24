<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableVehicleChangeAmountDataTypeDecimal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            DB::statement('ALTER TABLE vehicles MODIFY COLUMN booking_amount decimal(15,5) NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vehicles', function (Blueprint $table) {
             DB::statement('ALTER TABLE vehicles MODIFY COLUMN booking_amount int(11) NULL');
        });
    }
}
