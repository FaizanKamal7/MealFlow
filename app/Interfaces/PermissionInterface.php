<?php

namespace App\Interfaces;

interface PermissionInterface
{
public function createPermission($name,$codeName,$modelId,$isActive=true);
public function updatePermission($id,$name,$codeName,$modelId,$isActive);
public function getPermissions();
public function getPermission($id);
public function deletePermission($id);
}
