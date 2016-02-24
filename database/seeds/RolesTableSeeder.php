<?php

use TransitPro\Permission;
use TransitPro\Role;
use Illuminate\Database\Seeder;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();
        $root = Role::create([
            'name' => 'superadmin',
            'display_name' => 'Root administrator',
            'description' => 'Application root administrator'
        ]);
        $permissions = Permission::all();
        $root->attachPermissions($permissions);
        $admin = Role::create([
            'name' => 'admin',
            'display_name' => 'Administrator',
            'description' => 'Application administrator'
        ]);
        $permissions = Permission::all();
        $admin->attachPermissions($permissions);
        $staff = Role::create([
            'name' => 'staff',
            'display_name' => 'Staff',
            'description' => 'Transit Pro Employee'
        ]);
        $permissions = Permission::where('name', 'LIKE', 'content.%')->get();
        $staff->attachPermissions($permissions);

        $customer = Role::create([
            'name' => 'customer',
            'display_name' => 'Customer',
            'description' => 'Transit Pro Customers'
        ]);
        $permissions = Permission::where('name', 'LIKE', 'content.%')->get();
        $customer->attachPermissions($permissions);

        $customer = Role::create([
            'name' => 'moderator',
            'display_name' => 'Moderator',
            'description' => 'Transit Pro Blog Moderator'
        ]);
        $permissions = Permission::where('name', 'LIKE', 'blog.%')->get();
        $customer->attachPermissions($permissions);

    }
}
