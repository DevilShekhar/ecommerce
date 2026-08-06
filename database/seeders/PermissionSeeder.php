<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'dashboard-view',

            //Users
            'user-create',
            'user-index',
            'user-edit',
            'user-destory',

            //Roles
            'roles-create',
            'roles-index',
            'roles-edit',
            'roles-destory',
        ];

        foreach($permissions as $permission){
            Permission::firstOrCreate([
                'name'=>$permission,
                'guard_name' => 'web',
            ]);
        }
    }
}
