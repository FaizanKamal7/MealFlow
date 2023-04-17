<?php

namespace App\Interfaces;

interface RolePermissionInterface
{
public function createRolePermission($roleId,$permissionId);
public function updateRolePermission($id,$roleId,$permissionId);
public function getRolePermissions();
public function getRolePermissionsByRole($roleId);
public function getPermissionRolesByPermission($permissionId);
public function deleteRolePermission($id);
}
