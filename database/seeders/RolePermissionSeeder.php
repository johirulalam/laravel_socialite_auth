<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create Roles 
        $roleSuperAdmin = Role::create(['name' => 'superadmin']);
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleEditor = Role::create(['name' => 'editor']);
        $roleUser = Role::create(['name' => 'user']);

        //Permission List as array
        $permissions = [

        	//Dashboard Permiission
        	'dashboard.view',

        	//Blog Permissions
        	'blog.create',
        	'blog.view',
        	'blog.edit',
        	'blog.delete',
        	'blog.approve',

        	//Blog Permissions
        	'admin.create',
        	'admin.view',
        	'admin.edit',
        	'admin.delete',
        	'admin.approve',

        	//Role Permissions
        	'role.create',
        	'role.view',
        	'role.edit',
        	'role.delete',
        	'role.approve',

        	//Profile Permissions
        	'profile.view',
        	'profile.edit',
        ];

        //Create and assign Permission
        for ($i=0; $i <count($permissions) ; $i++) { 
        	$permission = Permission::create(['name' => $permissions[$i]]);

        	//Assign Permission
        	$roleSuperAdmin->givePermissionTo($permission);
        }
    }
}
