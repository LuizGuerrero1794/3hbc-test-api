<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Roles;
use App\Models\Permissions;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Roles::create(['name' => 'admin']);        
        
        $permission = Permissions::create(['name' => 'view_flights']);
        $role->givePermissionTo($permission);

        $permission = Permissions::create(['name' => 'create_flights']);
        $role->givePermissionTo($permission);

        $permission = Permissions::create(['name' => 'update_flights']);
        $role->givePermissionTo($permission);

        $permission = Permissions::create(['name' => 'delete_flights']);
        $role->givePermissionTo($permission);

        $permission = Permissions::create(['name' => 'view_airports']);
        $role->givePermissionTo($permission);

        $permission = Permissions::create(['name' => 'create_airports']);
        $role->givePermissionTo($permission);

        $permission = Permissions::create(['name' => 'update_airports']);
        $role->givePermissionTo($permission);

        $permission = Permissions::create(['name' => 'delete_airports']);
        $role->givePermissionTo($permission);

        $permission = Permissions::create(['name' => 'view_airlines']);
        $role->givePermissionTo($permission);

        $permission = Permissions::create(['name' => 'create_airlines']);
        $role->givePermissionTo($permission);

        $permission = Permissions::create(['name' => 'update_airlines']);
        $role->givePermissionTo($permission);

        $permission = Permissions::create(['name' => 'delete_airlines']);
        $role->givePermissionTo($permission);

        $role = Roles::create(['name' => 'operations']);        
    }
}
