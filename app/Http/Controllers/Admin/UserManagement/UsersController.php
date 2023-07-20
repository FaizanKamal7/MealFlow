<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Http\Controllers\Controller;
use App\Interfaces\RoleInterface;
use App\Interfaces\UserInterface;
use App\Interfaces\UserRoleInterface;
use App\Models\UserRole;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{
    private UserInterface $userRepository;
    private RoleInterface $roleRepository;
    private UserRoleInterface $userRoleRepository;

    /**
     * @param UserInterface $userRepository
     * @param RoleInterface $roleRepository
     * @param UserRole $userRoleRepository
     */
    public function __construct(UserInterface $userRepository, RoleInterface $roleRepository, UserRoleInterface $userRoleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->userRoleRepository = $userRoleRepository;
    }

    public function viewUsers()
    {
        try {
            abort_if(Gate::denies('view_users'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $roles = $this->roleRepository->getRoles();
            $users = $this->userRepository->getUsers();
            return view("admin.users.users", ["roles" => $roles, "users" => $users]);
        } catch (Exception $exception) {
            Log::error($exception);
            return abort(500);
        }
    }

    public function storeUsers(Request $request)
    {
        try {
            abort_if(Gate::denies('add_user'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $user = $this->userRepository->createUser(name: $request->get("user_name"), email: $request->get("user_email"), password: $request->get("user_password"), isActive: true);
            if ($request->get("user_roles") != null) {
                foreach ($request->get("user_roles") as $role) {
                    $this->userRoleRepository->createUserRole(userId: $user->id, roleId: $role);
                }
            }
            return redirect()->route("users_view")->with("success", "User added successfully");
        } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->route("users_view")->with("error", "Something went wrong! Contact Support");
        }
    }

    public function viewUserDetails(Request $request, $user_id)
    {
        try {
            abort_if(Gate::denies('edit_user'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $user_roles = $this->userRoleRepository->getUserRolesByUser(userId: $user_id);
            $roles = $this->roleRepository->getRoles();
            $user = $this->userRepository->getUser($user_id);
            return view("admin.users.user_details", ["user_roles" => $user_roles, "roles" => $roles, "user" => $user]);
        } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->route("users_view")->with("error", "Something went wrong! Contact Support");
        }

    }


    public function updateUserRoles(Request $request)
    {
        try {
            abort_if(Gate::denies('update_user'), Response::HTTP_FORBIDDEN, '403 Forbidden');

            $roles = $request->get("user_roles");
            $user_id = $request->get("user_id");
            $user_roles = $this->userRoleRepository->getUserRolesByUser(userId: $user_id);

            $assigned_roles = [];
            foreach ($user_roles as $role) {
                $assigned_roles [] = $role->role->id;
            }

            $roles_to_assign = array_diff($roles, $assigned_roles);
            $roles_to_revoke = array_diff($assigned_roles, $roles);

            if (!empty($roles_to_assign)) {
                foreach ($roles_to_assign as $role) {
                    $this->userRoleRepository->createUserRole(userId: $user_id, roleId: $role);
                }
            }

            if (!empty($roles_to_revoke)) {
                foreach ($roles_to_revoke as $role) {
                    $this->userRoleRepository->deleteUserRole($role);
                }

            }


            return redirect()->route("users_view")->with("success", "User updated successfully");
        } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->route("users_view")->with("error", "Something went wrong! Contact Support");
        }


    }


    public function deleteUser(Request $request, $user_id)
    {
        try {
            abort_if(Gate::denies('delete_user'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $this->userRepository->deleteUser($user_id);

            return redirect()->route("users_view")->with("success", "User deleted successfully");
        } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->route("users_view")->with("error", "Something went wrong! Contact Support");
        }

    }
}