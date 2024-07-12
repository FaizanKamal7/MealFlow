<?php

namespace App\Http\Middleware;

use App\Models\Role;
use App\Models\UserRole;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class AuthGates
{
    public function handle($request, Closure $next)
    {

        /// ======= THE FUNCTION DYNAMICALLY DEFINES AUTHORIZATION GATES IN LARAVEL BASED ON ROLES AND PERMISSIONS 
        /// ======= RETRIEVED FROM THE DATABASE, ALLOWING FOR ROLE-BASED ACCESS CONTROL.

        $user = Auth::user();

        if ($user) {
            // Eager load roles and permissions to reduce the number of queries.
            $user_roles = UserRole::with('role.rolePermissions.permission')->get();

            $permissionsArray = [];

            foreach ($user_roles as $user_role) {
                foreach ($user_role->role->rolePermissions as $permissions) {
                    $permissionsArray[$permissions->permission->codename][] = $user_role->role->id;
                }
            }

            $userRoleIds = collect($user->userRoles)->pluck('role_id');

            foreach ($permissionsArray as $title => $roles) {
                $intersectRoles = collect($roles)->intersect($userRoleIds);

                Gate::define($title, function ($user) use ($intersectRoles) {
                    return $intersectRoles->isNotEmpty();
                });
            }
        }

        return $next($request);
        // $user = Auth::user();

        // if ($user) {
        //     $user_roles = UserRole::all();
        //     $permissionsArray = [];
        //     foreach ($user_roles as $user_role) {
        //         foreach ($user_role->role->rolePermissions as $permissions) {
        //             $permissionsArray[$permissions->permission->codename][] = $user_role->role->id;
        //         }
        //     }
        //     foreach ($permissionsArray as $title => $roles) {
        //         Gate::define($title, function ($user) use ($roles) {
        //             return count(array_intersect($user->userRoles->pluck('role_id')->toArray(), $roles)) > 0;
        //         });
        //     }
        // }

        // return $next($request);
    }
}
