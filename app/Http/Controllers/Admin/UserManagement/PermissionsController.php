<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPermissionRequest;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\ApplicationModel;
use App\Models\Permission;
use App\Models\RolePermission;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;

class PermissionsController extends Controller
{
    public function viewPermissions()
    {
        abort_if(Gate::denies('view_permissions'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $permissions = Permission::all();
        $application_models = ApplicationModel::all();
        return view('admin.permissions.permissions', ["permissions" => $permissions, "application_models" => $application_models]);
    }

    public function addPermissionView()
    {
//        abort_if(Gate::denies('permission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.permissions.create');
    }

    public function storePermissions(Request $request)
    {
        abort_if(Gate::denies('add_permission'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $is_active = false;
        if ($request->get("permission_status") == "on") {
            $is_active = true;
        }
        $permission = new Permission([
            "model_id" => $request->get("application_model"),
            "name" => $request->get("permission_name"),
            "codename" => $request->get("permission_codename"),
            "is_active" => $is_active,
        ]);

        $permission->save();

        return redirect()->route('permissions_view');
    }

    public function editPermissions(Permission $permission)
    {
        abort_if(Gate::denies('permission_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.permissions.edit', compact('permission'));
    }

    public function update(Request $request)
    {
        $is_active = false;
        if ($request->get("permission_status_update") == "on") {
            $is_active = true;
        }
        Permission::where("id", $request->get("permission_id"))->update(["name" => $request->get("permission_name"), "codename" => $request->get("permission_codename"), "model_id" => $request->get("application_model_update"), "is_active" => $is_active]);
        return redirect()->route('permissions.index');
    }


    public function updatePermission(Request $request)
    {
        abort_if(Gate::denies('update_permission'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $is_active = false;
        if ($request->get("permission_status_update") == "on") {
            $is_active = true;
        }
        Permission::where("id", $request->get("permission_id"))->update(["name" => $request->get("permission_name"), "codename" => $request->get("permission_codename"), "model_id" => $request->get("application_model"), "is_active" => $is_active]);
        return redirect()->route('permissions_view');
    }

    public function deletePermission(Request $request, $permission_id)
    {
        abort_if(Gate::denies('delete_permission'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $permission = Permission::where("id", $permission_id)->first();
        if ($permission !== null) {
            RolePermission::where(["permission_id" => $permission_id])->delete();
            $permission->delete();
        }
        return redirect()->route('permissions_view');
    }

    public function show(Permission $permission)
    {
        abort_if(Gate::denies('permission_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.permissions.show', compact('permission'));
    }

    public function destroy(Permission $permission)
    {
        abort_if(Gate::denies('permission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permission->delete();

        return back();
    }

    public function massDestroy(MassDestroyPermissionRequest $request)
    {
        Permission::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }


    public function fetchSinglePermission(Request $request)
    {
        abort_if(Gate::denies('view_permissions'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $permission = Permission::where('id', '=', $request->get("permission_id"))->first();
        if ($permission) {
            return response()->json(['permission' => $permission]);
        } else {
            return response()->json(["Error" => "Permission Not found!"]);
        }
    }
}
