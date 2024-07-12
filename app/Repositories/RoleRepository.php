<?php

namespace App\Repositories;

use App\Interfaces\RoleInterface;
use App\Models\Role;

class RoleRepository implements RoleInterface
{

    public function createRole($roleName, $description = null, $isActive = true)
    {
        $role = new Role([
            "role_name" => $roleName,
            "description" => $description,
            "is_active" => true,
        ]);

        $role->save();
        return $role;
    }

    public function updateRole($id, $roleName, $description = null, $isActive = true)
    {
        return Role::where(["id" => $id])->update([
            "role_name" => $roleName,
            "description" => $description,
            "is_active" => true,
        ]);
    }

    public function getRoles()
    {
        return Role::all();
    }

    public function getRole($id)
    {
        return Role::where(["id" => $id])->first();
    }

    public function getRoleByName($name)
    {
        return Role::where(["role_name" => $name])->first();
    }

    public function deleteRole($id)
    {
        return Role::where(["id" => $id])->delete();
    }
}
