<?php

namespace App\Repositories;

use App\Interfaces\UserRoleInterface;
use App\Models\UserRole;

class UserRoleRepository implements UserRoleInterface
{

    public function createUserRole($userId, $roleId)
    {
        $user_roles = new UserRole([
            "user_id" => $userId,
            "role_id" => $roleId
        ]);
        $user_roles->save();
    }

    public function editUserRole($id, $userId, $roleId)
    {
        return UserRole::where(["id" => $id])->update([
            "user_id" => $userId,
            "role_id" => $roleId
        ]);
    }

    public function getUserRoles()
    {
        return UserRole::all();
    }

    public function getUserRole($id)
    {
        return UserRole::where(["id" => $id])->first();
    }

    public function deleteUserRole($id)
    {
        return UserRole::where(["id" => $id])->delete();
    }

    public function getUserRolesByUser($userId)
    {
        return UserRole::where(["user_id" => $userId])->get();
    }

    public function getUserRolesByRole($roleId)
    {
        return UserRole::where(["role_id" => $roleId])->get();
    }
}
