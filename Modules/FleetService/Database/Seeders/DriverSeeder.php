<?php

namespace Modules\FleetService\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\FleetService\Entities\Driver;

class DriverSeedeerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Driver::factory(5)->create();
    }
}
