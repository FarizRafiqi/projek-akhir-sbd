<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminPermissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($adminPermissions->pluck('id'));
        $staffPermissions = $adminPermissions->filter(function($permission){
            return substr($permission->title, 0, 5) != 'user_'              &&
                   substr($permission->title, 0, 5) != 'role_'              && 
                   substr($permission->title, 0, 11) != 'permission_'       &&    
                   substr($permission->title, 0, 9) != 'purchase_'          &&    
                   substr($permission->title, 0, 13) != 'activity_log_';          
        });
        Role::findOrFail(2)->permissions()->sync($staffPermissions);
    }
}
