<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserInterface
{

    public function createUser($data)
    {
        return User::create($data);
    }

    public function editUser($id, $name, $email, $password = null, $isActive = true, $isSuperUser = false)
    {
        return User::where(["id" => $id])->update([
            "name" => $name,
            "email" => $email,
            "is_active" => $isActive,
            "is_superuser" => $isSuperUser
        ]);
    }

    public function getUsers()
    {
        return User::all();
    }

    public function getUser($id)
    {
        return User::where(["id" => $id])->first();
    }

    public function getUserWhere($where)
    {
        return User::where($where)->get();
    }

    public function deleteUser($id)
    {
        return User::where(["id" => $id])->delete();
    }
}
