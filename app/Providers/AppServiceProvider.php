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
use Modules\BusinessService\Interfaces\BusinessCustomerInterface;
use Modules\BusinessService\Interfaces\BusinessPricingInterface;
use Modules\BusinessService\Interfaces\CustomerAddressInterface;
use Modules\BusinessService\Interfaces\CustomerInterface;
use Modules\BusinessService\Interfaces\CustomerSecondaryNumberInterface;
use Modules\BusinessService\Interfaces\DeliverySlotPricingInterface;
use Modules\BusinessService\Interfaces\PricingTypeInterface;
use Modules\BusinessService\Interfaces\RangePricingInterface;
use Modules\BusinessService\Repositories\BusinessCustomerRepository;
use Modules\BusinessService\Repositories\BusinessPricingRepository;
use Modules\BusinessService\Repositories\CustomerAddressRepository;
use Modules\BusinessService\Repositories\CustomerRepository;
use Modules\BusinessService\Repositories\CustomerSecondaryNumberRepository;
use Modules\BusinessService\Repositories\DeliverySlotPricingRepository;
use Modules\BusinessService\Repositories\PricingRepository;
use Modules\BusinessService\Repositories\PricingTypeRepository;
use Modules\BusinessService\Repositories\RangePricingRepository;
use Modules\DeliveryService\Interfaces\DeliveryBatchInterface;
use Modules\DeliveryService\Interfaces\DeliveryInterface;
use Modules\DeliveryService\Interfaces\DeliveryTypeInterface;
use Modules\DeliveryService\Repositories\DeliveryBatchRepository;
use Modules\DeliveryService\Repositories\DeliveryRepository;
use Modules\DeliveryService\Repositories\DeliveryTypeRepository;

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
        $this->app->bind(BusinessPricingInterface::class, BusinessPricingRepository::class);
        $this->app->bind(RangePricingInterface::class, RangePricingRepository::class);
        $this->app->bind(PricingTypeInterface::class, PricingTypeRepository::class);
        $this->app->bind(DeliverySlotPricingInterface::class, DeliverySlotPricingRepository::class);
        $this->app->bind(DeliveryInterface::class, DeliveryRepository::class);
        $this->app->bind(CustomerInterface::class, CustomerRepository::class);
        $this->app->bind(CustomerAddressInterface::class, CustomerAddressRepository::class);
        $this->app->bind(CustomerSecondaryNumberInterface::class, CustomerSecondaryNumberRepository::class);
        $this->app->bind(BusinessCustomerInterface::class, BusinessCustomerRepository::class);
        $this->app->bind(DeliveryTypeInterface::class, DeliveryTypeRepository::class);
        $this->app->bind(DeliveryBatchInterface::class, DeliveryBatchRepository::class);
  
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

        // $rolesArray = [];
        // $user_roles = UserRole::all();
        // $permissionsArray = [];
        // foreach ($user_roles as $user_role) {
        //     foreach ($user_role->role->rolePermissions as $permissions) {

        //         $permissionsArray[$permissions->permission->codename][] = $user_role->role->id;
        //     }
        // }

        // foreach ($permissionsArray as $title => $roles) {
        //     Gate::define($title, function ($user) use ($roles) {
        //         foreach ($user->userRoles as $user_r) {
        //             $rolesArray[] = $user_r->role->id;
        //         }
        //         return count(array_intersect($rolesArray, $roles)) > 0;
        //     });
        // }
    }
}
