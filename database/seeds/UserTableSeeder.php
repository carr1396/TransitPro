<?php

use TransitPro\Role;
use TransitPro\Permission;
use Illuminate\Database\Seeder;
use TransitPro\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       User::truncate();
       $root = User::create([
          'first_name'=> 'Rebecca',
          'last_name'=>'Simmons',
          'email'=>'carr1396@gmail.com',
          'password'=>'123456'
        ]);

      $root->attachRole(Role::where('name', 'superadmin')->first());
      $root->attachRole(Role::where('name', 'admin')->first());
      $root->attachRole(Role::where('name', 'staff')->first());

       $staff = User::create([
        'first_name'=> 'Lorgan',
        'last_name'=>'Simmons',
        'other_names'=>'Johan',
        'email'=>'faridah1396@live.com',
        'password'=>'123456'
      ]);

      $staff->attachRole(Role::where('name', 'staff')->first());
      $staff->attachRole(Role::where('name', 'customer')->first());


    }
}
