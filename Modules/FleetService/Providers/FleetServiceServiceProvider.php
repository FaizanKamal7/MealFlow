<?php

namespace Modules\FleetService\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Modules\FleetService\Interfaces\DriverInterface;
use Modules\FleetService\Interfaces\VehicleInterface;
use Modules\FleetService\Repositories\DriverRepository;
use Modules\FleetService\Repositories\VehicleRepository;
use Modules\FleetService\Interfaces\VehicleFuelInterface;
use Modules\FleetService\Interfaces\VehicleTypeInterface;
use Modules\FleetService\Interfaces\VehicleModelInterface;
use Modules\FleetService\Repositories\VehicleFuelRepository;
use Modules\FleetService\Repositories\VehicleTypeRepository;
use Modules\FleetService\Repositories\VehicleModelRepository;
use Modules\FleetService\Interfaces\VehicleMaintenanceInterface;
use Modules\FleetService\Repositories\VehicleMaintenanceRepository;

class FleetServiceServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'FleetService';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'fleetservice';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->bind(VehicleInterface::class, VehicleRepository::class);
        $this->app->bind(VehicleTypeInterface::Class, VehicleTypeRepository::class);
        $this->app->bind(VehicleModelInterface::Class, VehicleModelRepository::class);
        $this->app->bind(VehicleFuelInterface::Class, VehicleFuelRepository::class);
        $this->app->bind(VehicleMaintenanceInterface::Class, VehicleMaintenanceRepository::class);
        $this->app->bind(DriverInterface::Class, DriverRepository::class);



    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
            $this->loadJsonTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
            $this->loadJsonTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }
}
