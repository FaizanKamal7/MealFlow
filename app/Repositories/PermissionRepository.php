<?php

namespace App\Repositories;

use App\Interfaces\PermissionInterface;
use App\Models\Permission;

class PermissionRepository implements PermissionInterface
{

    public function createPermission($name, $codeName, $modelId, $isActive = true)
    {
        $permission = new Permission([
            "model_id" => $modelId,
            "name" => $name,
            "codename" => $codeName,
            "is_active" => $isActive,
        ]);

        $permission->save();
        return $permission;
    }

    public function updatePermission($id, $name, $codeName, $modelId, $isActive)
    {
        return Permission::where(["id" => $id])->update([
            "model_id" => $modelId,
            "name" => $name,
            "codename" => $codeName,
            "is_active" => $isActive,
        ]);
    }

    public function getPermissions()
    {
        return Permission::all();
    }

    public function getPermission($id)
    {
        return Permission::find($id);
    }

    public function deletePermission($id)
    {
        return Permission::where(["id" => $id])->delete();
    }
}
