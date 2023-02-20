<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;
class UsersController extends Controller
{
    public function viewUsers()
    {
        abort_if(Gate::denies('view_users'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $roles = Role::all();
        $users = User::all();
        return view("admin.users.users", ["roles"=>$roles, "users"=>$users]);
    }

    public function storeUsers(Request $request)
    {
        abort_if(Gate::denies('add_user'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = new User([
            "name" => $request->get("user_name"),
            "email" => $request->get("user_email"),
            "password" => Hash::make($request->get("user_password")),
        ]);

        $user->save();

        if ($request->get("user_roles") != null) {
            foreach ($request->get("user_roles") as $role) {
                $user_roles = new UserRole([
                    "user_id" => $user->id,
                    "role_id" => $role
                ]);
                $user_roles->save();
            }
        }

        return redirect()->route("users_view");
    }


    public function viewUserDetails(Request $request, $user_id)
    {
        abort_if(Gate::denies('edit_user'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_roles = UserRole::where(["user_id"=>$user_id])->get();
        $roles = Role::all();
        $user = User::where(["id"=>$user_id])->first();
        return view("admin.users.user_details", ["user_roles"=>$user_roles, "roles"=>$roles, "user"=>$user]);
    }


    public function updateUserRoles(Request $request){
        abort_if(Gate::denies('update_user'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = $request->get("user_roles");
        $user_id = $request->get("user_id");
        $user_roles = UserRole::where(["user_id"=>$user_id])->get();

        $assigned_roles = [];
        foreach ($user_roles as $role) {
            $assigned_roles [] = $role->role->id;
        }

        $roles_to_assign = array_diff($roles, $assigned_roles);
        $roles_to_revoke = array_diff($assigned_roles, $roles);

        if (!empty($roles_to_assign)) {
            foreach ($roles_to_assign as $role) {
                $new_role = new UserRole([
                    "user_id" => $user_id,
                    "role_id" => $role
                ]);

                $new_role->save();
            }
        }

        if (!empty($roles_to_revoke)) {
            foreach ($roles_to_revoke as $role) {
                $delete_role = UserRole::where(["role_id" => $role, "user_id" => $user_id])->first();
                $delete_role->delete();
            }

        }

        return redirect()->route("users_view");
    }


    public function deleteUser(Request $request, $user_id){
        abort_if(Gate::denies('delete_user'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = User::where("id", $user_id)->first();
        if($user !== null){
            UserRole::where(["user_id"=> $user_id])->delete();
            $user->delete();
        }

        return redirect()->route("users_view");
    }
}
