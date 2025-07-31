<?php
namespace App\Repository\Role;

use Spatie\Permission\Models\Role;

class RoleRepository implements RoleInterface
{
    public function dataTable()
    {
        return Role::with('permissions')->select('id', 'name')
            ->when(! auth()->user()->hasRole('Developer'), fn($q) => $q->whereNotIn('id', [1, 2, 4]));
    }

    public function updateOrCreate(array $data, ?Role $role = null): Role
    {
        $obj = Role::updateOrCreate(['id' => $role?->id], ['name' => $data['name']]);
        $obj->syncPermissions($data['permissions']);
        return $obj;
    }

    public function destroy(Role $role): void
    {
        $role->delete();
    }
}
