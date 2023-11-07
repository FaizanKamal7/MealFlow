<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Http\Controllers\Controller;
use App\Interfaces\ApplicationModelInterface;
use App\Interfaces\RoleInterface;
use App\Interfaces\RolePermissionInterface;
use App\Models\ApplicationModel;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RolesController extends Controller
{
    private RoleInterface $roleRepository;
    private RolePermissionInterface $rolePermissionRepository;
    private ApplicationModelInterface $applicationModelRepository;

    /**
     * @param RoleInterface $roleRepository
     * @param RolePermissionInterface $rolePermissionRepository
     * @param ApplicationModelInterface $applicationModelRepository
     */
    public function __construct(RoleInterface $roleRepository, RolePermissionInterface $rolePermissionRepository, ApplicationModelInterface $applicationModelRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->rolePermissionRepository = $rolePermissionRepository;
        $this->applicationModelRepository = $applicationModelRepository;
    }


    public function viewRoles()
    {
        // try {
        //     abort_if(Gate::denies('view_role'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $roles = $this->roleRepository->getRoles();
        $app_models = $this->applicationModelRepository->getAllApplicationModels();
        return view("admin.roles.roles", ["roles" => $roles, "app_models" => $app_models]);
        // } catch (Exception $exception) {
        //     Log::error($exception);
        //     return abort(500);
        // }
    }

    public function storeRole(Request $request)
    {
        // try {
        //     abort_if(Gate::denies('add_role'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role = $this->roleRepository->createRole(roleName: $request->get("role_name"), isActive: true);
        if ($request->get("permissions") != null) {
            foreach ($request->get("permissions") as $permission) {

                $this->rolePermissionRepository->createRolePermission(roleId: $role->id, permissionId: $permission);
            }
        }

        return redirect()->route("roles_view")->with("success", "Role added successfully");
        // } catch (Exception $exception) {
        //     Log::error($exception);
        //     return redirect()->route("roles_view")->with("error", "Something went wrong! Contact Support");
        // }
    }

    public function editRole($role_id)
    {
        // try {
        //     abort_if(Gate::denies('update_role'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role = $this->roleRepository->getRole(id: $role_id);
        $app_models = $this->applicationModelRepository->getAllApplicationModels();
        return view("admin.roles.edit_role", ["role" => $role, "app_models" => $app_models]);
        // } catch (Exception $exception) {
        //     Log::error($exception);
        //     return redirect()->route("roles_view")->with("error", "Something went wrong! Contact Support");
        // }
    }

    public function updateRole(Request $request)
    {

        // try {
        //     abort_if(Gate::denies('update_role'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role_name = $request->get("role_name");
        $role_id = $request->get("role_id");
        $permissions = $request->get("permissions");

        $this->roleRepository->updateRole(id: $role_id, roleName: $role_name);
        $role_permissions = $this->rolePermissionRepository->getRolePermissionsByRole($role_id);


        $assigned_permissions = [];
        foreach ($role_permissions as $permission) {
            $assigned_permissions[] = $permission->permission_id;
        }
        $permissions_to_add = array_diff($permissions, $assigned_permissions);
        $permissions_to_revoke = array_diff($assigned_permissions, $permissions);
        if (!empty($permissions_to_add)) {
            foreach ($permissions_to_add as $permission) {
                $this->rolePermissionRepository->createRolePermission(roleId: $role_id, permissionId: $permission);
            }
        }

        if (!empty($permissions_to_revoke)) {
            foreach ($permissions_to_revoke as $permission) {
                $this->rolePermissionRepository->deleteRolePermission($permission);
            }
        }


        return redirect()->route("roles_view")->with("success", "Role updated successfully");
        // } catch (Exception $exception) {
        //     Log::error($exception);
        //     return redirect()->route("roles_view")->with("error", "Something went wrong! Contact Support");
        // }
    }

    public function deleteRole(Request $request, $role_id)
    {
        // try {
        //     abort_if(Gate::denies('delete_role'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $this->roleRepository->deleteRole($role_id);

        return redirect()->route("roles_view")->with("success", "Role deleted successfully");
        // } catch (Exception $exception) {
        //     Log::error($exception);
        //     return redirect()->route("roles_view")->with("error", "Something went wrong! Contact Support");
        // }
    }
}
