<?php

namespace App\Providers;

use App\Interfaces\ApplicationModelInterface;
use App\Interfaces\AreaInterface;
use App\Interfaces\CityInterface;
use App\Interfaces\CountryInterface;
use App\Interfaces\DeliverySlotInterface;
use App\Interfaces\PermissionInterface;
use App\Interfaces\RoleInterface;
use App\Interfaces\RolePermissionInterface;
use App\Interfaces\StateInterface;
use App\Interfaces\UserInterface;
use App\Interfaces\UserPermissionInterface;
use App\Interfaces\UserRoleInterface;
use App\Models\UserRole;
use App\Repositories\ApplicationModelRepository;
use App\Repositories\AreaRepository;
use App\Repositories\CityRepository;
use App\Repositories\CountryRepository;
use App\Repositories\DeliverySlotRepository;
use App\Repositories\PermissionRepository;
use App\Repositories\RolePermissionRepository;
use App\Repositories\RoleRepository;
use App\Repositories\StateRepository;
use App\Repositories\UserPermissionRepository;
use App\Repositories\UserRepository;
use App\Repositories\UserRoleRepository;
use Illuminate\Pagination\Paginator;
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
        $this->app->bind(PermissionInterface::class, PermissionRepository::class);
        $this->app->bind(ApplicationModelInterface::class, ApplicationModelRepository::class);
        $this->app->bind(RolePermissionInterface::class, RolePermissionRepository::class);
        $this->app->bind(RoleInterface::class, RoleRepository::class);
        $this->app->bind(UserPermissionInterface::class, UserPermissionRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(UserRoleInterface::class, UserRoleRepository::class);
        $this->app->bind(CityInterface::class, CityRepository::class);
        $this->app->bind(AreaInterface::class, AreaRepository::class);
        $this->app->bind(StateInterface::class, StateRepository::class);
        $this->app->bind(CountryInterface::class, CountryRepository::class);
        $this->app->bind(DeliverySlotInterface::class, DeliverySlotRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Paginator::useBootstrap();
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
