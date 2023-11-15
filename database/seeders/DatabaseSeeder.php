<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Closure;
use Illuminate\Support\Collection;
use Symfony\Component\Console\Helper\ProgressBar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // ------ Adding Roles 
        $this->command->warn(PHP_EOL . 'Importing roles...');
        $this->call(RolesTableSeeder::class);
        $this->command->info('Roles added.');


        // ------ Adding Applications 
        $this->command->warn(PHP_EOL . 'Importing applications...');
        $this->call(ApplicationSeeder::class);
        $this->command->info('Applications added.');

        // ------ Adding Application Models
        $this->command->warn(PHP_EOL . 'Importing application models...');
        $this->call(ApplicationModelSeeder::class);
        $this->command->info('Application Models added.');

        // ------ Adding Roles 
        $this->command->warn(PHP_EOL . 'Importing roles...');
        $this->call(RolesTableSeeder::class);
        $this->command->info('Roles added.');

        // ------ Adding Permissions 
        $this->command->warn(PHP_EOL . 'Importing permissions...');
        $this->call(PermissionTableSeeder::class);
        $this->command->info('Permissions added.');

        // ------ Adding Role Permission 
        $this->command->warn(PHP_EOL . 'Importing role Permissions...');
        $this->call(RolePermissionTableSeeder::class);
        $this->command->info('Role permissions added.');

        // ------ Adding Users 
        $this->command->warn(PHP_EOL . 'Importing users...');
        $this->call(UsersTableSeeder::class);
        $this->command->info('Users added.');

        // ------ Adding User Roles 
        $this->command->warn(PHP_EOL . 'Importing user roles...');
        $this->call(UserRolesTableSeeder::class);
        $this->command->info('User Roles added.');

        // ------ Adding Roles 
        $this->command->warn(PHP_EOL . 'Importing roles...');
        $this->call(RolesTableSeeder::class);
        $this->command->info('Roles added.');

        // ------ Adding Countries 
        $this->command->warn(PHP_EOL . 'Importing countries...');
        $this->call(CountriesSeeder::class);
        $this->command->info('Countries added.');

        // ------ Adding States 
        $this->command->warn(PHP_EOL . 'Importing states...');
        $this->call(StatesSeeder::class);
        $this->command->info('States added.');

        // ------ Adding Cities 
        $this->command->warn(PHP_EOL . 'Importing Cities...');
        $this->call(CitiesTableChunkOneSeeder::class);
        $this->call(CitiesTableChunkTwoSeeder::class);
        $this->call(CitiesTableChunkThreeSeeder::class);
        $this->call(CitiesTableChunkFourSeeder::class);
        $this->call(CitiesTableChunkFiveSeeder::class);
        $this->command->info('Cities added.');

        // ------ Adding Delivery Slots 
        $this->command->warn(PHP_EOL . 'Importing delivery slots...');
        $this->call(DeliverySlotSeeder::class);
        $this->command->info('Delivery Slots added.');

        // ------ Adding Business Category 
        $this->command->warn(PHP_EOL . 'Importing business categories...');
        $this->call(BusinessCategoryTableSeeder::class);
        $this->command->info('Business categories added.');

        // ------ Adding Business Category 
        $this->command->warn(PHP_EOL . 'Importing departments...');
        $this->call(DepartmentTableSeeder::class);
        $this->command->info('Departments added.');

        // ------ Adding Designations
        $this->command->warn(PHP_EOL . 'Importing Designations...');
        $this->call(DesignationTableSeeder::class);
        $this->command->info('Designations added.');
        // ------ Adding RolePermission 
        $this->command->warn(PHP_EOL . 'Importing RolePermission...');
        $this->call(RolePermissionTableSeeder::class);
        $this->command->info('RolePermission added.');
        
        // ------ Adding UserRoles 
        $this->command->warn(PHP_EOL . 'Importing UserRoles...');
        $this->call(UserRolesTableSeeder::class);
        $this->command->info('UserRoles added.');
        $this->call(BusinessesOldDbTableSeeder::class);
        $this->call(LogxCustomersOldDbTableSeeder::class);
    }

    protected function withProgressBar(int $amount, Closure $createCollectionOfOne): Collection
    {
        $progressBar = new ProgressBar($this->command->getOutput(), $amount);
        $progressBar->start();
        $items = new Collection();

        foreach (range(1, $amount) as $i) {
            $items = $items->merge(
                $createCollectionOfOne()
            );
            $progressBar->advance();
        }

        $progressBar->finish();
        $this->command->getOutput()->writeln('');
        return $items;
    }
}
