<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('applications')->delete();

        \DB::table('applications')->insert(array(
            array('id' => '04b1c75b-97e7-11ed-b4bc-f8281997de10', 'app_icon' => NULL, 'app_name' => 'User Management', 'description' => NULL, 'menu' => NULL, 'logs' => NULL, 'previous_version' => NULL, 'current_version' => NULL, 'is_active' => '1', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => 'cb503f1c-f54b-11ed-a20b-283a4d1eea26', 'app_icon' => NULL, 'app_name' => 'HR managment', 'description' => NULL, 'menu' => NULL, 'logs' => NULL, 'previous_version' => NULL, 'current_version' => NULL, 'is_active' => '1', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => 'cb503f1c-f54b-11ed-a20b-283a4d1e324v', 'app_icon' => NULL, 'app_name' => 'Fleet managment', 'description' => NULL, 'menu' => NULL, 'logs' => NULL, 'previous_version' => NULL, 'current_version' => NULL, 'is_active' => '1', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => 'cb503f1c-f54b-11ed-a20b-283a4d123gf5', 'app_icon' => NULL, 'app_name' => 'Finance managment', 'description' => NULL, 'menu' => NULL, 'logs' => NULL, 'previous_version' => NULL, 'current_version' => NULL, 'is_active' => '1', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => 'cb503f1c-f54b-11ed-a20b-283a4d1sd335', 'app_icon' => NULL, 'app_name' => 'Business managment', 'description' => NULL, 'menu' => NULL, 'logs' => NULL, 'previous_version' => NULL, 'current_version' => NULL, 'is_active' => '1', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => 'cb503f1c-f54b-11ed-a20b-283a4dgdh365', 'app_icon' => NULL, 'app_name' => 'Delivery managment', 'description' => NULL, 'menu' => NULL, 'logs' => NULL, 'previous_version' => NULL, 'current_version' => NULL, 'is_active' => '1', 'created_at' => NULL, 'updated_at' => NULL),

        ));
    }
}
