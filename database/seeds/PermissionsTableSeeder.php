<?php

use TransitPro\Permission;
use Illuminate\Database\Seeder;
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::truncate();
        Permission::create([
            'name' => 'users.create',
            'display_name' => 'Create users',
            'description' => 'Can create new application users'
        ]);
        Permission::create([
            'name' => 'users.edit',
            'display_name' => 'Edit users',
            'description' => 'Can edit application users'
        ]);
        Permission::create([
            'name' => 'admins.create',
            'display_name' => 'Create admins',
            'description' => 'Can create new application admins'
        ]);
        Permission::create([
            'name' => 'admins.edit',
            'display_name' => 'Edit admins',
            'description' => 'Can edit application admins'
        ]);
        Permission::create([
            'name' => 'staff.create',
            'display_name' => 'Create staff',
            'description' => 'Can create new application staff'
        ]);
        Permission::create([
            'name' => 'staff.edit',
            'display_name' => 'Edit staff',
            'description' => 'Can edit application staff'
        ]);
        Permission::create([
            'name' => 'customers.create',
            'display_name' => 'Create customers',
            'description' => 'Can create new customers'
        ]);
        Permission::create([
            'name' => 'customers.edit',
            'display_name' => 'Edit customers',
            'description' => 'Can edit customers'
        ]);
        Permission::create([
            'name' => 'pages.manage',
            'display_name' => 'Manage Pages',
            'description' => 'Can edit Pages'
        ]);
        Permission::create([
            'name' => 'content.manage',
            'display_name' => 'Manage content',
            'description' => 'Can edit content'
        ]);

        Permission::create([
            'name' => 'blog.manage',
            'display_name' => 'Manage Blog content',
            'description' => 'Can edit post delete and view blog'
        ]);
    }
}
