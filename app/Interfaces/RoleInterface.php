<?php

namespace App\Interfaces;

interface RoleInterface
{
    public function createRole($roleName, $description = null, $isActive = true);
    public function updateRole($id, $roleName, $description = null, $isActive = true);
    public function getRoles();
    public function getRole($id);
    public function deleteRole($id);
    public function getRoleByName($name);
}
