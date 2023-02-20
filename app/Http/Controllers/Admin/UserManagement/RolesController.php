<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Http\Controllers\Controller;
use App\Models\ApplicationModel;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class RolesController extends Controller
{
    public function viewRoles()
    {
        abort_if(Gate::denies('view_role'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $roles = Role::all();
        $app_models = ApplicationModel::all();
        return view("admin.roles.roles", ["roles" => $roles, "app_models" => $app_models]);
    }

    public function storeRole(Request $request)
    {
        abort_if(Gate::denies('add_role'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role = new Role([
            "role_name" => $request->get("role_name"),
            "is_active" => true,
        ]);

        $role->save();
        if ($request->get("permissions") != null) {
            foreach ($request->get("permissions") as $permission) {
                $role_permissions = new RolePermission([
                    "role_id" => $role->id,
                    "permission_id" => $permission
                ]);
                $role_permissions->save();
            }
        }


        return redirect()->route("roles_view");
    }

    public function editRole($role_id)
    {
        abort_if(Gate::denies('update_role'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role = Role::where(["id" => $role_id])->first();
        $app_models = ApplicationModel::all();
        return view("admin.roles.edit_role", ["role" => $role, "app_models" => $app_models]);
    }

    public function updateRole(Request $request)
    {
        abort_if(Gate::denies('update_role'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role_name = $request->get("role_name");
        $role_id = $request->get("role_id");
        $permissions = $request->get("permissions");

        $role = Role::where(["id" => $role_id])->first();
        $role_permissions = RolePermission::where(["role_id" => $role->id])->get();
        $role->role_name = $role_name;

        $assigned_permissions = [];
        foreach ($role_permissions as $permission) {
            $assigned_permissions [] = $permission->permission_id;
        }
        $permissions_to_add = array_diff($permissions, $assigned_permissions);
        $permissions_to_revoke = array_diff($assigned_permissions, $permissions);
        if (!empty($permissions_to_add)) {
            foreach ($permissions_to_add as $permission) {
                $new_permission = new RolePermission([
                    "role_id" => $role->id,
                    "permission_id" => $permission
                ]);

                $new_permission->save();
            }
        }

        if (!empty($permissions_to_revoke)) {
            foreach ($permissions_to_revoke as $permission) {
                $delete_permission = RolePermission::where(["permission_id" => $permission, "role_id" => $role->id])->first();
                $delete_permission->delete();
            }

        }

        $role->save();

        return redirect()->route("roles_view");
    }

    public function deleteRole(Request $request, $role_id)
    {
        abort_if(Gate::denies('delete_role'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $role = Role::where("id", $role_id)->first();
        if ($role !== null) {
            RolePermission::where(["role_id" => $role_id])->delete();
            $role->delete();
        }

        return redirect()->route("roles_view");
    }
}
