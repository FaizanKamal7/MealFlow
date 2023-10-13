<?php

namespace App\Repositories;

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Interfaces\UserInterface;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserInterface
{

    public function createUser($data)
    {
        // return User::create($data);
        // RegisteredUserController->store($data);
        $user = User::create($data);
        event(new Registered($user));
        Auth::login($user);
        // return redirect(RouteServiceProvider::HOME);
        return $user;
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
