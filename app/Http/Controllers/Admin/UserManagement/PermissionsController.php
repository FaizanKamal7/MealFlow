<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPermissionRequest;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Interfaces\ApplicationModelInterface;
use App\Interfaces\PermissionInterface;
use App\Models\ApplicationModel;
use App\Models\Permission;
use App\Models\RolePermission;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;

class PermissionsController extends Controller
{
    private PermissionInterface $permissionRepository;
    private ApplicationModelInterface $applicationModelRepository;

    /**
     * @param PermissionInterface $permissionRepository
     * @param ApplicationModelInterface $applicationModelRepository
     */
    public function __construct(PermissionInterface $permissionRepository, ApplicationModelInterface $applicationModelRepository)
    {
        $this->permissionRepository = $permissionRepository;
        $this->applicationModelRepository = $applicationModelRepository;
    }

    public function viewPermissions()
    {
        try {
            // abort_if(Gate::denies('view_permissions'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $permissions = $this->permissionRepository->getPermissions();
            $application_models = $this->applicationModelRepository->getApplicationModels();
            return view('admin.permissions.permissions', ["permissions" => $permissions, "application_models" => $application_models]);
        } catch (Exception $exception) {
            Log::error($exception);
            return abort(500);
        }
    }


    public function storePermissions(Request $request)
    {
        try {
            $is_active = false;
            if ($request->get("permission_status") == "on") {
                $is_active = true;
            }
            $this->permissionRepository->createPermission(name: $request->get("permission_name"), codeName: $request->get("permission_codename"), modelId: $request->get("application_model"), isActive: $is_active);
            return redirect()->route("permissions_view")->with("success", "Permission added successfully");
        } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->route("permissions_view")->with("error", "Something went wrong! Contact Support");
        }
    }


    public function updatePermission(Request $request)
    {

        try {
            $is_active = false;
            if ($request->get("permission_status_update") == "on") {
                $is_active = true;
            }
            $this->permissionRepository->updatePermission(id: $request->get("permission_id"), name: $request->get("permission_name"), codeName: $request->get("permission_codename"), modelId: $request->get("application_model_update"), isActive: $is_active);
            return redirect()->route("permissions_view")->with("success", "Permission updated successfully");
        } catch (Exception $exception) {
            Log::error($exception);

            return redirect()->route("permissions_view")->with("error", "Something went wrong! Contact Support");
        }
    }

    public function deletePermission(Request $request, $permission_id)
    {
        try {
            $permission = Permission::where("id", $permission_id)->first();
            if ($permission !== null) {
                $this->permissionRepository->deletePermission(id: $permission_id);
            }
            return redirect()->route("permissions_view")->with("success", "Permission deleted successfully");
        } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->route("permissions_view")->with("error", "Something went wrong! Contact Support");
        }
    }


    public function fetchSinglePermission(Request $request)
    {
        try {
            $permission = $this->permissionRepository->getPermission(id: $request->get("permission_id"));
            return response()->json(['permission' => $permission]);
        } catch (Exception $exception) {
            Log::error($exception);
            return response()->json(['permission' => null], 404);
        }
    }
}
