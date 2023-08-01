<?php

namespace Modules\BusinessService\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\BusinessService\Interfaces\BranchCoverageDeliverySlotsInterface;
use Modules\BusinessService\Interfaces\BranchCoverageInterface;
use Modules\BusinessService\Interfaces\BranchInterface;
use Modules\BusinessService\Interfaces\BusinessCategoryInterface;
use Modules\BusinessService\Interfaces\OnboardingInterface;
use Modules\BusinessService\Interfaces\BusinessInterface;
use Modules\BusinessService\Interfaces\BusinessUserInterface;
use Modules\BusinessService\Repositories\BranchCoverageDeliverySlotsRepository;
use Modules\BusinessService\Repositories\BranchCoverageRepository;
use Modules\BusinessService\Repositories\BranchRepository;
use Modules\BusinessService\Repositories\BusinessCategoryRepository;
use Modules\BusinessService\Repositories\BusinessCustomerRepository;
use Modules\BusinessService\Repositories\BusinessRepository;
use Modules\BusinessService\Repositories\BusinessUserRepository;
use Modules\BusinessService\Repositories\OnboardingRepository;
use TestInterface;
use TestRepository;

class BusinessServiceServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'BusinessService';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'businessservice';

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

        $this->app->bind(OnboardingInterface::class, OnboardingRepository::class);
        $this->app->bind(BusinessInterface::class, BusinessRepository::class);
        $this->app->bind(BranchCoverageInterface::class, BranchCoverageRepository::class);
        $this->app->bind(BranchInterface::class, BranchRepository::class);
        $this->app->bind(BusinessCategoryInterface::class, BusinessCategoryRepository::class);
        $this->app->bind(BusinessCustomerInterface::class, BusinessCustomerRepository::class);
        $this->app->bind(BusinessUserInterface::class, BusinessUserRepository::class);
        $this->app->bind(BranchCoverageDeliverySlotsInterface::class, BranchCoverageDeliverySlotsRepository::class);
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
