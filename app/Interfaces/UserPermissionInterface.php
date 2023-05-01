<?php

namespace App\Interfaces;

interface UserPermissionInterface
{
public function createUserPermission($userId,$permissionId);
public function updateUserPermission($id,$userId,$permissionId);
public function getUserPermissionsByUser($userId);
public function getUserPermissionsByPermission($permissionId);
public function deleteUserPermission($id);
}
