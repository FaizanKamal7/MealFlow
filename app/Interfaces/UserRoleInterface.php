<?php

namespace App\Interfaces;

interface UserRoleInterface
{
public function createUserRole($userId,$roleId);
public function editUserRole($id,$userId,$roleId);
public function getUserRoles();
public function getUserRole($id);
public function deleteUserRole($id);
public function getUserRolesByUser($userId);
public function getUserRolesByRole($roleId);
}
