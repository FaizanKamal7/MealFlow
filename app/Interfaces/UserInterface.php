<?php

namespace App\Interfaces;

interface UserInterface
{
    public function createUser($data, $authenticate_user);
    public function editUser($id, $name, $email, $password = null, $isActive = true, $isSuperUser = false);
    public function getUsers();
    public function getUser($id);
    public function deleteUser($id);
    public function getUserWhere($where);
}
