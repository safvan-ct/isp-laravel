<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'view users', 'store user', 'update user', 'delete user',
            'view staffs', 'store staff', 'update staff', 'delete staff',
            'view roles', 'store role', 'update role', 'delete role',
            'view permissions', 'store permission', 'update permission', 'delete permission',
            'view settings', 'store settings', 'update settings', 'delete settings',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $roles = ['Developer', 'Owner', 'Admin', 'Customer'];
        foreach ($roles as $role) {
            $role = Role::create(['name' => $role]);
        }
    }
}
