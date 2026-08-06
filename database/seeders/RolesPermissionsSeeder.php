<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::query()->where('name', 'Super Admin')->first();

        if ($superAdmin) {
            $superAdmin->syncPermissions(Permission::all());
        }
    }
}
