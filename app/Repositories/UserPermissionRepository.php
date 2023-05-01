<?php

namespace App\Repositories;

use App\Interfaces\UserPermissionInterface;

class UserPermissionRepository implements UserPermissionInterface
{

    public function createUserPermission($userId, $permissionId)
    {
        // TODO: Implement createUserPermission() method.
    }

    public function updateUserPermission($id, $userId, $permissionId)
    {
        // TODO: Implement updateUserPermission() method.
    }

    public function getUserPermissionsByUser($userId)
    {
        // TODO: Implement getUserPermissionsByUser() method.
    }

    public function getUserPermissionsByPermission($permissionId)
    {
        // TODO: Implement getUserPermissionsByPermission() method.
    }

    public function deleteUserPermission($id)
    {
        // TODO: Implement deleteUserPermission() method.
    }
}
