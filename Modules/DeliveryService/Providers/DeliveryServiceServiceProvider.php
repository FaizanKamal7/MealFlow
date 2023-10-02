<?php

namespace Modules\DeliveryService\Providers;


use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Modules\DeliveryService\Interfaces\EmptyBagCollectionBatchInterface;
use Modules\DeliveryService\Interfaces\EmptyBagCollectionInterface;
use Modules\DeliveryService\Interfaces\BagsInterface;
use Modules\DeliveryService\Interfaces\BagStatusInterface;
use Modules\DeliveryService\Interfaces\PickupBatchBranchInterface;
use Modules\DeliveryService\Interfaces\PickupBatchInterface;
use Modules\DeliveryService\Repositories\EmptyBagCollectionBatchRepository;
use Modules\DeliveryService\Repositories\EmptyBagCollectionRepository;
use Modules\DeliveryService\Repositories\BagsRepository;
use Modules\DeliveryService\Repositories\BagStatusRepository;
use Modules\DeliveryService\Repositories\PickupBatchBranchRepository;
use Modules\DeliveryService\Repositories\PickupBatchRepository;


class DeliveryServiceServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'DeliveryService';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'deliveryservice';

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
        $this->app->bind(BagsInterface::class, BagsRepository::class);
        $this->app->bind(BagStatusInterface::class, BagStatusRepository::class);
        $this->app->bind(EmptyBagCollectionInterface::class, EmptyBagCollectionRepository::class);
        $this->app->bind(EmptyBagCollectionBatchInterface::class, EmptyBagCollectionBatchRepository::class);
        $this->app->bind(DeliveryTypeInterface::class, DeliveryTypeRepository::class);
        $this->app->bind(DeliveryBatchInterface::class, DeliveryBatchRepository::class);
        $this->app->bind(PickupBatchInterface::class, PickupBatchRepository::class);
        $this->app->bind(PickupBatchBranchInterface::class, PickupBatchBranchRepository::class);
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
            module_path($this->moduleName, 'Config/config.php'),
            $this->moduleNameLower
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
