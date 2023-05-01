<?php

namespace App\Repositories;

use App\Interfaces\RolePermissionInterface;
use App\Models\RolePermission;

class RolePermissionRepository implements RolePermissionInterface
{

    public function createRolePermission($roleId, $permissionId)
    {
        $role_permissions = new RolePermission([
            "role_id" => $roleId,
            "permission_id" => $permissionId
        ]);
        $role_permissions->save();
        return $role_permissions;
    }

    public function updateRolePermission($id, $roleId, $permissionId)
    {
        return RolePermission::where(["id"=>$id])->update([
            "role_id" => $roleId,
            "permission_id" => $permissionId
        ]);
    }

    public function getRolePermissions()
    {
      return RolePermission::all();
    }

    public function getRolePermissionsByRole($roleId)
    {
        return RolePermission::where(["role_id"=>$roleId])->get();
    }

    public function getPermissionRolesByPermission($permissionId)
    {
        return RolePermission::where(["permission_id"=>$permissionId])->get();
    }

    public function deleteRolePermission($id)
    {
        return RolePermission::where(["id"=>$id])->delete();
    }
}
