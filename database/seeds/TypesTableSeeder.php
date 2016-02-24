<?php

use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('vehicle_types')->truncate();
      DB::table('vehicle_types')->insert([
        'name'=>'Bus',
        'description'=>'Transportation Bus',
      ]);
      DB::table('vehicle_types')->insert([
        'name'=>'Minivan',
        'description'=>'Minivan For Hire',
      ]);
    }
}
