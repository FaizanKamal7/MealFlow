<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RunMultipleMigrations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:multiple';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run migrations from multiple folders in specific sequence ';


    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->call('migrate', ['--path' => 'database/migrations']);
        $this->call('migrate', ['--path' => 'Modules/HRManagement/Database/Migrations']);
        $this->call('migrate', ['--path' => 'Modules/FleetService/Database/Migrations']);
        $this->call('migrate', ['--path' => 'Modules/BusinessService/Database/Migrations']);
        $this->call('migrate', ['--path' => 'Modules/DeliveryService/Database/Migrations']);
        $this->call('migrate', ['--path' => 'Modules/FinanceService/Database/Migrations']);


        $this->info('Multiple migrations of project ran successfully');
    }
}
