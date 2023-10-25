<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Http\Controllers\Controller;
use App\Interfaces\ApplicationModelInterface;
use App\Interfaces\ApplicationInterface;
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

class ApplicationController extends Controller
{
    private ApplicationInterface $applicationRepository;
    private ApplicationModelInterface $applicationModelRepository;

    /**
     * @param ApplicationInterface $applicationRepository
     * @param ApplicationModelInterface $applicationModelRepository
     */
    public function __construct(ApplicationInterface $applicationRepository,  ApplicationModelInterface $applicationModelRepository)
    {
        $this->applicationRepository = $applicationRepository;
        $this->applicationModelRepository = $applicationModelRepository;
    }


    public function viewApplication()
    {
        // try {
        //     abort_if(Gate::denies('view_application'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $applications = $this->applicationRepository->getApplications();
        return view("admin.applications.applications", ["applications" => $applications]);
        // } catch (Exception $exception) {
        //     Log::error($exception);
        //     return abort(500);
        // }
    }

    public function storeApplication(Request $request)
    {
        // try {
        //     abort_if(Gate::denies('add_role'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->applicationRepository->createApplication(appIcon: null, appName: $request->get("app_name"), isActive: true);


        return redirect()->route("applications_view")->with("success", "Application added successfully");
        // } catch (Exception $exception) {
        //     Log::error($exception);
        //     return redirect()->route("roles_view")->with("error", "Something went wrong! Contact Support");
        // }
    }

    public function editApplication($app_id)
    {
        // try {

        //     abort_if(Gate::denies('update_role'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role = $this->applicationRepository->getApplication(id: $app_id);
        $app_models = $this->applicationModelRepository->getApplicationModels();
        return view("admin.roles.edit_role", ["role" => $role, "app_models" => $app_models]);
        // } catch (Exception $exception) {
        //     Log::error($exception);
        //     return redirect()->route("roles_view")->with("error", "Something went wrong! Contact Support");
        // }
    }

    // public function updateRole(Request $request)
    // {

    //     try {
    //         abort_if(Gate::denies('update_role'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //         $role_name = $request->get("role_name");
    //         $role_id = $request->get("role_id");
    //         $permissions = $request->get("permissions");

    //         $this->applicationRepository->updateRole(id: $role_id, roleName: $role_name);
    //         // $role_permissions = $this->rolePermissionRepository->getRolePermissionsByRole($role_id);


    //         $assigned_permissions = [];
    //         // foreach ($role_permissions as $permission) {
    //         //     $assigned_permissions[] = $permission->permission_id;
    //         // }
    //         // $permissions_to_add = array_diff($permissions, $assigned_permissions);
    //         // $permissions_to_revoke = array_diff($assigned_permissions, $permissions);
    //         // if (!empty($permissions_to_add)) {
    //         //     foreach ($permissions_to_add as $permission) {
    //         //         // $this->rolePermissionRepository->createRolePermission(roleId: $role_id, permissionId: $permission);
    //         //     }
    //         // }

    //         // if (!empty($permissions_to_revoke)) {
    //         //     foreach ($permissions_to_revoke as $permission) {
    //         //         // $this->rolePermissionRepository->deleteRolePermission($permission);
    //         //     }
    //         // }


    //         return redirect()->route("roles_view")->with("success", "Role updated successfully");
    //     } catch (Exception $exception) {
    //         Log::error($exception);
    //         return redirect()->route("roles_view")->with("error", "Something went wrong! Contact Support");
    //     }
    // }

    // public function deleteRole(Request $request, $role_id)
    // {
    //     try {
    //         abort_if(Gate::denies('delete_role'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    //         $this->applicationRepository->deleteRole($role_id);

    //         return redirect()->route("roles_view")->with("success", "Role deleted successfully");
    //     } catch (Exception $exception) {
    //         Log::error($exception);
    //         return redirect()->route("roles_view")->with("error", "Something went wrong! Contact Support");
    //     }
    // }
}
