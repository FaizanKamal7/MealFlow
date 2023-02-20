<?php

namespace App\Providers;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $user = Auth::user();


            $rolesArray = [];
            $user_roles = UserRole::all();
            $permissionsArray = [];
            foreach ($user_roles as $user_role) {
                foreach ($user_role->role->rolePermissions as $permissions) {

                    $permissionsArray[$permissions->permission->codename][] = $user_role->role->id;

                }
            }

            foreach ($permissionsArray as $title => $roles) {
                Gate::define($title, function ($user) use ($roles) {
                    foreach ($user->userRoles as $user_r) {
                        $rolesArray[] = $user_r->role->id;
                    }
                    return count(array_intersect($rolesArray, $roles)) > 0;
                });
            }


    }
}
