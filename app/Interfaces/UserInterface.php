<?php

namespace App\Interfaces;

interface UserInterface
{
public function createUser($name,$email,$password,$isActive=true,$isSuperUser=false);
public function editUser($id,$name,$email,$password=null,$isActive=true,$isSuperUser=false);
public function getUsers();
public function getUser($id);
public function deleteUser($id);
}
