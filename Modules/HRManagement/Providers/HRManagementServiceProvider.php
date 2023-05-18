<?php

namespace Modules\HRManagement\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Modules\HRManagement\Interfaces\AppreciationInterface;
use Modules\HRManagement\Interfaces\AttendanceInterface;
use Modules\HRManagement\Interfaces\AwardsInterface;
use Modules\HRManagement\Interfaces\BanksInterface;
use Modules\HRManagement\Interfaces\DeductionInterface;
use Modules\HRManagement\Interfaces\DepartmentInterface;
use Modules\HRManagement\Interfaces\DesignationInterface;
use Modules\HRManagement\Interfaces\EmployeeDepartmentInterface;
use Modules\HRManagement\Interfaces\EmployeeMediaInterface;
use Modules\HRManagement\Interfaces\EmployeeSalaryInterface;
use Modules\HRManagement\Interfaces\EmployeesInterface;
use Modules\HRManagement\Interfaces\EventsInterface;
use Modules\HRManagement\Interfaces\ExpenseReclaimInterface;
use Modules\HRManagement\Interfaces\LeaveApplicationInterface;
use Modules\HRManagement\Interfaces\LeavePolicyInterface;
use Modules\HRManagement\Interfaces\LeavePolicyRecordInterface;
use Modules\HRManagement\Interfaces\LeaveTypesInterface;
use Modules\HRManagement\Interfaces\OvertimeInterface;
use Modules\HRManagement\Interfaces\PayrollInterface;
use Modules\HRManagement\Interfaces\TaxesInterface;
use Modules\HRManagement\Interfaces\TeamMembersInterface;
use Modules\HRManagement\Interfaces\TeamsInterface;
use Modules\HRManagement\Interfaces\TimesheetInterface;
use Modules\HRManagement\Repositories\AppreciationRepository;
use Modules\HRManagement\Repositories\AttendanceRepository;
use Modules\HRManagement\Repositories\AwardsRepository;
use Modules\HRManagement\Repositories\BanksRepository;
use Modules\HRManagement\Repositories\DeductionsRepository;
use Modules\HRManagement\Repositories\DepartmentsRepository;
use Modules\HRManagement\Repositories\DesignationsRepository;
use Modules\HRManagement\Repositories\EmployeeDepartmentsRepository;
use Modules\HRManagement\Repositories\EmployeeMediaRepository;
use Modules\HRManagement\Repositories\EmployeeSalaryRepository;
use Modules\HRManagement\Repositories\EmployeesRepository;
use Modules\HRManagement\Repositories\EventsRepository;
use Modules\HRManagement\Repositories\ExpenseReclaimsRepository;
use Modules\HRManagement\Repositories\LeaveApplicationsRepository;
use Modules\HRManagement\Repositories\LeavePolicyRecordsRepository;
use Modules\HRManagement\Repositories\LeavePolicyRepository;
use Modules\HRManagement\Repositories\LeaveTypesRepository;
use Modules\HRManagement\Repositories\OvertimesRepository;
use Modules\HRManagement\Repositories\PayrollRepository;
use Modules\HRManagement\Repositories\TaxesRepository;
use Modules\HRManagement\Repositories\TeamMembersRepository;
use Modules\HRManagement\Repositories\TeamsRepository;
use Modules\HRManagement\Repositories\TimesheetsRepository;

class HRManagementServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'HRManagement';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'hrmanagement';

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

        $this->app->bind(AppreciationInterface::class, AppreciationRepository::class);
        $this->app->bind(AttendanceInterface::class, AttendanceRepository::class);
        $this->app->bind(AwardsInterface::class, AwardsRepository::class);
        $this->app->bind(BanksInterface::class, BanksRepository::class);
        $this->app->bind(DeductionInterface::class, DeductionsRepository::class);
        $this->app->bind(DepartmentInterface::class, DepartmentsRepository::class);
        $this->app->bind(DesignationInterface::class, DesignationsRepository::class);
        $this->app->bind(EmployeeDepartmentInterface::class, EmployeeDepartmentsRepository::class);
        $this->app->bind(EmployeeMediaInterface::class, EmployeeMediaRepository::class);
        $this->app->bind(EmployeeSalaryInterface::class, EmployeeSalaryRepository::class);
        $this->app->bind(EmployeesInterface::class, EmployeesRepository::class);
        $this->app->bind(EventsInterface::class, EventsRepository::class);
        $this->app->bind(ExpenseReclaimInterface::class, ExpenseReclaimsRepository::class);
        $this->app->bind(LeaveApplicationInterface::class, LeaveApplicationsRepository::class);
        $this->app->bind(LeavePolicyInterface::class, LeavePolicyRepository::class);
        $this->app->bind(LeavePolicyRecordInterface::class, LeavePolicyRecordsRepository::class);
        $this->app->bind(LeaveTypesInterface::class, LeaveTypesRepository::class);
        $this->app->bind(OvertimeInterface::class, OvertimesRepository::class);
        $this->app->bind(PayrollInterface::class, PayrollRepository::class);
        $this->app->bind(TaxesInterface::class, TaxesRepository::class);
        $this->app->bind(TeamMembersInterface::class, TeamMembersRepository::class);
        $this->app->bind(TeamsInterface::class, TeamsRepository::class);
        $this->app->bind(TimesheetInterface::class, TimesheetsRepository::class);
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
